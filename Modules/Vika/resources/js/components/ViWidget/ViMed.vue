<template>
  <div
    v-loading="loader"
    class="vi-med"
  >
    <div class="content-box">
      <div
        v-if="medCompanyList===null"
        class="hello-box"
      >
        Чтобы определить медицинский участок,<br>
        укажите город, улицу и номер дома
      </div>
      <div
        v-else
        class="scroll-box"
      >
        <div
          v-if="medCompanyList.length===0"
          class="hello-box"
        >
          По вашему запросу ничего не найдено
        </div>
        <div
          v-for="item in medCompanyList"
          :key="'med'+item.id"
          :class="['item-med',item.active ? 'active' : '']"
          @click="setActive(item.id)"
        >
          <div
            v-if="item.active"
            class="close"
            title="Закрыть"
            @click.stop.prevent="item.active=false"
          />

          <div class="plot">
            <div class="plot-name">
              Участок {{ item.type }} № {{ item.number }}
            </div>
            <div class="address">
              <i />
              {{ item.address !== null ? item.address : 'Адрес не известен' }}
            </div>
          </div>

          <a
            v-if="item.district_search_widget_hospital.phone!==null"
            :href="'tel:'+item.district_search_widget_hospital.phone"
            class="phone"
          ><i />{{
            item.district_search_widget_hospital.phone
          }}</a>


          <div
            v-if="item.active"
            class="detail-box"
          >
            <div
              :class="['timetable', item.medCompanyActive ? 'active' : '']"
              @click="item.medCompanyActive=!item.medCompanyActive; item.timeTableActive=false"
            >
              Организация
            </div>
            <div
              v-if="item.district_search_widget_doctors!==null && item.district_search_widget_doctors.length!==0"
              :class="['timetable', item.timeTableActive ? 'active' : '']"
              @click="item.medCompanyActive=false; item.timeTableActive=!item.timeTableActive"
            >
              Расписание
            </div>

            <!-- Информация об организации -->
            <div
              v-if="item.medCompanyActive"
              class="med-org-box"
            >
              <div
                v-if="item.district_search_widget_hospital.name!==null"
                class="med-org-name"
              >
                {{ item.district_search_widget_hospital.name }}
              </div>

              <div
                v-if="item.district_search_widget_hospital!==null && item.district_search_widget_hospital.address!==null"
                class="address"
              >
                <i />{{ item.district_search_widget_hospital.address }}
              </div>

              <a
                v-if="item.district_search_widget_hospital!==null && item.district_search_widget_hospital.phone!==null"
                :href="'tel:'+item.district_search_widget_hospital.phone"
                class="phone"
              ><i />{{
                item.district_search_widget_hospital.phone
              }}</a>

              <a
                v-if="item.district_search_widget_hospital!==null && item.district_search_widget_hospital.site!==null"
                :href="'//'+item.district_search_widget_hospital.site"
                target="_blank"
                class="link"
              >{{
                item.district_search_widget_hospital.site
              }}</a>

              <a
                v-if="item.district_search_widget_hospital!==null && item.district_search_widget_hospital.email!==null"
                :href="'mailto:'+item.district_search_widget_hospital.email"
                class="link"
              >{{
                item.district_search_widget_hospital.email
              }}</a>
            </div>

            <div
              v-if="item.timeTableActive"
              class="timetable-box"
            >
              <div
                v-for="itemDoc in item.district_search_widget_doctors"
                :key="'doc'+itemDoc.id"
                class="doc-item"
              >
                <div class="doc-name">
                  {{ itemDoc.last_name }} {{ itemDoc.first_name }} {{ itemDoc.middle_name }}
                </div>
                <div
                  v-if="itemDoc.phone!==null"
                  class="phone"
                >
                  <i />{{ itemDoc.phone }}
                </div>
                <div class="timetable-tabs">
                  <div
                    class="timetable-tab-item"
                    :class="{ active: itemDoc.timeTable === 'H'}"
                    @click="itemDoc.timeTable = 'H'"
                  >
                    Четная неделя
                  </div>
                  <!--По нажатию меняется четность недели-->
                  <div
                    class="timetable-tab-item"
                    :class="{ active: itemDoc.timeTable === 'N'}"
                    @click="itemDoc.timeTable = 'N'"
                  >
                    Нечетная неделя
                  </div>
                  <!--По нажатию меняется четность недели-->
                </div>
                <div v-if="itemDoc.timeTable === 'N'">
                  <div
                    v-for="(itemTimeTable, indexItemTimeTable) in itemDoc.odd_week_timetable_records"
                    :key="'odd_week_timetable_records'+itemDoc.id+'-'+itemTimeTable.day_number+'-'+indexItemTimeTable"
                    class="doctor-timetable-item"
                  >
                    <div class="day-week">
                      {{ getDay(itemTimeTable.day_number) }}
                    </div>
                    <div class="day-time">
                      {{ itemTimeTable.time !== null ? itemTimeTable.time : '—' }}
                    </div>
                    <div class="break-time">
                      <i />{{ itemTimeTable.break_time !== null ? itemTimeTable.break_time : '—' }}
                    </div>
                  </div>
                </div>
                <div v-if="itemDoc.timeTable === 'H'">
                  <div
                    v-for="(itemTimeTable, indexItemTimeTable) in itemDoc.even_week_timetable_records"
                    :key="'even_week_timetable_records'+itemDoc.id+'-'+itemTimeTable.day_number+'-'+indexItemTimeTable"
                    class="doctor-timetable-item"
                  >
                    <div class="day-week">
                      {{ getDay(itemTimeTable.day_number) }}
                    </div>
                    <div class="day-time">
                      {{ itemTimeTable.time !== null ? itemTimeTable.time : '—' }}
                    </div>
                    <div class="break-time">
                      <i />{{ itemTimeTable.break_time !== null ? itemTimeTable.break_time : '—' }}
                    </div>
                  </div>
                </div>
              </div>
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
            v-model="filter.city_id"
            class="filter-select"
            placeholder="Выберите город"
            filterable
            @change="getStreets(); filter.street_id=null;"
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
            Улица
          </div>
          <el-select
            v-model="filter.street_id"
            class="filter-select"
            placeholder="Выберите улицу"
            filterable
          >
            <el-option
              v-for="item in streetList"
              :key="'street'+item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
        </div>
        <div class="item-form">
          <div class="title-form">
            Дом
          </div>
          <el-input
            v-model="filter.house_number"
            placeholder="Дом"
            clearable
            class="filter-input"
            @keyup.enter="filter.house_number.trim().length!==0 ? getDistricts() : ''"
          />
        </div>
        <el-button
          class="filter-button"
          style="width: 100%"
          type="primary"
          :disabled="filter.house_number.trim().length===0 || filter.street_id===null"
          @click="getDistricts()"
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
  name: 'ViMed',
  data() {
    return {
      loader: false,
      medCompanyList: null,
      filterWatch: true,
      loadFilterData: false,
      filter: {
        city_id: null,
        street_id: null,
        house_number: '',
      },
      cityList: [],
      streetList: [],
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI']),
  },
  created() {
    this.getCities();
    this.startParams();
  },
  methods: {
    getCities() {
      this.loadFilterData = true;
      this.$axios.get(this.linkAPI + 'widget/district_search/get_cities')
        .then((response) => {
          console.log('Города: ', response.data);
          this.cityList = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadFilterData = false;
        });
    },
    getStreets() {
      this.loadFilterData = true;
      let params = {
        city_id: this.filter.city_id,
      };
      this.$axios.get(this.linkAPI + 'widget/district_search/get_streets', {params})
        .then((response) => {
          console.log('Улицы: ', response.data);
          this.streetList = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadFilterData = false;
        });
    },
    getDistricts() {
      this.loader = true;
      let params = {
        street_id: this.filter.street_id,
        house_number: this.filter.house_number
      };
      this.$axios.get(this.linkAPI + 'widget/district_search/get_districts', {params})
        .then((response) => {
          console.log('Медицинские участки: ', response.data);
          this.medCompanyList = response.data.map(item => {
            let result = {...item, active: false, medCompanyActive: false, timeTableActive: false,};
            result.district_search_widget_doctors = result.district_search_widget_doctors.map(itemDoctor => {
              return {...itemDoctor, timeTable: 'H'};
            });
            return result;
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
    setActive(id) {
      this.medCompanyList.forEach((item) => {
        item.active = false;
      });
      this.medCompanyList.find(item => item.id === id).active = true;
    },
    getDay(number) {
      switch (number) {
        case 1 :
          return 'Понедельник';
        case 2 :
          return 'Вторник';
        case 3 :
          return 'Среда';
        case 4 :
          return 'Четверг';
        case 5 :
          return 'Пятница';
        case 6 :
          return 'Суббота';
        case 7 :
          return 'Воскресенье';
      }
    },
    startParams(){
      if(this.$route.query.city_id){
        this.filter.city_id = parseInt(this.$route.query.city_id);
        this.getStreets();
      }
      if(this.$route.query.street_id){
        this.filter.street_id = parseInt(this.$route.query.street_id);
      }
      if(this.$route.query.house_number){
        this.filter.house_number = this.$route.query.house_number;
      }
      if(this.filter.street_id!==null && this.filter.house_number!==null && this.filter.house_number.trim().length!==0){
        this.getDistricts();
      }
    }
  }
};
</script>

<style scoped>
.vi-med {
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


.item-med {
  cursor: pointer;

  position: relative;

  padding: 25px;
  border-bottom: 1px solid #d6dae4;

  font-family: Montserrat, sans-serif;
  color: #000;

  transition: 0.3s ease;
}

.item-med:last-child {
  border-bottom: none;
}

.item-med:hover {
  background: #f2f4fb;
}

.item-med.active {
  cursor: initial;
  box-shadow: 0 0 20px rgb(0 0 0 / 30%);
}

.item-med.active:hover {
  background: #fff;
}

.item-med .address {
  display: flex;
  gap: 5px;
  align-items: center;
  justify-content: flex-start;

  margin-top: 8px;

  font-size: 13px;
  font-weight: 500;
  line-height: 160%;
  color: #5D616D;
}

.item-med .address i {
  width: 9px;
  height: 13px;

  background-color: #BCBFCA;

  mask-image: url("../../../assets/img/location.svg");
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 9px;
}


.item-med .plot {
  margin-bottom: 10px;
}

.item-med .plot-name {
  margin-bottom: 3px;
  padding-right: 25px;
  font-size: 16px;
  font-weight: 600;
}

.item-med .phone {
  display: flex;
  gap: 5px;
  align-items: center;
  justify-content: flex-start;

  width: max-content;
  margin-top: 15px;

  font-size: 16px;
  font-weight: 500;
  color: #264abf;
  text-decoration: none;
}

.item-med .phone i {
  width: 16px;
  height: 16px;

  background-color: #a2a8bd;

  mask-image: url("../../../assets/img/phone.svg");
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 12px;
}


.item-med .link {
  display: table;

  margin-top: 10px;
  padding-bottom: 1px;
  border-bottom: 1px solid rgb(33 106 205 / 30%);

  font-size: 15px;
  font-weight: 500;
  color: #264abf;
  text-decoration: none;
}

.link:hover {
  padding-bottom: 2px;
  border: 0;
}

.item-med .med-org-box {
  margin-top: 15px;
}

.item-med .med-org-name {
  display: table;

  width: 100%;
  margin-bottom: 13px;
  padding-bottom: 9px;
  border-bottom: 1px solid #dbdde4;

  font-size: 15px;
  font-weight: 600;
  color: #000;
}

.item-med .timetable {
  cursor: pointer;

  display: inline-block;

  margin: 10px 5px;
  padding: 7px 12px;
  border: 1px solid #f2f4fb;
  border-radius: 5px;

  font-size: 15px;
  font-weight: 500;
  color: #216acd;

  background: #f2f4fb;

  transition: 0.3s ease;
}

.item-med .timetable:hover {
  color: #fff;
  background: #8194d4;
}

.item-med .timetable.active {
  color: #fff;
  background: #264ABF;
}

.doc-item {
  margin-bottom: 10px;
  padding-bottom: 10px;
  border-bottom: 1px solid #dbdde4;
}

.doc-name {
  margin-bottom: 3px;
  font-size: 16px;
  font-weight: 600;
}

.timetable-box .doc-item:last-child {
  margin-bottom: 0;
  padding-bottom: 0;
  border-bottom: none;
}

.timetable-box {
  margin-top: 20px;
}

.timetable-tabs {
  display: flex;
  gap: 10px;
  justify-content: flex-start;

  margin-top: 20px;
  margin-bottom: 20px;
}

.timetable-tab-item {
  cursor: pointer;

  padding: 5px 10px;
  border-radius: 5px;

  font-family: Montserrat, sans-serif;
  font-size: 14px;

  background: #e0e6ee;
}

.timetable-tab-item.active {
  border-radius: 5px;
  color: #fff;
  background: #264abf;
}

.doctor-timetable-item {
  display: flex;
  flex-wrap: wrap;
  column-gap: 10px;
  margin-bottom: 3px;
}

.doctor-timetable-item .day-week {
  width: 125px;
  font-size: 15px;
  font-weight: 500;
}

.doctor-timetable-item .day-time, .doctor-timetable-item .break-time {
  width: 120px;
  font-size: 15px;
  font-weight: 500;
}

.doctor-timetable-item .break-time {
  display: flex;
  flex-wrap: nowrap;
  gap: 2px;
  align-items: center;
  justify-content: flex-start;
}

.doctor-timetable-item .break-time i {
  width: 20px;
  height: 17px;
  background: url("../../../assets/img/dinner.png") no-repeat center;
  background-size: 80%;
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
</style>

