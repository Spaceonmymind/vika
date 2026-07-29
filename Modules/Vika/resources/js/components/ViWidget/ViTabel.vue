<template>
  <div
    v-loading="loader"
    class="vi-tabel"
  >
    <div class="content-box">
      <div
        v-if="employeesList===null"
        class="hello-box"
      >
        Для того чтобы найти интересующего вас сотрудника,<br>
        в строке поиска необходимо ввести ФИО
      </div>
      <div
        v-else
        class="scroll-box"
      >
        <div
          v-if="employeesList.length===0"
          class="hello-box"
        >
          По вашему запросу ничего не найдено
        </div>

        <div
          v-for="item in employeesList"
          :key="'employees'+item.global_id"
          :class="['people-item',item.active ? 'active' : '']"
          @click="!item.active ? setActive(item.global_id) : ''"
        >
          <div
            v-if="item.active"
            class="close"
            @click.stop.prevent="item.active=false"
          />

          <div class="post">
            {{ item.post }}
          </div>
          <div :class="['fio',item.active ? 'active' : '']">
            {{ item.name }}
          </div>
          <div
            v-if="item.active"
            class="position"
            v-html="getOrgById(item.organization_id)"
          />

          <div
            v-if="item.active"
            v-loading="loadCalendar"
            style="margin-top: 30px"
          >
            <Calendar
              expanded
              :attributes="attributes"
              :value="currentDate"
              @did-move="onMonthChanged"
            />
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
            Организация
          </div>
          <el-select
            v-model="filter.organization_id"
            class="filter-select"
            placeholder="Выберите организацию"
            filterable
            clearable
            :value-on-clear="null"
          >
            <el-option
              v-for="item in orgList"
              :key="'orgList'+item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
        </div>
        <div class="item-form">
          <div class="title-form">
            ФИО
          </div>
          <el-input
            v-model="filter.fio"
            placeholder="ФИО"
            clearable
            class="filter-input"
            @keyup.enter="filter.fio.trim().length!==0 ? getEmployees() : ''"
          />
        </div>
        <el-button
          class="filter-button"
          style="width: 100%"
          type="primary"
          :disabled="filter.fio.trim().length===0"
          @click="getEmployees()"
        >
          Искать
        </el-button>
      </div>
    </div>
  </div>
</template>

<script>

import {useAppStore} from '../../store/index.js';
import moment from 'moment';
import {Calendar} from 'v-calendar';
import 'v-calendar/style.css';

export default {
  name: 'ViTabel',
  components:{
    Calendar,
  },
  data() {
    return {
      loader: false,
      loadFilterData: false,
      loadCalendar: false,
      orgList: [],
      filterWatch: true,
      filter: {
        organization_id: null,
        fio: '',
      },
      employeesList: null,
      currentDate: new Date(),
      activeGuid: null,
      attributes: [],
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI']),
  },
  created() {
    this.getOrganizations();
    this.startParams();
  },
  methods: {
    getOrganizations() {
      this.loadFilterData = true;
      this.$axios.get(this.linkAPI + 'widget/timetable/get_organizations')
          .then((response) => {
            console.log('Организации: ', response.data);
            this.orgList = response.data;
          })
          .catch((error) => {
            console.log(error);
          })
          .finally(() => {
            this.loadFilterData = false;
          });
    },
    getEmployees() {
      this.loader = true;
      this.$axios.get(this.linkAPI + 'widget/timetable/get_employees', {params: this.filter})
          .then((response) => {
            console.log('Поиск сотрудников: ', response.data);
            this.employeesList = response.data.map(item => {
              return {...item, active: false, attributes: []};
            });
            this.filterWatch = false;
          })
          .catch((error) => {
            console.log(error);
          })
          .finally(() => {
            this.loader = false;
          });
    },
    async getTimetable(guid, month, year) {
      try {
        this.loadCalendar = true;
        let params = {
          employee_uuid: guid,
          month: month,
          year: year,
        };
        let response = await this.$axios.get(this.linkAPI + 'widget/timetable/get_timetable', {params});
        console.log('Табель: ', response.data);
        this.attributes = response.data.map(item => {

          let date = moment(item.date, 'DD.MM.YYYY');
          let day = {
            key: item.status,
            dates: new Date(date),
            popover: {},
          };
          switch (item.status) {
            case 'А':
              day.highlight = 'red';
              day.popover.label = 'Неявки с разрешения администрации';
              break;
            case 'Б':
              day.highlight = 'blue';
              day.popover.label = 'Больничный';
              break;
            case 'Т':
              day.highlight = 'blue';
              day.popover.label = 'Больничный неоплачиваемый';
              break;
            case 'БЗ':
              day.highlight = 'yellow';
              day.popover.label = 'Отпуск без сохранения денежного содержания';
              break;
            case 'В':
              day.highlight = 'red';
              day.popover.label = 'Выходные дни';
              break;
            case 'ВМ':
              day.highlight = 'red';
              day.popover.label = 'Вахта';
              break;
            case 'ВЧ':
              day.highlight = 'gray';
              day.popover.label = 'Вечерние часы';
              break;
            case 'ВУ':
              day.highlight = 'yellow';
              day.popover.label = 'Сокр.время обучающихся без отрыва от производства';
              break;
            case 'Г':
              day.highlight = 'red';
              day.popover.label = 'Выполнение государственных обязанностей';
              break;
            case 'Д':
              day.highlight = 'gray';
              day.popover.label = 'Диспансеризация';
              break;
            case 'ДБ':
              day.highlight = 'yellow';
              day.popover.label = 'Доп. отпуск без сохранения заработной платы';
              break;
            case 'ДЖ':
              day.highlight = 'yellow';
              day.popover.label = 'Дежурство';
              break;
            case 'ДН':
              day.highlight = 'yellow';
              day.popover.label = 'Дежурство (ночные)';
              break;
            case 'ДП1':
              day.highlight = 'yellow';
              day.popover.label = 'Дежурство (празд/вых х1)';
              break;
            case 'ДП2':
              day.highlight = 'yellow';
              day.popover.label = 'Дежурство (празд/вых х2)';
              break;
            case '262':
              day.highlight = 'yellow';
              day.popover.label = 'Дети-инвалиды';
              break;
            case 'ДВ':
              day.highlight = 'red';
              day.popover.label = 'Дни в пути (вахта)';
              break;
            case 'ДО':
              day.highlight = 'yellow';
              day.popover.label = 'Отпуск неоплачиваемый с разрешения работодателя';
              break;
            case 'ЗБ':
              day.highlight = 'red';
              day.popover.label = 'Забастовка';
              break;
            case 'К':
              day.highlight = 'green';
              day.popover.label = 'Командировка';
              break;
            case 'КО':
              day.highlight = 'yellow';
              day.popover.label = 'Краткосрочный оплачиваемый отпуск по колдоговору';
              break;
            case 'КР':
              day.highlight = 'gray';
              day.popover.label = 'Перерывы для кормления ребенка';
              break;
            case 'ЛЧ':
              day.highlight = 'gray';
              day.popover.label = 'Сокращенное рабочее время в соответствии с законом';
              break;
            case 'МО':
              day.highlight = 'red';
              day.popover.label = 'Междувахтовый отдых';
              break;
            case 'Н':
              day.highlight = 'gray';
              day.popover.label = 'Ночные часы';
              break;
            case 'НБ':
              day.highlight = 'red';
              day.popover.label = 'Отстранение от работы без оплаты';
              break;
            case 'НО':
              day.highlight = 'red';
              day.popover.label = 'Отстранение от работы с оплатой';
              break;
            case 'НВ':
              day.highlight = 'red';
              day.popover.label = 'Работа в избирательной кампании по выборам';
              break;
            case 'НЗ':
              day.highlight = 'red';
              day.popover.label = 'Приостановка работы в случае задержки выплаты з/п';
              break;
            case 'НН':
              day.highlight = 'gray';
              day.popover.label = 'Неявки по невыясненным причинам';
              break;
            case 'НП':
              day.highlight = 'red';
              day.popover.label = 'Простой, не зависящий от работодателя и работника';
              break;
            case 'НС':
              day.highlight = 'red';
              day.popover.label = 'Работа в режиме неполного рабочего времени';
              break;
            case 'О':
              day.highlight = 'yellow';
              day.popover.label = 'Отпуск';
              break;
            case 'ОД':
              day.highlight = 'yellow';
              day.popover.label = 'Дополнительный отпуск северный';
              break;
            case 'ОВ':
              day.highlight = 'yellow';
              day.popover.label = 'Дополнительные выходные дни (оплачиваемые)';
              break;
            case 'ОН':
              day.highlight = 'yellow';
              day.popover.label = 'Оплачиваемые нерабочие дни';
              break;
            case 'ОТ':
              day.highlight = 'yellow';
              day.popover.label = 'Отпуск';
              break;
            case 'ОУ':
              day.highlight = 'yellow';
              day.popover.label = 'Отпуск дополнительный (оплачиваемый учебный)';
              break;
            case 'ОЗ':
              day.highlight = 'yellow';
              day.popover.label = 'Отпуск неоплачиваемый в соответствии с законом';
              break;
            case 'ОР':
              day.highlight = 'yellow';
              day.popover.label = 'Отпуск по уходу за ребенком';
              break;
            case 'П':
              day.highlight = 'red';
              day.popover.label = 'Прогул';
              break;
            case 'ПВ':
              day.highlight = 'gray';
              day.popover.label = 'Время вынужденного прогула';
              break;
            case 'ПК':
              day.highlight = 'green';
              day.popover.label = 'Повышение квалификации';
              break;
            case 'ПМ':
              day.highlight = 'green';
              day.popover.label = 'Повышение квалификации в другой местности';
              break;
            case 'ПР':
              day.highlight = 'gray';
              day.popover.label = 'Время простоя по вине работодателя';
              break;
            case 'ПТД':
              day.highlight = 'red';
              day.popover.label = 'Приостановление трудового договора';
              break;
            case 'Р':
              day.highlight = 'yellow';
              day.popover.label = 'Отпуск по беременности и родам';
              break;
            case 'РП':
              day.highlight = 'red';
              day.popover.label = 'Работа в выходные и нерабочие праздничные дни';
              break;
            case 'С':
              day.highlight = 'green';
              day.popover.label = 'Сверхурочно';
              break;
            case 'СН':
              day.highlight = 'gray';
              day.popover.label = 'Сверхурочные без повышенной оплаты';
              break;
            case 'У':
              day.highlight = 'yellow';
              day.popover.label = 'Учебный отпуск с сохранением заработной платы';
              break;
            case 'УД':
              day.highlight = 'yellow';
              day.popover.label = 'Отпуск дополнительный (неоплачиваемый учебный)';
              break;
            case 'Я':
              day.highlight = 'gray';
              day.popover.label = 'Явка';
              break;
            default:
              day.highlight = 'gray';
              day.popover.label = 'Не известно';
          }
          return day;
        });
      } catch (error) {
        console.log(error);
      } finally {
        this.loadCalendar = false;
      }

    },
    getOrgById(id) {
      let org = this.orgList.find(item => item.id === id);
      if (org !== undefined) {
        return org.name;
      } else {
        return '—';
      }
    },
    setActive(guid) {
      this.employeesList.forEach((item) => {
        item.active = false;
      });
      this.attributes = [];
      this.activeGuid = guid;
      this.getTimetable(this.activeGuid,(this.currentDate.getMonth() + 1),this.currentDate.getFullYear());
      this.employeesList.find(item => item.global_id === guid).active = true;
    },
    onMonthChanged(page) {
      this.getTimetable(this.activeGuid,page[0].month,page[0].year);
    },
    startParams(){
      if(this.$route.query.organization_id){
        this.filter.organization_id = parseInt(this.$route.query.organization_id);
      }
      if(this.$route.query.fio){
        this.filter.fio = this.$route.query.fio;
      }
      if(this.filter.fio.trim().length!==0){
        this.getEmployees();
      }
    }
  }
};
</script>

<style scoped>
.vi-tabel {
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

.people-item {
  cursor: pointer;

  position: relative;

  padding: 25px ;
  border-bottom: 1px solid #d6dae4;

  font-family: Montserrat, sans-serif;
  color: #000;

  transition: .3s ease;
}

.people-item:hover {
  background: #f2f4fb;
}

.people-item.active {
  cursor: initial;

  padding: 25px;

  color: #000;

  background: #fff;
  box-shadow: 0 0 20px rgb(0 0 0 / 30%);
}

.people-item:last-child{
  border-bottom: none;
}

.people-item .post {
  margin-bottom: 10px;

  font-size: 13px;
  font-weight: 500;
  line-height: 130%;
  color: #5d616d;
}

.people-item .fio {
  font-size: 18px;
  font-weight: 600;
}


.people-item .position {
  margin-top: 6px;
  font-size: 15px;
  font-weight: 400;
}

</style>

<style>
.vc-container{
  font-family: Montserrat, sans-serif;
}

.vc-bordered {
  border: 1px solid #d6dae4;
  border-radius: 15px;
}

.vc-header .vc-title, .vc-header .vc-prev, .vc-header .vc-next {
  border-radius: 15px;
}

.vc-header .vc-title {
  padding: 0 17px;
  font-family: Montserrat, sans-serif;
  font-weight: 500;
}

.vc-header {
  margin: 20px;
  padding: 0;
}

.vc-weeks{
  padding: 0;
}

.vc-week, .vc-weekdays {
  margin-bottom: 10px;
}

.vc-header .vc-arrow {
  width: 30px;
  color: #264abf;
}

.vc-popover-content {
  padding: 15px;
  border: 1px solid #d6dae4;
  border-radius: 15px;
  background-color: #fff;
}

.vc-nav-arrow {
  width: 30px;
  height: 30px;
  border-radius: 15px;
  color: #264abf;
}

.vc-nav-header {
  gap: 5px;
  margin-bottom: 10px;
}

.vc-nav-items {
  grid-gap: 10px;
  margin-top: 17px;
}

.vc-nav-title, .vc-nav-arrow, .vc-nav-item {
  border-radius: 15px;
}

.vc-nav-title {
  padding: 0 15px;
  font-family: Montserrat, sans-serif;
  font-weight: 600;
}

.vc-nav-item {
  width: 50px;
  padding: 8px 0;
  font-family: Montserrat, sans-serif;
  font-weight: 400;
}

.vc-nav-item.is-active {
  background-color: #264abf;
}

</style>
