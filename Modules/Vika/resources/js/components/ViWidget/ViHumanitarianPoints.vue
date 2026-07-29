<template>
  <div
    v-loading="loader"
    class="vi-humanitarian-points"
  >
    <el-dialog
      v-if="detailPoint.active"
      v-model="detailPoint.active"
      class="point-box"
      :close-on-click-modal="false"
      top="20px"
      width="calc(100% - 40px)"
      :title="detailPoint.data.name"
    >
      <div
        class="scroll-box"
      >
        <div
          v-if="detailPoint.data.address!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Адрес
          </div>
          {{ detailPoint.data.address }}
        </div>
        <div
          v-if="detailPoint.data.contact_person_fio!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Контактное лицо
          </div>
          {{ detailPoint.data.contact_person_fio }}
        </div>
        <div
          v-if="detailPoint.data.contact_person_phone!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Телефон
          </div>
          {{ detailPoint.data.contact_person_phone }}
        </div>
        <div
          v-if="detailPoint.data.contact_person_email!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Email
          </div>
          <a :href="'mailto:'+detailPoint.data.contact_person_email">{{ detailPoint.data.contact_person_email }}</a>
        </div>
      </div>
    </el-dialog>

    <div class="content-box">
      <div
        v-if="pointList===null"
        class="hello-box"
      >
        Для поиска выберите муниципалитет
      </div>
      <div
        v-else
        class="scroll-box"
      >
        <div
          v-if="pointList.length===0"
          class="hello-box"
        >
          По вашему запросу ничего не найдено
        </div>

        <div
          v-for="item in pointList"
          :key="'pointList'+item.id"
          class="item-point-info"
          @click="setDetail(item)"
        >
          <div><span>{{ item.name }}</span></div>
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
            v-model="filter.municipality_id"
            class="filter-select"
            placeholder="Выберите муниципалитет"
            filterable
            clearable
            :value-on-clear="null"
            @change="getHumanitarianPoints()"
          >
            <el-option
              v-for="item in municipalityList"
              :key="'municipalityList'+item.id"
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
import {useAppStore} from '../../store/index.js';

export default {
  name: 'ViHumanitarianPoints',
  data() {
    return {
      loader: false,
      loadFilterData: false,
      filterWatch: false,
      filter: {
        municipality_id: null,
      },
      municipalityList: [],
      pointList: null,
      detailPoint: {
        active: false,
        data: null,
      }
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI']),
  },
  created() {
    this.getMunicipalities();
    this.startParams();
    this.getHumanitarianPoints();
  },
  methods: {
    getMunicipalities() {
      this.loadFilterData = true;
      this.$axios.get(this.linkAPI + 'widget/humanitarian_points/get_municipalities')
        .then((response) => {
          console.log('Муниципалитеты: ', response.data);
          this.municipalityList = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadFilterData = false;
        });
    },
    getHumanitarianPoints() {
      this.loader = true;
      this.$axios.get(this.linkAPI + 'widget/humanitarian_points/get_humanitarian_points', {params: this.filter})
        .then((response) => {
          console.log('Пункты: ', response.data);
          this.pointList = response.data;
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
      if (this.$route.query.municipality_id) {
        this.filter.municipality_id = parseInt(this.$route.query.municipality_id);
      }
    },
    setDetail(point) {
      this.detailPoint.data = point;
      this.detailPoint.active = true;
    }
  }
};
</script>

<style scoped>
.vi-humanitarian-points {
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

.item-point-info {
  display: flex;
  gap: 10px;
  align-items: baseline;

  margin-bottom: 15px;
  padding: 0 25px;

  font-family: Montserrat, sans-serif;
  font-size: 16px;
  font-weight: 400;
  line-height: 170%;
}

.item-point-info:hover {
  cursor: pointer;
  color: #005ae1;
}

.item-point-info::before {
  content: '';

  width: 7px;
  min-width: 7px;
  height: 7px;
  border-radius: 10px;

  background: #005ae1;

}

.item-point-info div {
  width: fit-content;
}

.item-point-info div span {
  display: inline;
  padding-bottom: 2px;
  border-bottom: 1px solid rgb(0 0 0 / 10%);
}

.item-title-form {
  margin-bottom: 5px;
  font-size: 16px;
  font-weight: 600;
}



</style>

<style>
.el-dialog.point-box {
  display: grid;
  grid-template-rows: auto 1fr;
  max-height: calc(100dvh - 40px);
  border-radius: 15px
}

.el-dialog.point-box .el-dialog__body {
  display: contents;

  font-family: Montserrat, sans-serif;
  font-size: 16px;
  font-weight: 400;
  line-height: 135%;
  color: #000;
}

.el-dialog.point-box .el-dialog__title {
  font-family: Montserrat, sans-serif;
  font-size: 18px;
  font-weight: 500;
  line-height: 140%;
  color: #000;
}

.el-dialog.point-box ul, .el-dialog.point-box ol {
  padding-left: 0;
}

.el-dialog.point-box ul li, .el-dialog.point-box ol li {
  position: relative;

  display: inline-block;

  margin-bottom: 5px;
  padding-left: 15px;

  list-style: none;
}

.el-dialog.point-box li::before {
  content: '';

  position: absolute;
  top: 7px;
  left: 0;

  width: 7px;
  height: 7px;
  border-radius: 100%;

  background: #264ABF;
}
</style>

