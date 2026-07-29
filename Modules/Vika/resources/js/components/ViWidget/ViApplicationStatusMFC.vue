<template>
  <div
    v-loading="loader"
    class="vi-application-status-mfc"
  >
    <div class="content-box">
      <div
        v-if="searchResult===null"
        class="hello-box"
      >
        Поиск осуществляется по номеру заявления или СНИЛС
      </div>
      <div
        v-else
        class="scroll-box"
      >
        <div
          v-if="searchResult.length===0"
          class="hello-box"
        >
          По вашему запросу ничего не найдено
        </div>

        <div
          v-for="(item,index) in searchResult"
          :key="'application'+index"
          class="item-application"
        >
          <div
            v-if="item.created_date"
            class="element"
          >
            {{ getDate(item.created_date) }}
          </div>
          <div
            v-if="item.reg_num"
            class="element reg-num"
          >
            <span>Номер дела:</span> {{ item.reg_num }}
          </div>
          <div
            v-if="item.case_number"
            class="element reg-num"
          >
            <span>СНИЛС:</span> {{ item.case_number }}
          </div>
          <div
            v-if="item.status_text"
            class="element status"
          >
            <span>Статус:</span> {{ item.status_text }}
          </div>
          <div
            v-if="item.result_text"
            class="element result-text"
          >
            <span>Ответ:</span> {{ item.result_text }}
          </div>
          <div
            v-if="item.service_name"
            class="element service-name"
          >
            <span>Наименование услуги:</span>
            {{ item.service_name }}
          </div>
          <div
            v-if="item.mfc_address"
            class="element address"
          >
            <span>Адрес:</span> {{ item.mfc_address }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="filter-box">
    <div class="filter">
      <div class="title-filter">
        Укажите номер заявления или СНИЛС
      </div>
      <div class="filter-input-box">
        <el-input
          v-model="number"
          placeholder="Поиск"
          clearable
          class="filter-input filter-input-button"
          @keyup.enter="number.trim().length===0 ? '' : getApplicationStatus()"
        />
        <div
          class="search-button"
          title="Искать"
          @click="number.trim().length===0 ? '' : getApplicationStatus()"
        />
      </div>
    </div>
  </div>
</template>

<script>
import {mapState} from 'pinia';
import {useAppStore} from '../../store/index.js';
import moment from 'moment';


export default {
  name: 'ViApplicationStatusMFC',
  data() {
    return {
      searchResult: null,
      number: '',
      loader: false,
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI']),
  },
  created() {
    this.startParams();
  },
  methods: {
    getApplicationStatus(){
      this.loader = true;
      let params = {
        number: this.number
      };
      this.$axios.get(this.linkAPI + 'widget/mfc_application_status/get_application_status', {params})
        .then((response) => {
          console.log('Результаты поиска дела: ', response.data);
          this.searchResult = response.data.found_applications;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loader = false;
        });
    },
    startParams() {
      if (this.$route.query.number) {
        this.number = this.$route.query.number;
      }
      if (this.number.trim().length !== 0) {
        this.getApplicationStatus();
      }
    },
    getDate(date){
      return date!==undefined && date!== null ? moment(date, 'YYYY-MM-DD').format('DD.MM.YYYY') : '-';
    }
  }
};
</script>

<style scoped>
.vi-application-status-mfc {
  display: grid;
  grid-template-rows: calc(100% - 175px) 175px;
}

.hello-box {
  padding: 0 25px;

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

.filter-input-box{
  position: relative;
}

.search-button {
  cursor: pointer;

  position: absolute;
  top: 0;
  right: 0;

  width: 50px;
  height: 50px;

  background: url("../../../assets/img/search.png") center no-repeat;
}

.item-application {
  margin: 0 25px 20px;
  padding-bottom: 20px;
  border-bottom: 1px solid #dadfe1;
  font-family: Montserrat, sans-serif;
}

.item-application:last-child{
  border-bottom: none;
}

.item-application span {
  display: table;

  margin-bottom: 5px;

  font-size: 15px;
  font-weight: 500;
  color: #6d7691;
}

.item-application .element {
  margin-bottom: 10px;
  font-weight: 500;
  line-height: 150%;
}

.item-application .reg-num {
  font-size: 18px;
  font-weight: bold;
}

.item-application .status {
  display: table;

  padding: 7px 13px;
  border-radius: 5px;

  font-size: 16px;
  font-weight: 600;

  background: #ffecb3;
}

</style>

<style>
.filter-input-button  .el-input__wrapper {
  padding: 0 50px 0 20px;
}

</style>
