<template>
  <div
    v-loading="loader"
    class="vi-business-help"
  >
    <el-dialog
      v-if="measureDetail.active"
      v-model="measureDetail.active"
      class="question-box"
      :close-on-click-modal="false"
      top="20px"
      width="calc(100% - 40px)"
      :title="measureDetail.data.name"
    >
      <div
        class="scroll-box"
      >
        <div
          v-if="measureDetail.data.business_support_widget_support_type!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Вид меры поддержки
          </div>
          {{ measureDetail.data.business_support_widget_support_type.name }}
        </div>

        <div
          v-if="measureDetail.data.business_support_widget_situation!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Жизненная ситуация
          </div>
          {{ measureDetail.data.business_support_widget_situation.name }}
        </div>

        <div
          v-if="measureDetail.data.business_support_widget_registration_place!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Место регистрации заявителя
          </div>
          {{ measureDetail.data.business_support_widget_registration_place.name }}
        </div>

        <div
          v-if="measureDetail.data.business_support_widget_subject!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Получатели поддержки
          </div>
          {{ measureDetail.data.business_support_widget_subject.name }}
        </div>

        <div
          v-if="measureDetail.data.business_support_widget_support_organisation!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Организация, предоставляющая меру поддержки
          </div>
          {{ measureDetail.data.business_support_widget_support_organisation.name }}
        </div>

        <div
          v-if="measureDetail.data.description!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Описание меры поддержки
          </div>
          {{ measureDetail.data.description }}
        </div>

        <div
          v-if="measureDetail.data.conditions!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Условия получения меры поддержки
          </div>
          {{ measureDetail.data.conditions }}
        </div>

        <div
          v-if="measureDetail.data.activities!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Виды деятельности организации
          </div>
          {{ measureDetail.data.activities }}
        </div>

        <div
          v-if="measureDetail.data.financial_support!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Размер выплаты
          </div>
          {{ measureDetail.data.financial_support }}
        </div>

        <div
          v-if="measureDetail.data.terms!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Сроки выплаты
          </div>
          {{ measureDetail.data.terms }}
        </div>

        <div
          v-if="measureDetail.data.law!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Правовые основания
          </div>
          {{ measureDetail.data.law }}
        </div>

        <div
          v-if="measureDetail.data.revenue_year!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Выручка на конец года
          </div>
          {{ measureDetail.data.revenue_year }}
        </div>

        <div
          v-if="measureDetail.data.company_age!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Возраст компании
          </div>
          {{ measureDetail.data.company_age }}
        </div>

        <div
          v-if="measureDetail.data.documents!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Набор необходимых документов
          </div>
          {{ measureDetail.data.documents }}
        </div>

        <div
          v-if="measureDetail.data.date_receipt_documents!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Дата приёма документов
          </div>
          {{ measureDetail.data.date_receipt_documents }}
        </div>

        <div
          v-if="measureDetail.data.employees!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Количество сотрудников организации
          </div>
          {{ measureDetail.data.employees }}
        </div>

        <div
          v-if="measureDetail.data.contacts!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Контакты
          </div>
          {{ measureDetail.data.contacts }}
        </div>
      </div>
    </el-dialog>

    <div class="content-box">
      <div
        v-if="measuresList===null"
        class="hello-box"
      >
        Для поиска выберите категорию
      </div>
      <div
        v-else
        ref="measuresList"
        class="scroll-box"
        @scroll="handleScroll"
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
          class="item-business-info"
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
            Организация, предоставляющая меру поддержки
          </div>
          <el-select
            v-model="filter.support_organisation_id"
            class="filter-select"
            placeholder="Выберите организацию"
            filterable
            clearable
            :value-on-clear="null"
          >
            <el-option
              v-for="item in supportOrganisationsList"
              :key="'supportOrganisationsList'+item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
        </div>
        <div class="item-form">
          <div class="title-form">
            Вид меры поддержки
          </div>
          <el-select
            v-model="filter.support_type_id"
            class="filter-select"
            placeholder="Выберите вид"
            filterable
            clearable
            :value-on-clear="null"
          >
            <el-option
              v-for="item in supportTypesList"
              :key="'supportTypesList'+item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
        </div>
        <div class="item-form">
          <div class="title-form">
            Жизненная ситуация
          </div>
          <el-select
            v-model="filter.situation_id"
            class="filter-select"
            placeholder="Выберите ситуацию"
            filterable
            clearable
            :value-on-clear="null"
          >
            <el-option
              v-for="item in situationsList"
              :key="'situationsList'+item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
        </div>
        <div class="item-form">
          <div class="title-form">
            Получатели поддержки
          </div>
          <el-select
            v-model="filter.subject_id"
            class="filter-select"
            placeholder="Выберите получателя"
            filterable
            clearable
            :value-on-clear="null"
          >
            <el-option
              v-for="item in subjectsList"
              :key="'subjectsList'+item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
        </div>
        <div class="item-form">
          <div class="title-form">
            Место регистрации заявителя
          </div>
          <el-select
            v-model="filter.registration_place_id"
            class="filter-select"
            placeholder="Выберите место"
            filterable
            clearable
            :value-on-clear="null"
          >
            <el-option
              v-for="item in registrationPlacesList"
              :key="'registrationPlacesList'+item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
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

export default {
  name: 'ViBusinessHelp',
  data() {
    return {
      loader: false,
      loadFilterData: false,
      filterWatch: false,
      filter: {
        situation_id: null,
        subject_id: null,
        registration_place_id: null,
        support_organisation_id: null,
        support_type_id: null,
      },
      situationsList: [],
      subjectsList: [],
      registrationPlacesList: [],
      supportOrganisationsList: [],
      supportTypesList: [],
      measuresList: null,
      measureDetail: {
        active: false,
        data: null,
      },
      next_cursor: null,
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI']),
  },
  created() {
    this.startParams();

    this.loadFilterData = true;
    Promise.all([
      this.getSituations(),
      this.getSubjects(),
      this.getRegistrationPlaces(),
      this.getSupportOrganisations(),
      this.getSupportTypes()
    ]).finally(
      () => {
        this.loadFilterData = false;
      }
    );

    this.getMeasures();
  },
  methods: {
    async getSituations() {
      try {
        let response = await this.$axios.get(this.linkAPI + 'widget/business_support/get_situations');
        console.log('Ситуации: ', response.data);
        this.situationsList = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async getSubjects() {
      try {
        let response = await this.$axios.get(this.linkAPI + 'widget/business_support/get_subjects');
        console.log('Получатели поддержки: ', response.data);
        this.subjectsList = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async getRegistrationPlaces() {
      try {
        let response = await this.$axios.get(this.linkAPI + 'widget/business_support/get_registration_places');
        console.log('Места регистрации: ', response.data);
        this.registrationPlacesList = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async getSupportOrganisations() {
      try {
        let response = await this.$axios.get(this.linkAPI + 'widget/business_support/get_support_organisations');
        console.log('Организации поддержки: ', response.data);
        this.supportOrganisationsList = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async getSupportTypes() {
      try {
        let response = await this.$axios.get(this.linkAPI + 'widget/business_support/get_support_types');
        console.log('Типы поддержки: ', response.data);
        this.supportTypesList = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    getMeasures() {
      this.loader = true;
      let params = {...this.filter};
      if (this.next_cursor !== null) {
        params.cursor = this.next_cursor;
      }
      this.$axios.get(this.linkAPI + 'widget/business_support/get_measures', {params})
        .then((response) => {
          console.log('Меры поддержки: ', response.data);
          this.measuresList = response.data.data;
          this.next_cursor = response.data.next_cursor;
          this.filterWatch = false;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loader = false;
        });
    },
    getMeasuresScroll() {
      this.loader = true;
      let params = {...this.filter, cursor: this.next_cursor};
      this.$axios.get(this.linkAPI + 'widget/business_support/get_measures', {params})
        .then((response) => {
          console.log('Меры поддержки: ', response.data);
          this.measuresList.push(...response.data.data);
          this.next_cursor = response.data.next_cursor;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loader = false;
        });
    },
    startParams() {
      if (this.$route.query.situation_id) {
        this.filter.situation_id = parseInt(this.$route.query.situation_id);
      }
      if (this.$route.query.subject_id) {
        this.filter.subject_id = parseInt(this.$route.query.subject_id);
      }
      if (this.$route.query.registration_place_id) {
        this.filter.registration_place_id = parseInt(this.$route.query.registration_place_id);
      }
      if (this.$route.query.support_organisation_id) {
        this.filter.support_organisation_id = parseInt(this.$route.query.support_organisation_id);
      }
      if (this.$route.query.support_type_id) {
        this.filter.support_type_id = parseInt(this.$route.query.support_type_id);
      }
    },
    setDetail(measure) {
      this.measureDetail.data = measure;
      this.measureDetail.active = true;
    },
    handleScroll() {
      const box = this.$refs.measuresList;
      //console.log(box.scrollTop + box.clientHeight);
      //console.log(box.scrollHeight);
      if ((Math.abs(box.scrollHeight - box.scrollTop - box.clientHeight) === 0 || Math.abs(box.scrollHeight - box.scrollTop - box.clientHeight) === 0.5) && this.next_cursor !== null) {
        this.getMeasuresScroll();
      }
    },
  }
};
</script>

<style scoped>
.vi-business-help {
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

.item-business-info {
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

.item-business-info:hover {
  cursor: pointer;
  color: #005ae1;
}

.item-business-info::before {
  content: '';

  width: 7px;
  min-width: 7px;
  height: 7px;
  border-radius: 10px;

  background: #005ae1;

}

.item-business-info div {
  width: fit-content;
}

.item-business-info div span {
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
.el-dialog.question-box {
  display: grid;
  grid-template-rows: auto 1fr;
  max-height: calc(100dvh - 40px);
  border-radius: 15px
}

.el-dialog.question-box .el-dialog__body {
  display: contents;

  font-family: Montserrat, sans-serif;
  font-size: 16px;
  font-weight: 400;
  line-height: 135%;
  color: #000;
}

.el-dialog.question-box .el-dialog__title {
  font-family: Montserrat, sans-serif;
  font-size: 18px;
  font-weight: 500;
  line-height: 140%;
  color: #000;
}

.el-dialog.question-box ul, .el-dialog.question-box ol {
  padding-left: 0;
}

.el-dialog.question-box ul li, .el-dialog.question-box ol li {
  position: relative;

  display: inline-block;

  margin-bottom: 5px;
  padding-left: 15px;

  list-style: none;
}

.el-dialog.question-box li::before {
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
