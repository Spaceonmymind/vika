<template>
  <div
    v-loading="loader"
    class="vi-gas"
  >
    <div class="content-box">
      <div
        v-if="price===null"
        class="hello-box"
      >
        Выберите муниципальное образование <br>
        и вид топлива
      </div>
      <div
        v-else
        class="content"
      >
        <div class="legend">
          В выбранном городе стоимость топлива
          <div class="legend-box">
            <div class="legend-item">
              <div class="point min" />
              - минимальная
            </div>
            <div class="legend-item">
              <div class="point" />
              - средняя
            </div>
            <div class="legend-item">
              <div class="point max" />
              - максимальная
            </div>
          </div>
        </div>
        <div class="scroll-box">
          <div
            v-if="price.length===0"
            class="hello-box"
            style="margin-top: 30px;"
          >
            По вашему запросу ничего не найдено
          </div>
          <div
            v-for="itemStation in price"
            :key="'itemStation'+itemStation.id"
            class="gas-station-item"
          >
            <div class="gas-station-name">
              <span v-html="itemStation.name" />
            </div>
            <div class="gas-station-address">
              <i /> {{ itemStation.address }}
            </div>
            <div class="gas-box">
              <div
                v-for="itemGas in itemStation.fuel_prices"
                :key="'itemGas'+itemGas.id"
                class="gas-item"
              >
                <div :class="['point',getClassPoint(itemGas.fuel_type.code,itemGas.price)]" />
                <div class="gas-name">
                  {{ itemGas.fuel_type.name }}
                </div>
                <span class="dash">—</span>
                <div class="gas-prise">
                  {{ itemGas.price !== null ? itemGas.price : '?' }}
                </div>
              </div>
            </div>
            <div class="refresh">
              <i />{{ itemStation.created_at }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="filter-box">
      <el-button
        v-if="!filterWatch"
        class="filter-button"
        style="width: calc(100% - 105px)"
        type="primary"
        @click="filterWatch=!filterWatch"
      >
        Изменить
        выбор
      </el-button>
      <div
        v-else
        v-loading="loadFilterData"
        class="filter"
      >
        <div class="title-filter">
          Укажите параметры
        </div>
        <div class="item-form">
          <div class="title-form">
            Город
          </div>
          <el-select
            v-model="filter.cityId"
            class="filter-select"
            placeholder="Выберите город"
            filterable
          >
            <el-option
              v-for="item in cityList"
              :key="'city'+item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
        </div>
        <div class="item-form">
          <div class="title-form">
            Вид топлива
          </div>
          <el-select
            v-model="filter.gasId"
            class="filter-select"
            placeholder="Выберите вид топлива"
            filterable
            multiple
            collapse-tags
            collapse-tags-tooltip
            :max-collapse-tags="3"
          >
            <el-option
              v-for="item in gasList"
              :key="'gas'+item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
        </div>
        <el-button
          class="filter-button"
          style="width: 100%"
          type="primary"
          :disabled="filter.cityId===null"
          @click="getFuelInCity()"
        >
          Искать
        </el-button>
      </div>
    </div>
  </div>
</template>

<script>
import {mapState} from 'pinia';
import {useAppStore} from '../../store/index.js';

export default {
  name: 'ViGas',
  data() {
    return {
      cityList: [],
      gasList: [],
      loadFilterData: false,
      filterWatch: true,
      filter: {
        cityId: null,
        gasId: [],
      },
      price: null,
      loader: false,
      minPrice: {},
      maxPrice: {},
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI']),
  },
  created() {
    this.loadFilterData = true;
    Promise.all([this.getCities(), this.getFuelTypes()]).finally(
      () => {
        this.loadFilterData = false;
      }
    );
    this.startParams();
  },
  methods: {
    async getCities() {
      try {
        let response = await this.$axios.get(this.linkAPI + 'widget/fuel_price/get_cities');
        console.log('Города: ', response.data);
        this.cityList = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async getFuelTypes() {
      try {
        let response = await this.$axios.get(this.linkAPI + 'widget/fuel_price/get_fuel_types');
        console.log('Виды топлива: ', response.data);
        this.gasList = response.data;
        this.gasList.forEach(item => {
          this.minPrice[item.code] = null;
          this.maxPrice[item.code] = null;
        });
      } catch (error) {
        console.log(error);
      }
    },
    getFuelInCity() {
      this.filterWatch = false;
      this.loader = true;
      let params = {
        city_id: this.filter.cityId,
        fuel_type_ids: this.filter.gasId
      };
      this.$axios.post(this.linkAPI + 'widget/fuel_price/get_fuel_in_city', params)
        .then((response) => {
          console.log('Цены на топливо', response.data);
          this.price = response.data;
          this.getMinMaxPrice();
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loader = false;
        });
    },
    getMinMaxPrice() {
      Object.keys(this.minPrice).forEach(key => {
        this.minPrice[key] = null;
        this.maxPrice[key] = null;
      });

      this.price.forEach(itemPoint => {
        itemPoint.fuel_prices?.forEach(itemGas => {
          if (this.minPrice[itemGas.fuel_type?.code] === null) {
            this.minPrice[itemGas.fuel_type?.code] = itemGas.price;
          } else if (itemGas.price !== null && this.minPrice[itemGas.fuel_type?.code] > itemGas.price) {
            this.minPrice[itemGas.fuel_type?.code] = itemGas.price;
          }

          if (this.maxPrice[itemGas.fuel_type?.code] === null) {
            this.maxPrice[itemGas.fuel_type?.code] = itemGas.price;
          } else if (itemGas.price !== null && this.maxPrice[itemGas.fuel_type?.code] < itemGas.price) {
            this.maxPrice[itemGas.fuel_type?.code] = itemGas.price;
          }
        });
      });
    },
    getClassPoint(code, price) {
      if (this.minPrice[code] === price) {
        return 'min';
      } else if (this.maxPrice[code] === price) {
        return 'max';
      }
      return '';
    },
    startParams(){
      if(this.$route.query.city_id){
        this.filter.cityId = parseInt(this.$route.query.city_id);
      }
      if (this.$route.query['fuel_type_ids[]']) {
        if(Array.isArray(this.$route.query['fuel_type_ids[]'])){
          this.filter.gasId = this.$route.query['fuel_type_ids[]'].map(item=>{
            return parseInt(item);
          });
        }else{
          this.filter.gasId = [parseInt(this.$route.query['fuel_type_ids[]'])];
        }
      }
        if (this.$route.query['fuel_type_ids']) {
            if(Array.isArray(this.$route.query['fuel_type_ids'])){
                this.filter.gasId = this.$route.query['fuel_type_ids'].map(item=>{
                    return parseInt(item);
                });
            }else{
                this.filter.gasId = [parseInt(this.$route.query['fuel_type_ids'])];
            }
        }
      if(this.filter.cityId!==null){
        this.getFuelInCity();
      }
    }
  }
};
</script>

<style scoped>
.vi-gas {
  display: grid;
  grid-template-rows: calc(100% - 100px) 100px;
}

.hello-box {
  font-family: Montserrat, sans-serif;
  font-size: 15px;
  font-weight: 500;
  line-height: 160%;
  color: #000;
  text-align: center;
}

.content-box{
  position: relative;
  height: 100%;
}

.legend {
  position: relative;
  z-index: 40;

  padding: 18px 25px;

  font-family: Montserrat, sans-serif;
  font-size: 16px;
  font-weight: 600;

  background: #F3F7FA;
}

.legend .legend-box {
  display: flex;
  justify-content: space-between;
  margin-top: 10px;
}

.legend .legend-box .legend-item {
  display: flex;
  align-items: center;
  font-size: 14px;
  font-weight: 500;
}

.legend .legend-box .point {
  width: 8px;
  height: 8px;
  margin-top: 2px;
  margin-right: 3px;
  border-radius: 10px;

  background: #fadb4b;
}

.legend .legend-box .point.min {
  background: #91e767;
}

.legend .legend-box .point.max {
  background: #fa4b4c;
}

.content {
  display: grid;
  grid-template-rows: 83px calc(100% - 83px);
  height: 100%;
}

.gas-station-item {
  position: relative;

  padding: 25px;
  border-bottom: 1px solid #d6dae4;

  font-family: Montserrat, sans-serif;
  color: #000;

  transition: 0.3s ease;
}

.gas-station-item:last-child {
  border-bottom: none;
}

.gas-station-item .gas-station-name {
  position: relative;
  font-size: 16px;
  font-weight: 600;
  color: #282828;
}

.gas-station-item .gas-station-address {
  margin-top: 8px;

  font-size: 13px;
  font-weight: 500;
  line-height: 160%;
  color: #5D616D;
}

.gas-station-item .gas-station-address i {
  display: inline-block;

  width: 9px;
  height: 13px;
  margin-right: 5px;

  vertical-align: -2px;

  background-color: #BCBFCA;

  mask-image: url("../../../assets/img/location.svg");
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 9px;
}

.gas-station-item .gas-box {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;

  width: 100%;
  margin-top: 22px;
}

.gas-station-item .gas-box .gas-item {
  display: flex;
  flex-wrap: wrap;
  gap: 5px;
  align-items: center;

  width: max-content;
  padding: 10px 15px;
  border-radius: 5px;

  font-size: 16px;

  background: #F3F7FA;
}

.gas-station-item .gas-box .gas-item .dash {
  margin: 0 7px;
  font-size: 13px;
  color: #6F7280;
}

.gas-station-item .gas-box .gas-item .gas-name {
  font-size: 13px;
  font-weight: 600;
  color: #6F7280;
}

.gas-station-item .gas-box .gas-item .point {
  width: 7px;
  height: 7px;
  border-radius: 10px;
  background: #fadb4b;
}

.gas-station-item .gas-box .gas-item .point.max {
  background: #fa4b4c;
}

.gas-station-item .gas-box .gas-item .point.min {
  background: #91e767;
}

.gas-station-item .gas-box .gas-item .gas-prise {
  font-size: 14px;
  font-weight: 600;
}

.gas-station-item .refresh {
  position: relative;

  margin-top: 20px;
  padding-left: 20px;

  font-size: 14px;
  font-weight: 500;
  color: #848cab;
  text-align: right;
  letter-spacing: .3px;

}

.gas-station-item .refresh i {
  display: inline-block;

  width: 13px;
  height: 13px;
  margin-right: 8px;
  margin-bottom: -1px;
  padding-right: 13px;

  background-color: #70799a;

  mask-image: url("../../../assets/img/refresh.svg");
  mask-position: bottom;
  mask-repeat: no-repeat;
  mask-size: 12px;
}


.filter-box {
  z-index: 10;
  display: flex;
  align-items: flex-start;
  justify-content: center;
}

.filter {
  position: absolute;
  z-index: 99;
  bottom: 22px;

  box-sizing: border-box;
  width: calc(100% - 50px);
  padding: 28px;
  border-radius: 30px;

  background: #f2f4fb;
}

.title-filter {
  margin-bottom: 17px;
  font-family: Montserrat, sans-serif;
  font-size: 17px;
  font-weight: 600;
}

.item-form {
  margin-bottom: 10px;
}

.title-form {
  margin-bottom: 8px;

  font-family: Montserrat, sans-serif;
  font-size: 13px;
  font-weight: 400;
  color: #272727;
  text-shadow: 0.1px 0.1px 0.1px rgb(0 0 0 / 30%);
  letter-spacing: 0.2px;
}

.filter-button {
  box-sizing: content-box;
  padding: 9px 0;
  border: 0;
  border-radius: 15px !important;

  font-family: Montserrat, sans-serif;
  font-size: 16px;
  font-weight: 600;
  white-space: normal;

  background: #264abf;
  box-shadow: 0 10px 30px rgb(168 179 214 / 70%);
}

.filter-button.is-disabled {
  border-color: #1e3685;
  opacity: .5;
  background: #1e3685;
}

.filter-button.is-disabled:hover {
  border-color: #1e3685;
  opacity: .5;
  background: #1e3685;
}

</style>
