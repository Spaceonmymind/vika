<template>
  <div
    v-loading="loader"
    class="vi-system-help"
  >
    <el-dialog
      v-if="systemDetail.active"
      v-model="systemDetail.active"
      class="detail-system-box"
      :close-on-click-modal="false"
      top="20px"
      width="calc(100% - 40px)"
      :title="systemDetail.data.full_name"
    >
      <div
        class="scroll-box"
      >
        <div
          v-if="systemDetail.data.short_name!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Сокращенное название системы
          </div>
          {{ systemDetail.data.short_name }}
        </div>

        <div
          v-if="systemDetail.data.targets!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Описание
          </div>
          {{ systemDetail.data.targets }}
        </div>

        <div
          v-if="systemDetail.data.url!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Адрес системы
          </div>
          <a
            :href="systemDetail.data.url"
            target="_blank"
          >{{ systemDetail.data.url }}</a>
        </div>

        <div
          v-if="systemDetail.data.purposes!==null && systemDetail.data.purposes.length!== 0"
          class="item-form"
        >
          <div class="item-title-form">
            Направления системы
          </div>
          <ul>
            <li
              v-for="purpose in systemDetail.data.purposes"
              :key="'purposes'+purpose.id"
            >
              {{ purpose.name }}
            </li>
          </ul>
        </div>

        <div
          v-if="systemDetail.data.operator!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Оператор системы
          </div>
          {{ systemDetail.data.operator.name }}
        </div>

        <div
          v-if="systemDetail.data.owner!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Владелец системы
          </div>
          {{ systemDetail.data.owner.name }}
        </div>

        <div
          v-if="systemDetail.data.state_info_sys!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Статус системы
          </div>
          {{ systemDetail.data.state_info_sys }}
        </div>

        <div
          v-if="systemDetail.data.subsystems!==null && systemDetail.data.subsystems.length!== 0"
          class="item-form"
        >
          <div class="item-title-form">
            Подсистемы
          </div>
          <ul>
            <li
              v-for="subsystem in systemDetail.data.subsystems"
              :key="'subsystems'+subsystem.id"
            >
              <div class="item-system">
                <a
                  v-if="subsystem.site!==null"
                  :href="subsystem.site"
                  target="_blank"
                >{{ subsystem.name }}</a>
                <span v-else>{{ subsystem.name }}</span>
                <div v-if="subsystem.helpdesk!==null">
                  (<a :href="'mailto:'+subsystem.helpdesk">{{ subsystem.helpdesk }}</a>)
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </el-dialog>

    <div class="content-box">
      <div
        v-if="systemList===null"
        class="hello-box"
      >
        Для поиска воспользуйтесь фильтром
      </div>
      <div
        v-else
        ref="systemList"
        class="scroll-box"
        @scroll="handleScroll"
      >
        <div
          v-if="systemList.length===0"
          class="hello-box"
        >
          По вашему запросу ничего не найдено
        </div>

        <div
          v-for="item in systemList"
          :key="'systemList'+item.id"
          class="item-system-info"
          @click="setDetail(item)"
        >
          <div><span>{{ item.full_name }}</span></div>
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
            Владелец системы
          </div>
          <el-select
            v-model="filter.owner_id"
            class="filter-select"
            placeholder="Выберите организацию"
            filterable
            clearable
            :value-on-clear="null"
          >
            <el-option
              v-for="item in ownersList"
              :key="'ownersList'+item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
        </div>
        <div class="item-form">
          <div class="title-form">
            Направление системы
          </div>
          <el-select
            v-model="filter.purpose_id"
            class="filter-select"
            placeholder="Выберите направление"
            filterable
            clearable
            :value-on-clear="null"
          >
            <el-option
              v-for="item in purposesList"
              :key="'purposesList'+item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
        </div>
        <div class="item-form">
          <div class="title-form">
            Оператор системы
          </div>
          <el-select
            v-model="filter.operator_id"
            class="filter-select"
            placeholder="Выберите организацию"
            filterable
            clearable
            :value-on-clear="null"
          >
            <el-option
              v-for="item in operatorsList"
              :key="'operatorsList'+item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
        </div>

        <div class="item-form">
          <div class="title-form">
            Название системы
          </div>
          <el-input
            v-model="filter.name"
            placeholder="Введите название"
            clearable
            class="filter-input"
          />
        </div>
        <el-button
          class="filter-button"
          style="width: 100%"
          type="primary"
          @click="getSystemsList()"
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
  name: 'ViSystemHelp',
  data() {
    return {
      loader: false,
      loadFilterData: false,
      filterWatch: false,
      filter: {
        owner_id: null,
        operator_id: null,
        purpose_id: null,
        name: null,
      },
      purposesList: [],
      ownersList: [],
      operatorsList: [],
      systemList: null,
      systemDetail: {
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
      this.getPurposes(),
      this.getOwners(),
      this.getOperators(),
    ]).finally(
        () => {
          this.loadFilterData = false;
        }
    );

    this.getSystemsList();
  },
  methods: {
    async getPurposes() {
      try {
        let response = await this.$axios.get(this.linkAPI + 'widget/information_systems/get_purposes');
        console.log('Направления: ', response.data);
        this.purposesList = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async getOwners() {
      try {
        let response = await this.$axios.get(this.linkAPI + 'widget/information_systems/get_owners');
        console.log('Владельцы: ', response.data);
        this.ownersList = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async getOperators() {
      try {
        let response = await this.$axios.get(this.linkAPI + 'widget/information_systems/get_operators');
        console.log('Операторы: ', response.data);
        this.operatorsList = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    getSystemsList() {
      this.loader = true;
      let params = {...this.filter};
      this.$axios.get(this.linkAPI + 'widget/information_systems/get_systems_list', {params})
          .then((response) => {
            console.log('Список систем: ', response.data);
            this.systemList = response.data.data;
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
    getSystemsListScroll() {
      this.loader = true;
      let params = {...this.filter, cursor: this.next_cursor};
      this.$axios.get(this.linkAPI + 'widget/information_systems/get_systems_list', {params})
          .then((response) => {
            console.log('Список систем: ', response.data);
            this.systemList.push(...response.data.data);
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
      if (this.$route.query.owner_id) {
        this.filter.owner_id = parseInt(this.$route.query.owner_id);
      }
      if (this.$route.query.operator_id) {
        this.filter.operator_id = parseInt(this.$route.query.operator_id);
      }
      if (this.$route.query.purpose_id) {
        this.filter.purpose_id = parseInt(this.$route.query.purpose_id);
      }
      if (this.$route.query.name) {
        this.filter.name = this.$route.query.name;
      }
    },
    setDetail(measure) {
      this.systemDetail.data = measure;
      this.systemDetail.active = true;
    },
    handleScroll() {
      const box = this.$refs.systemList;
      //console.log(box.scrollTop + box.clientHeight);
      //console.log(box.scrollHeight);
      if ((Math.abs(box.scrollHeight - box.scrollTop - box.clientHeight) === 0 || Math.abs(box.scrollHeight - box.scrollTop - box.clientHeight) === 0.5) && this.next_cursor !== null) {
        this.getSystemsListScroll();
      }
    },
  }
};
</script>

<style scoped>
.vi-system-help {
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

.item-system-info {
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

.item-system-info:hover {
  cursor: pointer;
  color: #005ae1;
}

.item-system-info::before {
  content: '';

  width: 7px;
  min-width: 7px;
  height: 7px;
  border-radius: 10px;

  background: #005ae1;

}

.item-system-info div {
  width: fit-content;
}

.item-system-info div span {
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
.el-dialog.detail-system-box {
  display: grid;
  grid-template-rows: auto 1fr;
  max-height: calc(100dvh - 40px);
  border-radius: 15px
}

.el-dialog.detail-system-box .el-dialog__body {
  display: contents;

  font-family: Montserrat, sans-serif;
  font-size: 16px;
  font-weight: 400;
  line-height: 135%;
  color: #000;
}

.el-dialog.detail-system-box .el-dialog__title {
  font-family: Montserrat, sans-serif;
  font-size: 18px;
  font-weight: 500;
  line-height: 140%;
  color: #000;
}

.el-dialog.detail-system-box .item-system{
  display: flex;
  flex-wrap: wrap;
  gap: 5px;
  align-items: center;
}

.el-dialog.detail-system-box ul, .el-dialog.detail-system-box ol {
  margin-left: 0;
  padding-left: 0;
}

.el-dialog.detail-system-box ul li, .el-dialog.detail-system-box ol li {
  display: flex;
  align-items: center;
  margin-bottom: 5px;
  list-style: none;
}

.el-dialog.detail-system-box li::before {
  content: '';

  flex-shrink: 0;

  width: 7px;
  height: 7px;
  margin-right: 13px;
  border-radius: 100%;

  background: #264ABF;
}

.el-dialog.detail-system-box a {
  color: #264ABF;
  text-decoration: none;
}
</style>
