<template>
  <div class="chat-statistic">
    <div class="white-box filter-box">
      <el-date-picker
        v-model="filter.date"
        type="daterange"
        range-separator="—"
        start-placeholder="Начало"
        end-placeholder="Конец"
        :clearable="false"
        size="large"
        format="DD.MM.YYYY"
        value-format="DD.MM.YYYY"
        style="width: 100%"
        @change="getHistory(); getTop(); setParams('date[]',filter.date);"
        @clear="getHistory(); getTop(); setParams('date[]',filter.date);"
      />
      <el-input
        v-model="filter.chat_id"
        size="large"
        clearable
        placeholder="Чат ID"
        @clear="getHistory(); getTop(); setParams('chat_id', filter.chat_id);"
        @keyup.enter="getHistory(); getTop(); setParams('chat_id', filter.chat_id);"
      ></el-input>
      <el-select
        v-model="filter.intent_id"
        placeholder="Интент"
        filterable
        clearable
        :value-on-clear="null"
        :loading="loadingIntents"
        size="large"
        @change="getHistory(); setParams('intent_id',filter.intent_id);">
        <el-option
          v-for="item in intentsList"
          :key="'intentsList'+item.id"
          :label="item.name"
          :value="item.id"/>
      </el-select>
      <el-select
        v-model="filter.from"
        placeholder="Точка обращения"
        filterable
        clearable
        :value-on-clear="null"
        size="large"
        @change="getHistory(); getTop(); setParams('from',filter.from);">
        <el-option
          label="Только из Telegram"
          value="telegram"/>
        <el-option
          label="Только из Max"
          value="max"/>
        <el-option
          label="Только из Vika"
          value="vika"/>
      </el-select>
      <el-select
        v-model="filter.vika_type_id"
        placeholder="Тип Vika"
        filterable
        clearable
        :value-on-clear="null"
        :loading="loadingVikaType"
        size="large"
        @change="getHistory(); getTop(); setParams('vika_type_id',filter.vika_type_id);">
        <el-option
          v-for="item in vikaTypesList"
          :key="'vikaTypesList'+item.id"
          :label="item.description"
          :value="item.id"/>
      </el-select>
      <el-button
        size="large"
        class="filter-button"
        type="success"
        :loading="loadFileStatistic"
        @click="getFileStatistic()"
      >
        Скачать статистику
      </el-button>
      <el-button
        size="large"
        class="filter-button"
        type="primary"
        :loading="loadFileHistory"
        @click="getFileHistory()"
      >
        Скачать историю
      </el-button>
    </div>
    <div v-loading="loadingTop" class="white-box top">
      <div v-if="top!== null && top.length > 0" class="statistic-box">
        <div
v-for="item in top" :key="'top'+item.intent_id"
             :class="['item-stat', item.intent_id===filter.intent_id ? 'active' : '']" @click="setIntentDetail(item)">
          <div class="name-intent">{{ item.chat_intent.name }}</div>
          <div class="count-intent">{{ item.count }}</div>
        </div>
      </div>
      <div v-else>В указанном периоде для выбранных параметров нет статистики использования интентов</div>
    </div>
    <div class="table-box white-box">
      <el-table
        ref="historyTable"
        v-loading="loadingTable"
        :data="tableData"
        style="width: 100%"
        stripe
        table-layout="auto"
        :scrollbar-always-on="true"
      >
        <el-table-column property="created_at" label="Время">
          <template #default="scope">
            {{ getDateTime(scope.row.created_at) }}
          </template>
        </el-table-column>
        <el-table-column property="from_tg" label="Точка обращения" align="center" header-align="center">
          <template #default="scope">
            {{ scope.row.from_tg ? 'Telegram' : scope.row.from_max ? 'Max' : 'Vika' }}
          </template>
        </el-table-column>
        <el-table-column property="vika_type.description" label="Тип Vika"/>
        <el-table-column property="chat_id" label="Чат ID">
          <template #default="scope">
            <el-link
              @click="filter.chat_id=scope.row.chat_id; getHistory(); getTop(); setParams('chat_id', filter.chat_id);">
              {{ scope.row.chat_id }}
            </el-link>
          </template>
        </el-table-column>
        <el-table-column property="message" label="Сообщение"/>
        <el-table-column property="chat_intent.name" label="Интент"/>
        <el-table-column property="entities" label="Сущности">
          <template #default="scope">
            <div v-for="(item,index) in scope.row.entities" :key="'entities'+scope.row.id+'-'+index">{{ item.value }} (
              {{ item.type }} )
            </div>
          </template>
        </el-table-column>
      </el-table>
    </div>
    <div class="pagination-box white-box">
      <el-pagination
        v-model:current-page="pagination.current_page"
        v-model:page-size="pagination.per_page"
        v-model:total="pagination.total"
        :page-sizes="[1, 15, 50, 100]"
        :pager-count="isMobile ? 5 : 7"
        :background="true"
        :layout="isMobile ? 'prev, pager, next' : 'total,sizes, prev, pager, next, jumper'"
        @size-change="handleSizeChange"
        @current-change="handleCurrentChange"
      />
    </div>
    <el-dialog
      v-if="modalActive"
      v-model="modalActive"
      style="max-width: 1000px; width: 90%; min-width: 350px"
      :close-on-click-modal="false"
      :before-close="handleClose"
      :title="intentDetail.intent.chat_intent.name+' ( '+filter.date[0]+' — '+filter.date[1]+' )'"
    >
      <div v-loading="loadingGraph" class="chart-box">
        <div style="height: 400px;">
          <LineChart v-if="intentDetail.data" :data="intentDetail.data" :options="chartOptions"/>
        </div>
      </div>
    </el-dialog>
  </div>
</template>

<script>
import {useAppStore} from '../../store/index.js';
import moment from 'moment';

import {Line as LineChart} from 'vue-chartjs';
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  LineElement,
  LinearScale,
  PointElement,
  CategoryScale,
} from 'chart.js';

// Регистрируем необходимые компоненты Chart.js
ChartJS.register(
  Title,
  Tooltip,
  Legend,
  LineElement,
  LinearScale,
  PointElement,
  CategoryScale
);

export default {
  name: 'ChatStatistic',
  components: {
    LineChart,
  },
  data() {
    return {
      pagination: {
        current_page: 1,
        per_page: 15,
        total: 1,
      },
      filter: {
        date_from: null,
        date_to: null,
        date: [moment().subtract(7, 'days').format('DD.MM.YYYY'), moment().format('DD.MM.YYYY')],
        vika_type_id: null,
        chat_id: null,
        from: null,
        intent_id: null,
      },
      vikaTypesList: [],
      loadingVikaType: false,
      loadStatistic: false,
      loadingTable: false,
      tableData: [],
      loadingIntents: false,
      intentsList: [],
      loadingTop: false,
      top: null,
      intentDetail: null,
      loadingGraph: false,
      chartOptions: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          },
          title: {
            display: false,
          },
        },
        scales: {
          y: {
            beginAtZero: true,
          },
        },
      },
      modalActive: false,
      loadFileStatistic: false,
      loadFileHistory: false,
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI', 'isMobile']),
  },
  created() {
    this.initialData();
    this.getVikaTypes();
    this.getIntentsList();
    this.getHistory();
    this.getTop();
  },
  methods: {
    initialData() {
      if (this.$route.query.from) {
        this.filter.from = this.$route.query.from;
      }
      if (this.$route.query.vika_type_id) {
        this.filter.vika_type_id = parseInt(this.$route.query.vika_type_id);
      }
      if (this.$route.query.intent_id) {
        this.filter.intent_id = parseInt(this.$route.query.intent_id);
      }
      if (this.$route.query.chat_id) {
        this.filter.chat_id = this.$route.query.chat_id;
      }
      if (this.$route.query.current_page) {
        this.pagination.current_page = parseInt(this.$route.query.current_page);
      }
      if (this.$route.query.per_page) {
        this.pagination.per_page = parseInt(this.$route.query.per_page);
      }
      if (this.$route.query['date[]']) {
        this.filter.date = this.$route.query['date[]'];
      }
    },
    setParams(name, value) {
      if (name !== undefined) {
        if (value !== null && value !== '') {
          this.$router.replace({
            path: this.$route.path,
            query: {...this.$route.query, [name]: value}
          });
        } else {
          let query = {...this.$route.query};
          delete query[name];
          this.$router.replace({
            path: this.$route.path,
            query: query
          });
        }
      }
    },
    getVikaTypes() {
      this.loadingVikaType = true;
      let params = {need_pagination: 0};
      this.$axios.get(this.linkAPI + 'chat/vika_types/list', {params})
        .then((response) => {
          console.log('Типы Vika:', response);
          this.vikaTypesList = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingVikaType = false;
        })
      ;
    },
    getIntentsList() {
      this.loadingIntents = true;
      let params = {need_pagination: 0};
      this.$axios.get(this.linkAPI + 'chat/intents/list', {params})
        .then((response) => {
          console.log('Интенты:', response);
          this.intentsList = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingIntents = false;
        })
      ;
    },
    getHistory(page) {
      this.loadingTable = true;
      let params = this.filter;
      if (params.date !== null) {
        params.date_from = params.date[0];
        params.date_to = params.date[1];
      } else {
        params.date_from = null;
        params.date_to = null;
      }
      if (params.from !== null) {
        if (params.from === 'telegram') {
          params.from_tg = 1;
          params.from_max = 0;
        } else if (params.from === 'max') {
          params.from_tg = 0;
          params.from_max = 1;
        } else {
          params.from_tg = 0;
          params.from_max = 0;
        }
      } else {
        delete params.from_tg;
        delete params.from_max;
      }
      params.page = page ? page : this.pagination.current_page;
      params.per_page = this.pagination.per_page;

      this.$axios.get(this.linkAPI + 'chat/intents/statistic/get_history', {params})
        .then((response) => {
          console.log('Статистика:', response);
          this.tableData = response.data.data;
          this.pagination.current_page = response.data.current_page;
          this.pagination.per_page = response.data.per_page;
          this.pagination.total = response.data.total;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingTable = false;
        })
      ;
    },
    handleSizeChange(val) {
      this.getHistory();
      this.setParams('per_page', val);
    },
    handleCurrentChange(val) {
      this.getHistory(val);
      this.setParams('current_page', val);
    },
    getDateTime(date) {
      if (date) {
        return moment(date).format('DD.MM.YYYY HH:mm:ss');
      }
      return '—';
    },
    getTop() {
      this.loadingTop = true;
      let params = this.filter;
      params.limit = 1000;
      if (params.from !== null) {
        if (params.from === 'telegram') {
          params.from_tg = 1;
          params.from_max = 0;
        } else if (params.from === 'max') {
          params.from_tg = 0;
          params.from_max = 1;
        } else {
          params.from_tg = 0;
          params.from_max = 0;
        }
      } else {
        delete params.from_tg;
        delete params.from_max;
      }
      this.$axios.get(this.linkAPI + 'chat/intents/statistic/get_top', {params})
        .then((response) => {
          console.log('Топ:', response);
          this.top = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingTop = false;
        })
      ;
    },
    setIntentDetail(intent) {
      this.intentDetail = {
        intent: intent,
        data: null,
      };
      this.modalActive = true;
      this.getIntentStatistic(intent.intent_id);
    },
    getIntentStatistic(intent_id) {
      this.loadingGraph = true;
      let params = Object.assign({}, this.filter);
      params.intent_id = intent_id;
      if (params.from !== null) {
        if (params.from === 'telegram') {
          params.from_tg = 1;
          params.from_max = 0;
        } else if (params.from === 'max') {
          params.from_tg = 0;
          params.from_max = 1;
        } else {
          params.from_tg = 0;
          params.from_max = 0;
        }
      } else {
        delete params.from_tg;
        delete params.from_max;
      }
      this.$axios.get(this.linkAPI + 'chat/intents/statistic/get_intent_statistic', {params})
        .then((response) => {
          console.log('Статистика для интента:', response);
          this.intentDetail.data =
            {
              labels: response.data.map(item => {
                return item.date ? item.date : '';
              }),
              datasets: [
                {
                  label: 'Количество обращений',
                  data: response.data.map(item => item.count),
                  borderColor: 'rgba(75, 192, 192, 1)',
                  backgroundColor: 'rgba(75, 192, 192, 0.2)',
                  tension: 0.4,
                },
              ],
            };
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingGraph = false;
        })
      ;
    },
    clearGraph() {
      this.intentDetail = null;
      this.modalActive = false;
    },
    handleClose(done) {
      this.clearGraph();
      done();
    },
    getFileStatistic() {
      this.loadFileStatistic = true;
      let params = this.filter;
      if (params.date !== null) {
        params.date_from = params.date[0];
        params.date_to = params.date[1];
      } else {
        params.date_from = null;
        params.date_to = null;
      }
      if (params.from !== null) {
        if (params.from === 'telegram') {
          params.from_tg = 1;
          params.from_max = 0;
        } else if (params.from === 'max') {
          params.from_tg = 0;
          params.from_max = 1;
        } else {
          params.from_tg = 0;
          params.from_max = 0;
        }
      } else {
        delete params.from_tg;
        delete params.from_max;
      }
      this.$axios.get(this.linkAPI + 'chat/intents/statistic/export_top', {params: params, responseType: 'blob'})
        .then((response) => {
          console.log('Ответ на скачивание файла:', response);
          const url = window.URL.createObjectURL(new Blob([response.data]));
          const link = document.createElement('a');
          link.href = url;
          link.setAttribute('download', 'export_top.xlsx');
          document.body.appendChild(link);
          link.click();
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadFileStatistic = false;
        });
    },
    getFileHistory() {
      this.loadFileHistory = true;
      let params = this.filter;
      if (params.date !== null) {
        params.date_from = params.date[0];
        params.date_to = params.date[1];
      } else {
        params.date_from = null;
        params.date_to = null;
      }
      if (params.from !== null) {
        if (params.from === 'telegram') {
          params.from_tg = 1;
          params.from_max = 0;
        } else if (params.from === 'max') {
          params.from_tg = 0;
          params.from_max = 1;
        } else {
          params.from_tg = 0;
          params.from_max = 0;
        }
      } else {
        delete params.from_tg;
        delete params.from_max;
      }
      this.$axios.get(this.linkAPI + 'chat/intents/statistic/export_history', {params: params, responseType: 'blob'})
        .then((response) => {
          console.log('Ответ на скачивание файла:', response);
          const url = window.URL.createObjectURL(new Blob([response.data]));
          const link = document.createElement('a');
          link.href = url;
          link.setAttribute('download', 'export_history.xlsx');
          document.body.appendChild(link);
          link.click();
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadFileHistory = false;
        });
    }
  }
};
</script>

<style scoped>

.filter-box {
  display: grid;
  grid-template-columns: repeat(5, 1fr) max-content max-content;
  gap: 20px;
}

.table-box {
  margin-top: 20px;
}

.top {
  margin-top: 20px;
}

.table-box ul {
  margin: 0;
  padding-left: 20px;
}

.pagination-box {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 20px;
}

.statistic-box {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
  width: fit-content;
}

.item-stat {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  flex-wrap: nowrap;
  background: #f5f6f8;
  padding: 10px 20px;
  border-radius: 12px;
  cursor: pointer;
}

.item-stat.active {
  background: var(--el-color-primary);
  color: #fff;
}

.item-stat .name-intent {
  font-size: 14px;
  line-height: 150%;
}

.item-stat .count-intent {
  font-weight: 600;
}

@media (width <= 1920px) {
  .filter-box {
    grid-template-columns: repeat(4, 1fr);
  }

  .statistic-box {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media (width <= 1200px) {
  .filter-box {
    grid-template-columns: repeat(2, 1fr);
  }

  .statistic-box {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (width <= 992px) {
  .filter-box {
    grid-template-columns: 1fr;
  }

  .statistic-box {
    width: 100%;
    grid-template-columns: repeat(1, 1fr);
  }
}

@media (width <= 768px) {
  .filter-box {
    grid-template-columns: 1fr;
  }

  .statistic-box {
    width: 100%;
    grid-template-columns: repeat(1, 1fr);
  }
}

</style>
