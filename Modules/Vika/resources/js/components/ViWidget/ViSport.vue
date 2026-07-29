<template>
  <div
    v-loading="loader"
    class="vi-sport"
  >
    <div class="content-box">
      <div
        v-if="sectionList===null"
        class="hello-box"
      >
        Для того чтобы найти спортивную секцию,<br>
        укажите город, вид спорта и возраст
      </div>
      <div
        v-else
        ref="sportList"
        class="scroll-box"
        @scroll="handleScroll"
      >
        <div
          v-if="sectionList.length===0"
          class="hello-box"
        >
          По вашему запросу ничего не найдено
        </div>
        <div
          v-for="item in sectionList"
          :key="'sectionList'+item.id"
          :class="['item-sport',item.active ? 'active' : '']"
          @click="setActive(item.id)"
        >
          <div
            v-if="item.active"
            class="close"
            title="Закрыть"
            @click.stop.prevent="item.active=false"
          />

          <div class="plot">
            <div
              v-if="item.sport!==null"
              class="sport-name"
            >
              {{ item.sport.name }}
            </div>
            <div class="plot-name">
              {{ item.trainer!==null ? item.trainer.name : 'Нет тренера' }}
            </div>
            <div
              v-if="item.trainer!==null && item.trainer.category!==null && item.active"
              class="category"
            >
              {{ item.trainer.category }}
            </div>
            <div class="address">
              <i />
              {{ item.city !== null ? item.city.name : '' }} {{ item.street !== null ? item.street : '' }}
              {{ item.house !== null ? item.house : '' }}
            </div>
          </div>

          <a
            v-if="item.trainer!==null && item.trainer.phone!==null"
            :href="'tel:'+item.trainer.phone"
            class="phone"
          ><i />{{
            item.trainer.phone
          }}</a>


          <div
            v-if="item.active"
            class="detail-box"
          >
            <div class="age">
              Возраст: {{ item.age_min }} - {{ item.age_max }}
            </div>
            <div
              v-if="item.organisation!==null"
              :class="['timetable', item.sportCompanyActive ? 'active' : '']"
              @click="item.sportCompanyActive=!item.sportCompanyActive; item.timeTableActive=false"
            >
              Организация
            </div>
            <div
              v-if="item.schedule!==null"
              :class="['timetable', item.timeTableActive ? 'active' : '']"
              @click="item.sportCompanyActive=false; item.timeTableActive=!item.timeTableActive"
            >
              Расписание
            </div>

            <!-- Информация об организации -->
            <div
              v-if="item.sportCompanyActive"
              class="sport-org-box"
            >
              <div
                v-if="item.organisation!==null && item.organisation.name!==null"
                class="sport-org-name"
              >
                {{ item.organisation.name }}
              </div>

              <div
                class="address"
              >
                <i />{{ item.organisation.city !== null ? item.organisation.city.name : '' }}
                {{ item.organisation.street !== null ? item.organisation.street : '' }}
                {{ item.organisation.house !== null ? item.organisation.house : '' }}
              </div>

              <a
                v-if="item.organisation!==null && item.organisation.phone!==null"
                :href="'tel:'+item.organisation.phone"
                class="phone"
              ><i />{{
                item.organisation.phone
              }}</a>

              <a
                v-if="item.organisation!==null && item.organisation.site!==null"
                :href="item.organisation.site"
                target="_blank"
                class="link"
              >{{
                item.organisation.site
              }}</a>

              <a
                v-if="item.organisation!==null && item.organisation.email!==null"
                :href="'mailto:'+item.organisation.email"
                class="link"
              >{{
                item.organisation.email
              }}</a>
            </div>

            <div
              v-if="item.timeTableActive"
              class="couch-timetable"
            >
              <div class="timetable-tag">
                Расписание занятий
              </div>
              <div class="item-box">
                <div
                  v-if="item.schedule.monday"
                  class="couch-timetable-item"
                >
                  <!--День недели-->
                  <div class="day-week">
                    Пн
                  </div>
                  <div class="day-time">
                    {{ item.schedule.monday }}
                  </div>
                </div>

                <div
                  v-if="item.schedule.tuesday"
                  class="couch-timetable-item"
                >
                  <!--День недели-->
                  <div class="day-week">
                    Вт
                  </div>
                  <div class="day-time">
                    {{ item.schedule.tuesday }}
                  </div>
                </div>

                <div
                  v-if="item.schedule.wednesday "
                  class="couch-timetable-item"
                >
                  <!--День недели-->
                  <div class="day-week">
                    Ср
                  </div>
                  <div class="day-time">
                    {{ item.schedule.wednesday }}
                  </div>
                </div>

                <div
                  v-if="item.schedule.thursday"
                  class="couch-timetable-item"
                >
                  <!--День недели-->
                  <div class="day-week">
                    Чт
                  </div>
                  <div class="day-time">
                    {{ item.schedule.thursday }}
                  </div>
                </div>

                <div
                  v-if="item.schedule.friday"
                  class="couch-timetable-item"
                >
                  <!--День недели-->
                  <div class="day-week">
                    Пт
                  </div>
                  <div class="day-time">
                    {{ item.schedule.friday }}
                  </div>
                </div>

                <div
                  v-if="item.schedule.saturday"
                  class="couch-timetable-item"
                >
                  <!--День недели-->
                  <div class="day-week">
                    Сб
                  </div>
                  <div class="day-time">
                    {{ item.schedule.saturday }}
                  </div>
                </div>

                <div
                  v-if="item.schedule.sunday"
                  class="couch-timetable-item"
                >
                  <!--День недели-->
                  <div class="day-week">
                    Вс
                  </div>
                  <div class="day-time">
                    {{ item.schedule.sunday }}
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
            Город
          </div>
          <el-select
            v-model="filter.city_id"
            class="filter-select"
            placeholder="Выберите город"
            filterable
            clearable
            :value-on-clear="null"
            @change="getSportTypes(); filter.sport_id=null;"
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
            Вид спорта
          </div>
          <el-select
            v-model="filter.sport_id"
            class="filter-select"
            placeholder="Выберите вид спорта"
            clearable
            :value-on-clear="null"
            filterable
            :loading="loadFilterSportType"
          >
            <el-option
              v-for="item in sportTypeList"
              :key="'sportTypeList'+item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
        </div>
        <div class="item-form">
          <div class="title-form">
            Возраст
          </div>
          <el-input
            v-model="filter.age"
            placeholder="Введите число"
            clearable
            class="filter-input"
            @keyup.enter="getSections()"
          />
        </div>
        <el-button
          class="filter-button"
          style="width: 100%"
          type="primary"
          @click="getSections()"
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
  name: 'ViSport',
  data() {
    return {
      loader: false,
      sectionList: null,
      filterWatch: false,
      loadFilterData: false,
      loadFilterSportType: false,
      filter: {
        city_id: null,
        sport_id: null,
        age: null,
      },
      cityList: [],
      sportTypeList: [],
      next_cursor: null,
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI']),
  },
  created() {
    this.startParams();
    this.loadFilterData = true;
    Promise.all([this.getCities(), this.getSportTypes()]).finally(() => {
      this.loadFilterData = false;
    });
    this.getSections();
  },
  methods: {
    async getCities() {
      try {
        let response = await this.$axios.get(this.linkAPI + 'widget/sport_sections/get_cities');
        console.log('Города: ', response.data);
        this.cityList = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async getSportTypes() {
      try {
        this.loadFilterSportType = true;
        let params = {
          city_id: this.filter.city_id,
        };
        let response = await this.$axios.get(this.linkAPI + 'widget/sport_sections/get_sport_types', {params});
        console.log('Типы спортивных секций: ', response.data);
        this.sportTypeList = response.data;
      } catch (error) {
        console.log(error);
      } finally {
        this.loadFilterSportType = false;
      }
    },
    getSections() {
      this.loader = true;
      this.$axios.get(this.linkAPI + 'widget/sport_sections/get_sections', {params: this.filter})
        .then((response) => {
          console.log('Секции: ', response.data);
          this.sectionList = response.data.data.map(item => {
            return {...item, active: false, sportCompanyActive: false, timeTableActive: false,};
          });
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
    getSectionsScroll() {
      this.loader = true;
      let params = {...this.filter, cursor: this.next_cursor};
      this.$axios.get(this.linkAPI + 'widget/sport_sections/get_sections', {params})
        .then((response) => {
          console.log('Секции: ', response.data);
          this.sectionList.push(...response.data.data.map(item => {
            return {...item, active: false, sportCompanyActive: false, timeTableActive: false,};
          }));
          this.next_cursor = response.data.next_cursor;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loader = false;
        });
    },
    setActive(id) {
      this.sectionList.forEach((item) => {
        item.active = false;
      });
      this.sectionList.find(item => item.id === id).active = true;
    },
    startParams() {
      if (this.$route.query.city_id) {
        this.filter.city_id = parseInt(this.$route.query.city_id);
      }
      if (this.$route.query.sport_id) {
        this.filter.sport_id = parseInt(this.$route.query.sport_id);
      }
      if (this.$route.query.age) {
        this.filter.age = this.$route.query.age;
      }
    },
    handleScroll() {
      const box = this.$refs.sportList;
      //console.log(box.scrollTop + box.clientHeight);
      //console.log(box.scrollHeight);
      if ((Math.abs(box.scrollHeight - box.scrollTop - box.clientHeight) === 0 || Math.abs(box.scrollHeight - box.scrollTop - box.clientHeight) === 0.5) && this.next_cursor !== null) {
        this.getSectionsScroll();
      }
    },
  }
};
</script>

<style scoped>
.vi-sport {
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


.item-sport {
  cursor: pointer;

  position: relative;

  padding: 25px;
  border-bottom: 1px solid #d6dae4;

  font-family: Montserrat, sans-serif;
  color: #000;

  transition: 0.3s ease;
}

.item-sport:last-child {
  border-bottom: none;
}

.item-sport:hover {
  background: #f2f4fb;
}

.item-sport.active {
  cursor: initial;
  box-shadow: 0 0 20px rgb(0 0 0 / 30%);
}

.item-sport.active:hover {
  background: #fff;
}

.item-sport .sport-name {
  margin-bottom: 20px;
  font-size: 14px;
  font-weight: 500;
}

.item-sport .category {
  margin-top: 7px;
  font-size: 13px;
  font-weight: 400;
}

.item-sport .address {
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

.item-sport .age {
  display: inline-block;

  margin: 0 5px;
  padding: 7px 12px;
  border: 1px solid #dcdfea;
  border-radius: 5px;

  font-size: 14px;
  font-weight: 500;
  color: #454852;

  background: #fff;
}

.item-sport .address i {
  width: 9px;
  height: 13px;

  background-color: #BCBFCA;

  mask-image: url("../../../assets/img/location.svg");
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 9px;
}


.item-sport .plot {
  margin-bottom: 10px;
}

.item-sport .plot-name {
  margin-bottom: 3px;
  padding-right: 25px;
  font-size: 16px;
  font-weight: 600;
}

.item-sport .phone {
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

.item-sport .phone i {
  width: 16px;
  height: 16px;

  background-color: #a2a8bd;

  mask-image: url("../../../assets/img/phone.svg");
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 12px;
}


.item-sport .link {
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

.item-sport .sport-org-box {
  margin-top: 15px;
}

.item-sport .sport-org-name {
  display: table;

  width: 100%;
  margin-bottom: 13px;
  padding-bottom: 9px;
  border-bottom: 1px solid #dbdde4;

  font-size: 15px;
  font-weight: 600;
  color: #000;
}

.item-sport .timetable {
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

.item-sport .timetable:hover {
  color: #fff;
  background: #8194d4;
}

.item-sport .timetable.active {
  color: #fff;
  background: #264ABF;
}

.couch-timetable {
  margin-top: 15px;
}

.couch-timetable .item-box {
  display: flex;
  flex-wrap: wrap;
  gap: 40px;
  row-gap: 20px;
}

.couch-timetable .couch-timetable-item {
  width: 80px;
}

.couch-timetable .couch-timetable-item .day-week {
  margin-bottom: 4px;
  font-size: 12px;
  font-weight: 500;
  color: #888ea5;
}

.couch-timetable .timetable-tag {
  display: table;

  margin-bottom: 13px;
  padding-bottom: 9px;
  border-bottom: 1px solid #dbdde4;

  font-size: 15px;
  font-weight: 600;
  color: #000;
}

.couch-timetable .day-time {
  font-size: 14px;
  font-weight: 600;
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

