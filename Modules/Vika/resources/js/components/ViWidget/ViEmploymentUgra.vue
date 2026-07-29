<template>
  <div
    v-loading="loader"
    class="vi-employment-ugra"
  >
    <el-dialog
      v-if="detailQuestion.active"
      v-model="detailQuestion.active"
      class="question-box"
      :close-on-click-modal="false"
      top="20px"
      width="calc(100% - 40px)"
      :title="detailQuestion.data.question"
    >
      <div
        class="scroll-box"
      >
        <div v-html="detailQuestion.data.answer" />
      </div>
    </el-dialog>

    <div class="content-box">
      <div
        v-if="questionList===null"
        class="hello-box"
      >
        Для поиска выберите категорию
      </div>
      <div
        v-else
        class="scroll-box"
      >
        <div
          v-if="questionList.length===0"
          class="hello-box"
        >
          По вашему запросу ничего не найдено
        </div>

        <div
          v-for="item in questionList"
          :key="'questionList'+item.id"
          class="item-social-info"
          @click="setDetail(item)"
        >
          <div><span>{{ item.question }}</span></div>
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
            Категории
          </div>
          <el-select
            v-model="filter.category_id"
            class="filter-select"
            placeholder="Выберите категорию"
            filterable
            clearable
            :value-on-clear="null"
            @change="getQuestions()"
          >
            <el-option
              v-for="item in categoriesList"
              :key="'categoriesList'+item.id"
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
  name: 'ViEmploymentUgra',
  data() {
    return {
      loader: false,
      loadFilterData: false,
      filterWatch: false,
      filter: {
        category_id: null,
      },
      categoriesList: [],
      questionList: null,
      detailQuestion: {
        active: false,
        data: null,
      }
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI']),
  },
  created() {
    this.getCategories();
    this.startParams();
    this.getQuestions();
  },
  methods: {
    getCategories() {
      this.loadFilterData = true;
      this.$axios.get(this.linkAPI + 'widget/employment_ugra/get_categories')
        .then((response) => {
          console.log('Категории: ', response.data);
          this.categoriesList = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadFilterData = false;
        });
    },
    getQuestions() {
      this.loader = true;
      this.$axios.get(this.linkAPI + 'widget/employment_ugra/get_questions', {params: this.filter})
        .then((response) => {
          console.log('Вопросы: ', response.data);
          this.questionList = response.data;
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
      if (this.$route.query.category_id) {
        this.filter.category_id = parseInt(this.$route.query.category_id);
      }
    },
    setDetail(question) {
      this.detailQuestion.data = question;
      this.detailQuestion.active = true;
    }
  }
};
</script>

<style scoped>
.vi-employment-ugra {
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

.close {
  cursor: pointer;

  position: absolute;
  top: 25px;
  right: 25px;

  width: 20px;
  height: 20px;

  background-color: #8d8d8d;

  mask-image: url("../../../assets/img/close.svg");
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 12px;
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
