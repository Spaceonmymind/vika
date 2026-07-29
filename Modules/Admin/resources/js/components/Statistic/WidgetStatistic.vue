<template>
  <div class="widget-statistic">
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
        @change="getStatistic(); setParams('date[]',filter.date);"
        @clear="getStatistic(); setParams('date[]',filter.date);"
      />
      <el-select
        v-model="filter.from_initial"
        placeholder="Точка обращения"
        filterable
        clearable
        :value-on-clear="null"
        size="large"
        @change="getStatistic(); ; setParams('from_initial',filter.from_initial);">
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
        v-model="filter.is_active_widget"
        placeholder="Активность виджета"
        filterable
        clearable
        :value-on-clear="null"
        size="large"
        @change="getStatistic(); ; setParams('is_active_widget',filter.is_active_widget);">
        <el-option
          label="Только активные"
          :value="1"/>
        <el-option
          label="Только не активные"
          :value="0"/>
      </el-select>
      <el-button
          size="large"
          class="filter-button"
          type="success"
          :loading="loadStatistic"
          @click="getFile()"
      >
       Скачать статистику
      </el-button>
    </div>
    <div class="table-box white-box">
      <el-table
        ref="intentTable"
        v-loading="loadingTable"
        :data="tableData"
        row-key="id"
        style="width: 100%"
        stripe
        table-layout="auto"
        :scrollbar-always-on="true"
      >
        <el-table-column property="widget.name" label="Название"/>
        <el-table-column property="widget.code_name" label="Код"/>
        <el-table-column property="widget.is_active" label="Активность" align="center" header-align="center">
          <template #default="scope">
            {{ scope.row.widget.is_active ? 'Активен' : 'Не активен' }}
          </template>
        </el-table-column>
        <el-table-column property="call_count" label="Количество обращений" align="center" header-align="center">
          <template #default="scope">
            <el-link
              type="primary"
              @click="setWidgetInfo(scope.row)"
            >{{ scope.row.call_count }}</el-link>
          </template>
        </el-table-column>
      </el-table>
    </div>
    <el-dialog
      v-if="modalActive"
      v-model="modalActive"
      style="max-width: 1000px; width: 90%; min-width: 350px"
      :close-on-click-modal="false"
      :before-close="handleClose"
      :title="widgetInfo.widget.name+' ( '+filter.date[0]+' — '+filter.date[1]+' )'"
    >
      <div v-loading="loadingChart" class="chart-box">
        <div style="height: 400px;">
          <LineChart v-if="widgetInfo.chartData" :data="widgetInfo.chartData" :options="chartOptions"/>
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
  name: 'WidgetStatistic',
  components: {
    LineChart,
  },
  data() {
    return {
      filter: {
        from: null,
        to: null,
        date: [moment().subtract(7, 'days').format('DD.MM.YYYY'), moment().format('DD.MM.YYYY')],
        from_initial: null,
        is_active_widget: null,
      },
      loadingTable: false,
      tableData: [],
      modalActive: false,
      widgetInfo: null,
      loadingChart: false,
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
      loadStatistic:false,
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI',]),
  },
  created() {
    this.initialData();
    this.getStatistic();
  },
  methods: {
    initialData() {
      if (this.$route.query.from_initial) {
        this.filter.from_initial = this.$route.query.from_initial;
      }
      if (this.$route.query.is_active_widget) {
        this.filter.is_active_widget = parseInt(this.$route.query.is_active_widget);
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
    getStatistic() {
      this.loadingTable = true;
      let params = this.filter;
      if (params.date !== null) {
        params.from = params.date[0];
        params.to = params.date[1];
      } else {
        params.from = null;
        params.to = null;
      }
      if (params.from_initial !== null) {
        if (params.from_initial === 'telegram') {
          params.from_telegram = 1;
          params.from_max = 0;
        } else if (params.from_initial === 'max') {
          params.from_telegram = 0;
          params.from_max = 1;
        } else {
          params.from_telegram = 0;
          params.from_max = 0;
        }
      } else {
        delete params.from_telegram;
        delete params.from_max;
      }
      this.$axios.get(this.linkAPI + 'chat/widgets/statistic/summary', {params})
        .then((response) => {
          console.log('Статистика:', response);
          this.tableData = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingTable = false;
        })
      ;
    },
    clearWidget() {
      this.widgetInfo = null;
      this.modalActive = false;
    },
    handleClose(done) {
      this.clearWidget();
      done();
    },
    setWidgetInfo(widget) {
      this.widgetInfo = widget;
      this.modalActive = true;
      this.getStatisticDetail(widget.widget_id);
    },
    getStatisticDetail(id) {
      this.loadingChart = true;
      let params = this.filter;
      if (params.date !== null) {
        params.from = params.date[0];
        params.to = params.date[1];
      } else {
        params.from = null;
        params.to = null;
      }
      if (params.from_initial !== null) {
        if (params.from_initial === 'telegram') {
          params.from_telegram = 1;
          params.from_max = 0;
        } else if (params.from_initial === 'max') {
          params.from_telegram = 0;
          params.from_max = 1;
        } else {
          params.from_telegram = 0;
          params.from_max = 0;
        }
      } else {
        delete params.from_telegram;
        delete params.from_max;
      }
      this.$axios.get(this.linkAPI + 'chat/widgets/statistic/' + id, {params})
        .then((response) => {
          console.log('Статистика для виджета:', response);
          this.widgetInfo.chartData =
            {
              labels: response.data.map(item=>{
                return item.date ? moment(item.date).format('DD.MM.YYYY') : '';
              }),
              datasets: [
                {
                  label: 'Количество обращений',
                  data: response.data.map(item=>item.call_count),
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
          this.loadingChart = false;
        })
      ;
    },
    getFile() {
      this.loadStatistic = true;
      let params = this.filter;
      if (params.date !== null) {
        params.from = params.date[0];
        params.to = params.date[1];
      } else {
        params.from = null;
        params.to = null;
      }

      this.$axios.get(this.linkAPI + 'chat/widgets/statistic/export_summary', {params:params,  responseType: 'blob' })
          .then((response) => {
            console.log('Ответ на скачивание файла:', response);
            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', 'export_summary.xlsx');
            document.body.appendChild(link);
            link.click();
          })
          .catch((error) => {
            console.log(error);
          })
          .finally(() => {
            this.loadStatistic = false;
          });
    }
  }

};
</script>

<style scoped>
.filter-box {
  display: grid;
  grid-template-columns: max-content max-content max-content max-content;
  gap: 20px;
}

.table-box {
  margin-top: 20px;
}

.chart-box{

}
.chart-box .time{
  text-align: center;
  font-size: 16px;
  margin-bottom: 20px;
}

@media (width <= 1600px) {
  .filter-box {
    grid-template-columns: 1fr 1fr 1fr;
  }
}


@media (width <= 1200px) {
  .filter-box {
    grid-template-columns: 1fr 1fr;
  }
}

@media (width <= 992px) {
  .filter-box {
    grid-template-columns: 1fr;
  }
}

@media (width <= 768px) {
  .filter-box {
    grid-template-columns: 1fr;
  }
}

</style>
