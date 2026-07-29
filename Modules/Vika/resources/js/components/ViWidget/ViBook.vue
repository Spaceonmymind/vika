<template>
  <div
    v-loading="loader"
    class="vi-book"
  >
    <div class="content-box">
      <div
        v-if="searchResult===null"
        class="hello-box"
      >
        Для того чтобы найти интересующий вас контакт, в строке поиска необходимо ввести фамилию, имя или место работы.
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
          v-for="item in searchResult"
          :key="'people'+item.id"
          :class="['people-item',item.active ? 'active' : '']"
          @click="setActiveUser(item.id)"
        >
          <div
            v-if="item.active"
            class="close"
            @click.stop.prevent="item.active=false"
          />

          <div :class="['fio',item.active ? 'active' : '']">
            {{ item.fio }}
          </div>
          <div class="post">
            {{ item.post !== null ? item.post : '-' }}
          </div>

          <div
            v-if="item.phone!==null && item.phone!=='' && item.phone!=='-'"
            class="phone"
          >
            <i />{{ item.phone }}
          </div>

          <div
            v-if="item.active"
            class="active-box"
          >
            <div
              v-if="item.email!==null && item.email!=='' && item.email!=='-'"
              class="email"
            >
              <i /> <a
                :href="'mailto:'+item.email"
              >{{ item.email }}</a>
            </div>
            <div
              v-if="item.address!==null && item.address!=='' && item.address!=='-'"
              class="address"
            >
              <i /> <span>{{ item.address }}</span>
            </div>
            <div
              v-if="item.administration_body_name!==null && item.administration_body_name!=='' && item.administration_body_name!=='-'"
              class="position"
            >
              {{ item.administration_body_name }}
            </div>
            <div
              v-if="item.management_department!==null && item.management_department!=='' && item.management_department!=='-'"
              class="position"
            >
              {{ item.management_department }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="filter-box">
    <div class="filter">
      <div class="title-filter">
        ФИО или место работы
      </div>
      <div class="filter-input-box">
        <el-input
          v-model="query"
          placeholder="Поиск"
          clearable
          class="filter-input filter-input-button"
          @keyup.enter="query.trim().length===0 ? '' : getPeoplesContacts()"
        />
        <div
          class="search-button"
          title="Искать"
          @click="query.trim().length===0 ? '' : getPeoplesContacts()"
        />
      </div>
    </div>
  </div>
</template>

<script>
import {mapState} from 'pinia';
import {useAppStore} from '../../store/index.js';

export default {
  name: 'ViBook',
  data() {
    return {
      searchResult: null,
      query: '',
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
    setActiveUser(id) {
      this.searchResult.forEach((item) => {
        item.active = false;
      });
      this.searchResult.find(item => item.id === id).active = true;
    },
    getPeoplesContacts() {
      this.loader = true;
      let params = {
        fio_or_company: this.query
      };
      this.$axios.get(this.linkAPI + 'widget/phonebook/get_peoples_contacts', {params})
        .then((response) => {
          console.log('Результаты поиска по справочнику: ', response.data);
          this.searchResult = response.data.map(item => {
            return {...item, active: false};
          });
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loader = false;
        });
    },
    startParams(){
      if(this.$route.query.fio_or_company){
        this.query = this.$route.query.fio_or_company;
      }
      if(this.query.trim().length!==0){
        this.getPeoplesContacts();
      }
    }
  }
};
</script>

<style scoped>
.vi-book {
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

.people-item {
  cursor: pointer;

  position: relative;

  padding: 25px;
  border-bottom: 1px solid #d6dae4;

  font-family: Montserrat, sans-serif;
  color: #000;

  transition: 0.3s ease;
}

.people-item:last-child {
  border-bottom: none;
}

.people-item:hover {
  background: #f2f4fb;
}

.people-item.active {
  cursor: initial;

  padding: 25px;

  color: #000;

  background: #fff;
  box-shadow: 0 0 20px rgb(0 0 0 / 10%);
}

.people-item .post {
  margin-bottom: 14px;
  font-size: 13px;
  font-weight: normal;
}

.people-item .fio {
  cursor: pointer;
  margin-bottom: 3px;
  font-size: 16px;
  font-weight: 600;
}

.people-item .fio.active {
  cursor: initial;
}

.people-item .phone {
  display: flex;
  gap: 4px;
  align-items: center;

  font-size: 16px;
  font-weight: 500;
}

.people-item .phone i {
  width: 16px;
  height: 16px;

  background-color: #a2a8bd;

  mask-image: url('../../../assets/img/phone.svg');
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 12px;
}

.active-box{
  margin-top: 15px;
}

.people-item .email {
  display: flex;
  gap: 4px;
  align-items: center;
  margin: 15px 0;
}

.people-item .email i {
  width: 16px;
  height: 16px;

  background-color: #a2a8bd;

  mask-image: url('../../../assets/img/mail.svg');
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 14px;
}

.people-item .email a {
  cursor: pointer;

  padding-bottom: 1px;
  border-bottom: 1px solid rgb(33 106 205 / 30%);

  font-size: 15px;
  font-weight: 500;
  color: #216acd;
  text-decoration: none;
}

.people-item .email a:hover {
  padding-bottom: 2px;
  border: 0;
}

.people-item .position {
  margin-bottom: 5px;
  font-size: 13px;
  font-weight: 500;
}

.people-item .address {
  display: flex;
  gap: 4px;
  align-items: center;

  margin: 15px 0;

  font-size: 15px;
  font-weight: 500;
}

.people-item .address i {
  width: 16px;
  height: 16px;

  background-color: #a2a8bd;

  mask-image: url('../../../assets/img/location.svg');
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 11px;
}

.close {
  cursor: pointer;

  position: absolute;
  top: 25px;
  right: 25px;

  width: 20px;
  height: 20px;

  background-color: #8d8d8d;

  mask-image: url('../../../assets/img/close.svg');
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 12px;
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

</style>

<style>
.filter-input-button  .el-input__wrapper {
  padding: 0 50px 0 20px;
}

</style>
