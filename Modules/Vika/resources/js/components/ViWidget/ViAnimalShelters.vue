<template>
  <div
    v-loading="loader"
    class="vi-animals-shelters"
  >
    <div class="content-box">
      <div
        v-if="sheltersList===null"
        class="hello-box"
      >
        Для поиска выберите муниципалитет
      </div>
      <div
        v-else
        class="scroll-box"
      >
        <div class="start-text">
          <a
            href="https://animals.admhmao.ru/animals/find-home"
            target="_blank"
          >Мы ищем
            дом</a>.
          <br>Перечень приютов для животных, где граждане могут оставить или приобрести животных:
        </div>
        <div
          v-if="sheltersList.length===0"
          class="hello-box"
        >
          По вашему запросу ничего не найдено
        </div>
        <div class="content">
          <el-collapse
            v-if="sheltersList.length!==0"
            v-model="active"
            class="shelters-list"
            accordion
          >
            <el-collapse-item
              v-for="itemCity in sheltersList"
              :key="'city'+itemCity.id"
              class="shelters-box"
              :title="itemCity.name"
              :name="itemCity.name"
            >
              <div
                v-if="itemCity.pet_widget_vet_shelters.length===0"
                class="shelters-none"
              >
                Информации о приютах нет
              </div>
              <div
                v-for="itemShelter in itemCity.pet_widget_vet_shelters"
                :key="'shelters'+itemShelter.id"
                class="item-shelters"
              >
                <div class="shelters-name">
                  {{ itemShelter.name }}
                </div>
                <div
                  v-for="itemAddress in itemShelter.pet_widget_vet_shelter_addresses"
                  :key="'address'+itemAddress.id"
                  class="shelters-address"
                >
                  <a
                    href="https://animals.admhmao.ru/animals/map-safety"
                    target="_blank"
                  >{{ itemAddress.address }}</a>
                </div>
                <div
                  v-for="itemEmail in itemShelter.pet_widget_vet_shelter_emails"
                  :key="'email'+itemEmail.id"
                  class="shelters-email"
                >
                  <a :href="'mailto:'+itemEmail.email">{{ itemEmail.email }}</a>
                </div>
                <div
                  v-for="itemPhone in itemShelter.pet_widget_vet_shelter_phones"
                  :key="'phone'+itemPhone.id"
                  class="shelters-phone"
                >
                  {{ itemPhone.phone }}
                </div>
              </div>
            </el-collapse-item>
          </el-collapse>
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
        Фильтр
      </el-button>
      <div
        v-else
        v-loading="loadFilterData"
        class="filter"
      >
        <div class="title-filter">
          Укажите параметры для фильтрации
        </div>
        <div class="item-form">
          <div class="title-form">
            Муниципалитет
          </div>
          <el-select
            v-model="filter.locality_id"
            class="filter-select"
            placeholder="Выберите муниципалитет"
            filterable
            clearable
            :value-on-clear="null"
            @change="getShelters()"
          >
            <el-option
              v-for="item in localityList"
              :key="'localityList'+item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapState} from 'pinia';
import {useAppStore} from '../../store/index.js';

export default {
  name: 'ViAnimalShelters',
  data() {
    return {
      loader: false,
      loadFilterData: false,
      filterWatch: false,
      filter: {
        locality_id: null,
      },
      localityList: [],
      sheltersList: null,
      active: null,
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI']),
  },
  created() {
    this.getLocalities();
    this.startParams();
    this.getShelters();
  },
  methods: {
    getLocalities() {
      this.loadFilterData = true;
      this.$axios.get(this.linkAPI + 'widget/pet/get_localities')
        .then((response) => {
          console.log('Населенные пункты: ', response.data);
          this.localityList = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadFilterData = false;
        });
    },
    getShelters() {
      this.loader = true;
      this.$axios.get(this.linkAPI + 'widget/pet/shelters/list', {params: this.filter})
        .then((response) => {
          console.log('Приюты для животных: ', response.data);
          this.sheltersList = response.data;
          if(this.sheltersList.length===1){
            this.active = this.sheltersList[0].name;
          }
          this.filterWatch = false;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loader = false;
        });
    },
    startParams() {
      if (this.$route.query.locality_id) {
        this.filter.locality_id = parseInt(this.$route.query.locality_id);
      }
    },
  }
};
</script>

<style scoped>
.vi-animals-shelters {
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


.content {
  padding: 0 20px 20px;
}

.start-text {
  padding: 20px;

  font-family: Montserrat, sans-serif;
  font-size: 16px;
  font-weight: 500;
  line-height: 170%;
}

.start-text a {
  color: #264ABF;
  text-decoration: none;
}

.shelters-none {
  font-family: Montserrat, sans-serif;
  font-size: 14px;
  font-weight: 400;
  line-height: 170%;
}

.item-shelters {
  margin-bottom: 10px;
  padding-bottom: 10px;
  border-bottom: 1px solid #ebeef5;
}

.shelters-box .item-shelters:last-child {
  margin-bottom: 0;
  padding-bottom: 0;
  border-bottom: none;
}

.shelters-name {
  margin-bottom: 15px;

  font-family: Montserrat, sans-serif;
  font-size: 18px;
  font-weight: 500;
  line-height: 150%;
}

.shelters-address, .shelters-phone, .shelters-email {
  display: flex;
  gap: 5px;
  align-items: center;
  justify-content: flex-start;

  margin-bottom: 5px;

  font-family: Montserrat, sans-serif;
  font-size: 15px;
  font-weight: normal;
  line-height: 130%;
}

.shelters-address a, .shelters-phone a, .shelters-email a {
  color: #264ABF;
  text-decoration: none;
}

.shelters-address::before {
  content: '';

  width: 15px;
  min-width: 15px;
  height: 16px;

  background-color: #a2a8bd;

  mask-image: url("../../../assets/img/location.svg");
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 11px;
}

.shelters-email::before {
  content: '';

  width: 15px;
  min-width: 15px;
  height: 16px;

  background-color: #a2a8bd;

  mask-image: url("../../../assets/img/mail.svg");
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 13px;
}

.shelters-phone::before {
  content: '';

  width: 15px;
  min-width: 15px;
  height: 16px;

  background-color: #a2a8bd;

  mask-image: url("../../../assets/img/phone.svg");
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 13px;
}

</style>

<style>

.shelters-list .el-collapse-item__header {
  font-family: Montserrat, sans-serif;
  font-size: 16px;
  font-weight: 400;
}
</style>
