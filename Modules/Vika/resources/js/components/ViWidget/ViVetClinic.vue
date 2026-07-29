<template>
  <div
    v-loading="loader"
    class="vi-vet-clinic"
  >
    <div class="content-box">
      <div
        v-if="clinicList===null"
        class="hello-box"
      >
        Для поиска выберите муниципалитет
      </div>
      <div
        v-else
        class="scroll-box"
      >
        <div class="start-text">
          <a
            target="_blank"
            href="https://animals.admhmao.ru/animals/product-public"
          >
            Ознакомиться с товарами и услугами для животных
          </a>
        </div>
        <div
          v-if="clinicList.length===0"
          class="hello-box"
        >
          По вашему запросу ничего не найдено
        </div>
        <div class="content">
          <el-collapse
            v-if="clinicList.length!==0"
            v-model="active"
            class="clinic-list"
            accordion
          >
            <el-collapse-item
              v-for="itemCity in clinicList"
              :key="'city'+itemCity.id"
              class="clinic-box"
              :title="itemCity.name"
              :name="itemCity.name"
            >
              <div
                v-if="itemCity.pet_widget_vet_clinics.length===0"
                class="clinic-none"
              >
                Информации о ветеринарных
                клиниках нет
              </div>
              <div
                v-for="itemClinic in itemCity.pet_widget_vet_clinics"
                :key="'clinic'+itemClinic.id"
                class="item-clinic"
              >
                <div class="clinic-name">
                  {{ itemClinic.name }}
                </div>
                <div
                  v-for="itemAddress in itemClinic.pet_widget_vet_clinic_addresses"
                  :key="'address'+itemAddress.id"
                  class="clinic-address"
                >
                  <a
                    href="https://animals.admhmao.ru/animals/map-safety"
                    target="_blank"
                  >{{ itemAddress.address }}</a>
                </div>
                <div
                  v-for="itemEmail in itemClinic.pet_widget_vet_clinic_emails"
                  :key="'email'+itemEmail.id"
                  class="clinic-email"
                >
                  <a :href="'mailto:'+itemEmail.email">{{ itemEmail.email }}</a>
                </div>
                <div
                  v-for="itemPhone in itemClinic.pet_widget_vet_clinic_phones"
                  :key="'phone'+itemPhone.id"
                  class="clinic-phone"
                >
                  {{ itemPhone.phone }}
                </div>
              </div>
            </el-collapse-item>
          </el-collapse>
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
            v-model="filter.locality_id"
            class="filter-select"
            placeholder="Выберите муниципалитет"
            filterable
            clearable
            :value-on-clear="null"
            @change="getClinic()"
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
import {mapState} from 'pinia';
import {useAppStore} from '../../store/index.js';

export default {
  name: 'ViVetClinic',
  data() {
    return {
      loader: false,
      loadFilterData: false,
      filterWatch: false,
      filter: {
        locality_id: null,
      },
      localityList: [],
      clinicList: null,
      active: null,
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI']),
  },
  created() {
    this.getLocalities();
    this.startParams();
    this.getClinic();
  },
  methods: {
    getLocalities() {
      this.loadFilterData = true;
      this.$axios.get(this.linkAPI + 'widget/pet/get_localities')
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
    getClinic() {
      this.loader = true;
      this.$axios.get(this.linkAPI + 'widget/pet/clinics/list', {params: this.filter})
        .then((response) => {
          console.log('Вет. клиники: ', response.data);
          this.clinicList = response.data;
          if(this.clinicList.length===1){
            this.active = this.clinicList[0].name;
          }
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
  }
};
</script>

<style scoped>
.vi-vet-clinic {
  display: grid;
  grid-template-rows: calc(100% - 100px) 100px;
}

.content-box{
  position: relative;
  height: 100%;
}

.hello-box {
  font-family: Montserrat, sans-serif;
  font-size: 15px;
  font-weight: 500;
  line-height: 160%;
  color: #000;
  text-align: center;
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


.content {
  padding: 0 20px 20px;
}

.start-text {
  padding: 20px;

  font-family: Montserrat, sans-serif;
  font-size: 16px;
  font-weight: 500;
  line-height: 170%;
}

.start-text a {
  color: #264ABF;
  text-decoration: none;
}

.clinic-none {
  font-family: Montserrat, sans-serif;
  font-size: 14px;
  font-weight: 400;
  line-height: 170%;
}

.item-clinic {
  margin-bottom: 10px;
  padding-bottom: 10px;
  border-bottom: 1px solid #ebeef5;
}

.clinic-box .item-clinic:last-child {
  margin-bottom: 0;
  padding-bottom: 0;
  border-bottom: none;
}

.clinic-name {
  margin-bottom: 15px;

  font-family: Montserrat, sans-serif;
  font-size: 18px;
  font-weight: 500;
  line-height: 150%;
}

.clinic-address, .clinic-phone, .clinic-email {
  display: flex;
  gap: 5px;
  align-items: center;
  justify-content: flex-start;

  margin-bottom: 5px;

  font-family: Montserrat, sans-serif;
  font-size: 15px;
  font-weight: normal;
  line-height: 130%;
}

.clinic-address a, .clinic-phone a, .clinic-email a {
  color: #264ABF;
  text-decoration: none;
}

.clinic-address::before {
  content: '';

  width: 15px;
  min-width: 15px;
  height: 16px;

  background-color: #a2a8bd;

  mask-image: url("../../../assets/img/location.svg");
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 11px;
}

.clinic-email::before {
  content: '';

  width: 15px;
  min-width: 15px;
  height: 16px;

  background-color: #a2a8bd;

  mask-image: url("../../../assets/img/mail.svg");
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 13px;
}

.clinic-phone::before {
  content: '';

  width: 15px;
  min-width: 15px;
  height: 16px;

  background-color: #a2a8bd;

  mask-image: url("../../../assets/img/phone.svg");
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 13px;
}

</style>

<style>

.clinic-list .el-collapse-item__header {
  font-family: Montserrat, sans-serif;
  font-size: 16px;
  font-weight: 400;
}
</style>
