<template>
  <div
    v-loading="loader"
    class="vi-culture-ugra"
  >
    <el-dialog
      v-if="detailActivity.active"
      v-model="detailActivity.active"
      class="detail-dialog-box"
      :close-on-click-modal="false"
      top="20px"
      width="calc(100% - 40px)"
      :title="detailActivity.data.name"
    >
      <div
        class="scroll-box"
      >
        <div
          v-if="detailActivity.data.locality!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Населённый пункт
          </div>
          {{ detailActivity.data.locality.name }}
        </div>

        <div
          v-if="detailActivity.data.description!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Описание мероприятия
          </div>
          {{ detailActivity.data.description }}
        </div>

        <div
          v-if="detailActivity.data.start_date!==null || detailActivity.data.end_date!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Период проведения
          </div>
          {{ detailActivity.data.start_date!==null ? getDate(detailActivity.data.start_date) : '' }} {{
            detailActivity.data.end_date !== null ? ' —	' + getDate(detailActivity.data.end_date) : ''
          }}
        </div>

        <div
          v-if="detailActivity.data.organization_name!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Организатор
          </div>
          {{ detailActivity.data.organization_name }}
        </div>

        <div
          v-if="detailActivity.data.address!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Адрес
          </div>
          {{ detailActivity.data.address }}
        </div>
      </div>

      <template
        v-if="detailActivity.data.buy_link!==null"
        #footer
      >
        <div class="dialog-footer">
          <el-button
            class="filter-button"
            style="width: 100%"
            type="primary"
            @click="setLink(detailActivity.data.buy_link)"
          >
            {{ detailActivity.data.buy_text!==null ? detailActivity.data.buy_text : 'Купить билет' }}
          </el-button>
        </div>
      </template>
    </el-dialog>

    <div class="content-box">
      <div
        v-if="activityList===null"
        class="hello-box"
      >
        Для поиска выберите населенный пункт
      </div>
      <div
        v-else
        class="scroll-box"
      >
        <div
          v-if="activityList.length===0"
          class="hello-box"
        >
          По вашему запросу ничего не найдено
        </div>

        <div
          v-for="item in activityList"
          :key="'activityList'+item.id"
          class="item-social-info"
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
            Населённый пункт
          </div>
          <el-select
            v-model="filter.locality_id"
            class="filter-select"
            placeholder="Выберите населённый пункт"
            filterable
            clearable
            :value-on-clear="null"
            @change="getEvents()"
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
import {useAppStore} from '../../store/index.js';
import moment from 'moment';

export default {
  name: 'ViCultureUgra',
  data() {
    return {
      loader: false,
      loadFilterData: false,
      filterWatch: false,
      filter: {
        locality_id: null,
      },
      localityList: [],
      activityList: null,
      detailActivity: {
        active: false,
        data: null,
      }
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI']),
  },
  created() {
    this.getLocalities();
    this.startParams();
    this.getEvents();
  },
  methods:{
    getLocalities() {
      this.loadFilterData = true;
      this.$axios.get(this.linkAPI + 'widget/culture_ugra/get_localities')
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
    getEvents() {
      this.loader = true;
      this.$axios.get(this.linkAPI + 'widget/culture_ugra/get_events', {params: this.filter})
        .then((response) => {
          console.log('События: ', response.data);
          this.activityList = response.data;
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
    setDetail(activity) {
      this.detailActivity.data = activity;
      this.detailActivity.active = true;
    },
    setLink(link) {
      window.open(link);
    },
    getDate(date) {
      return moment(date).format( 'DD.MM.YYYY');
    },
  }
};
</script>

<style scoped>
.vi-culture-ugra {
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

.item-social-info {
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

.item-social-info:hover {
  cursor: pointer;
  color: #005ae1;
}

.item-social-info::before {
  content: '';

  width: 7px;
  min-width: 7px;
  height: 7px;
  border-radius: 10px;

  background: #005ae1;

}

.item-social-info div {
  width: fit-content;
}

.item-social-info div span {
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
.el-dialog.detail-dialog-box {
  display: grid;
  grid-template-rows: auto 1fr auto;
  max-height: calc(100dvh - 40px);
  border-radius: 15px
}

.el-dialog.detail-dialog-box .el-dialog__body {
  display: contents;

  font-family: Montserrat, sans-serif;
  font-size: 16px;
  font-weight: 400;
  line-height: 135%;
  color: #000;
}

.el-dialog.detail-dialog-box .el-dialog__title {
  font-family: Montserrat, sans-serif;
  font-size: 18px;
  font-weight: 500;
  line-height: 140%;
  color: #000;
}

.el-dialog.detail-dialog-box ul, .el-dialog.detail-dialog-box ol {
  padding-left: 0;
}

.el-dialog.detail-dialog-box ul li, .el-dialog.detail-dialog-box ol li {
  position: relative;

  display: inline-block;

  margin-bottom: 5px;
  padding-left: 15px;

  list-style: none;
}

.el-dialog.detail-dialog-box li::before {
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
