<template>
  <div
    v-loading="loader"
    class="vi-social-help"
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
          v-if="detailMeasure.data.live_in_ugra_years!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Срок проживания в Югре
          </div>
          {{ detailMeasure.data.live_in_ugra_years }}
        </div>

        <div
          v-if="detailMeasure.data.max_family_income!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Максимальный среднедушевой доход семьи
          </div>
          {{ detailMeasure.data.max_family_income }}
        </div>

        <div
          v-if="detailMeasure.data.max_child_age!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Максимальный возраст младшего ребёнка
          </div>
          {{ detailMeasure.data.max_child_age }}
        </div>

        <div
          v-if="detailMeasure.data.min_amount!==null || detailMeasure.data.max_amount"
          class="item-form"
        >
          <div class="item-title-form">
            Размер выплаты
          </div>
          {{ detailMeasure.data.min_amount }}
          {{ detailMeasure.data.min_amount!==null && detailMeasure.data.max_amount!==null ? ' — ' : '' }}
          {{ detailMeasure.data.max_amount }}
        </div>

        <div
          v-if="detailMeasure.data.situation!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Жизненная ситуация
          </div>
          {{ detailMeasure.data.situation.name }}
        </div>

        <div
          v-if="detailMeasure.data.preferential_categories!==null && detailMeasure.data.preferential_categories.length!==0"
          class="item-form"
        >
          <div class="item-title-form">
            Жизненная ситуация
          </div>
          <ul>
            <li
              v-for="item in detailMeasure.data.preferential_categories"
              :key="'preferential_categories'+item.id"
            >
              {{ item.name }}
            </li>
          </ul>
        </div>

        <div
          v-if="detailMeasure.data.condition!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Условия получения поддержки
          </div>
          {{ detailMeasure.data.conditions }}
        </div>
        <div
          v-if="detailMeasure.data.amount_and_deadlines!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Размер и сроки выплаты поддержки
          </div>
          {{ detailMeasure.data.amount_and_deadlines }}
        </div>
        <div
          v-if="detailMeasure.data.law!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Правовые основания выплаты
          </div>
          {{ detailMeasure.data.law }}
        </div>
      </div>

      <template
        v-if="detailMeasure.data.epgu_link!==null"
        #footer
      >
        <div class="dialog-footer">
          <el-button
            class="filter-button"
            style="width: 100%"
            type="primary"
            @click="setLink(detailMeasure.data.epgu_link)"
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
            Жизненная ситуация
          </div>
          <el-select
            v-model="filter.situation_id"
            class="filter-select"
            placeholder="Выберите ситуацию"
            clearable
            filterable
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
            Льготные категории
          </div>
          <el-select
            v-model="filter.preferential_categories"
            class="filter-select"
            placeholder="Выберите категории"
            filterable
            clearable
            multiple
            collapse-tags
            collapse-tags-tooltip
            :max-collapse-tags="1"
          >
            <el-option
              v-for="item in categoriesList"
              :key="'categoriesList'+item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
        </div>
        <div class="item-form">
          <div class="title-form">
            Дата переезда в Югру
          </div>
          <el-date-picker
            v-model="filter.date_relocation"
            type="date"
            placeholder="Дата"
            format="DD.MM.YYYY"
            value-format="DD.MM.YYYY"
            style="width: 100%"
            class="filter-data-picker"
            :value-on-clear="null"
          />
        </div>
        <div class="item-form">
          <div class="title-form">
            Дата рождения младшего ребёнка
          </div>
          <el-date-picker
            v-model="filter.child_birthday"
            type="date"
            placeholder="Дата"
            format="DD.MM.YYYY"
            value-format="DD.MM.YYYY"
            style="width: 100%"
            class="filter-data-picker"
            :value-on-clear="null"
          />
        </div>
        <div
          class="item-form"
          style="margin-bottom: 15px"
        >
          <div class="title-form">
            Суммарный доход семьи в месяц
          </div>
          <el-input-number
            v-model="filter.income"
            placeholder="Введите число"
            clearable
            :controls="false"
            style="width: 100%"
            class="filter-input-number"
            :value-on-clear="null"
          />
          <div class="description-form">
            Средний за 3 последних месяца
          </div>
        </div>
        <div class="item-form">
          <div class="title-form">
            Количество членов семьи
          </div>
          <el-input-number
            v-model="filter.family_members_count"
            placeholder="Введите число"
            clearable
            :controls="false"
            style="width: 100%"
            class="filter-input-number"
            :value-on-clear="null"
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

export default {
  name: 'ViSocialHelp',
  data() {
    return {
      loader: false,
      measuresList: null,
      filterWatch: false,
      loadFilterData: false,
      filter: {
        situation_id: null,
        preferential_categories: [],
        date_relocation: null,
        child_birthday: null,
        income: null,
        family_members_count: null
      },
      categoriesList: [],
      situationsList: [],
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
    Promise.all([this.getPreferentialCategories(), this.getSituations()]).finally(
      () => {
        this.loadFilterData = false;
      }
    );
    this.getMeasures();
  },
  methods: {
    async getPreferentialCategories() {
      try {
        let response = await this.$axios.get(this.linkAPI + 'widget/social_support/get_preferential_categories');
        console.log('Категории: ', response.data);
        this.categoriesList = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async getSituations() {
      try {
        let response = await this.$axios.get(this.linkAPI + 'widget/social_support/get_situations');
        console.log('Ситуации: ', response.data);
        this.situationsList = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    getMeasures() {
      this.loader = true;
      this.$axios.get(this.linkAPI + 'widget/social_support/get_measures', {params: this.filter})
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
      if (this.$route.query.situation_id) {
        this.filter.situation_id = parseInt(this.$route.query.situation_id);
      }
      if (this.$route.query['preferential_categories[]']) {
        if(Array.isArray(this.$route.query['preferential_categories[]'])){
          this.filter.preferential_categories = this.$route.query['preferential_categories[]'].map(item=>{
            return parseInt(item);
          });
        }else{
          this.filter.preferential_categories = [parseInt(this.$route.query['preferential_categories[]'])];
        }
      }
      if (this.$route.query.date_relocation) {
        this.filter.date_relocation = this.$route.query.date_relocation;
      }
      if (this.$route.query.child_birthday) {
        this.filter.child_birthday = this.$route.query.child_birthday;
      }
      if (this.$route.query.income) {
        this.filter.income = parseInt(this.$route.query.income);
      }
      if (this.$route.query.family_members_count) {
        this.filter.family_members_count = parseInt(this.$route.query.family_members_count);
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
.vi-social-help {
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

.description-form {
  margin-top: 5px;
  font-family: Montserrat, sans-serif;
  font-size: 12px;
  font-weight: 300;
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


