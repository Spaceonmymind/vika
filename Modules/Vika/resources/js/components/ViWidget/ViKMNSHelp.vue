<template>
  <div
    v-loading="loader"
    class="vi-kmns-help"
  >
    <el-dialog
      v-if="detailMeasure.active"
      v-model="detailMeasure.active"
      class="detail-dialog-box"
      :close-on-click-modal="false"
      top="20px"
      width="calc(100% - 40px)"
      :title="detailMeasure.data.name"
    >
      <div
        class="scroll-box"
      >
        <div
          v-if="detailMeasure.data.activity_type!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Сфера жизнедеятельности
          </div>
          {{ detailMeasure.data.activity_type.name }}
        </div>

        <div
          v-if="detailMeasure.data.support_organisation!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Организация, оказывающая услугу
          </div>
          {{ detailMeasure.data.support_organisation }}
        </div>

        <div
          v-if="detailMeasure.data.subject!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Получатель услуги
          </div>
          {{ detailMeasure.data.subject }}
        </div>

        <div
          v-if="detailMeasure.data.terms!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Сроки оказания услуги
          </div>
          {{ detailMeasure.data.terms }}
        </div>

        <div
          v-if="detailMeasure.data.apply_types!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Способы подачи
          </div>
          {{ detailMeasure.data.apply_types }}
        </div>

        <div
          v-if="detailMeasure.data.get_result_types!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Способы получения результата
          </div>
          {{ detailMeasure.data.get_result_types }}
        </div>

        <div
          v-if="detailMeasure.data.measure_result!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Результат оказания услуги
          </div>
          {{ detailMeasure.data.measure_result }}
        </div>

        <div
          v-if="detailMeasure.data.documents!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Документы, необходимые для получения услуги
          </div>
          {{ detailMeasure.data.documents }}
        </div>
      </div>

      <template
        v-if="detailMeasure.data.link!==null"
        #footer
      >
        <div class="dialog-footer">
          <el-button
            class="filter-button"
            style="width: 100%"
            type="primary"
            @click="setLink(detailMeasure.data.link)"
          >
            Получить услугу через ЕПГУ
          </el-button>
        </div>
      </template>
    </el-dialog>

    <div class="content-box">
      <div
        v-if="measuresList===null"
        class="hello-box"
      >
        Необходимо указать параметры
      </div>
      <div
        v-else
        class="scroll-box"
      >
        <div
          v-if="measuresList.length===0"
          class="hello-box"
        >
          По вашему запросу ничего не найдено
        </div>

        <div
          v-for="item in measuresList"
          :key="'measuresList'+item.id"
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
          Укажите параметры
        </div>
        <div class="item-form">
          <div class="title-form">
            Сферы жизнедеятельности
          </div>
          <el-select
            v-model="filter.activity_type_id"
            class="filter-select"
            placeholder="Выберите сферу"
            clearable
            filterable
            :value-on-clear="null"
          >
            <el-option
              v-for="item in activityTypeList"
              :key="'activityTypeList'+item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
        </div>
        <div class="item-form">
          <div class="title-form">
            Название услуги
          </div>
          <el-input
            v-model="filter.name"
            placeholder="Введите название услуги"
            clearable
            class="filter-input"
          />
        </div>
        <el-button
          class="filter-button"
          style="width: 100%"
          type="primary"
          @click="getMeasures()"
        >
          Искать
        </el-button>
      </div>
    </div>
  </div>
</template>

<script>
import {useAppStore} from '../../store/index.js';

export default{
  name: 'ViKMNSHelp',
  data() {
    return {
      loader: false,
      measuresList: null,
      filterWatch: false,
      loadFilterData: false,
      filter: {
        name: null,
        activity_type_id: null,
      },
      activityTypeList: [],
      detailMeasure: {
        active: false,
        data: null,
      }
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI']),
  },
  created() {
    this.startParams();
    this.loadFilterData = true;
    Promise.all([this.getActivityTypes()]).finally(
      () => {
        this.loadFilterData = false;
      }
    );
    this.getMeasures();
  },
  methods: {
    async getActivityTypes() {
      try {
        let response = await this.$axios.get(this.linkAPI + 'widget/kmns_support/get_activity_types');
        console.log('Сферы жизнедеятельности: ', response.data);
        this.activityTypeList = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    getMeasures() {
      this.loader = true;
      this.$axios.get(this.linkAPI + 'widget/kmns_support/get_measures', {params: this.filter})
        .then((response) => {
          console.log('Меры поддержки: ', response.data);
          this.measuresList = response.data;
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
      if (this.$route.query.name) {
        this.filter.name = this.$route.query.name;
      }
      if (this.$route.query.activity_type_id) {
        this.filter.activity_type_id = parseInt(this.$route.query.activity_type_id);
      }
    },
    setDetail(measure) {
      this.detailMeasure.data = measure;
      this.detailMeasure.active = true;
    },
    setLink(link) {
      window.open(link);
    }
  }
};
</script>

<style scoped>
.vi-kmns-help {
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
