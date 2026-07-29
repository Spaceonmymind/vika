<template>
  <div class="weather-history">
    <div class="white-box filter-box">
      <el-date-picker
        v-model="params.filter.date"
        type="daterange"
        range-separator="—"
        start-placeholder="Начало"
        end-placeholder="Конец"
        size="large"
        format="DD.MM.YYYY"
        value-format="DD.MM.YYYY"
        style="width: 100%"
        @change="getWeathers(); setParams('date[]',params.filter.date);"
        @clear="getWeathers(); setParams('date[]',params.filter.date);"
      />
      <el-select
        v-model="params.filter.city_id"
        placeholder="Город"
        filterable
        clearable
        :loading="loadingCity"
        size="large"
        @change="getWeathers(); ; setParams('city_id',params.filter.city_id);">
        <el-option
          v-for="item in cityList"
          :key="'cityList'+item.id"
          :label="item.name"
          :value="item.id"
        >
        </el-option>
      </el-select>
      <el-button
        size="large"
        class="filter-button"
        type="success"
        :loading="loadFile"
        @click="exportCSV()"
      >
        Скачать
      </el-button>
    </div>
    <div class="table-box white-box">
      <el-table
        v-loading="loadingTable"
        :data="tableData"
        row-key="id"
        table-layout="auto"
        stripe
        :scrollbar-always-on="true"
      >
        <el-table-column property="city_id" label="Город">
          <template #default="scope">
            {{ cityList[scope.row.city_id].name }}
          </template>
        </el-table-column>
        <el-table-column property="received_at" label="Дата">
          <template #default="scope">
            {{ scope.row.received_at ? getDateTime(scope.row.received_at) : '&#9998; '+ getDateTime(scope.row.created_at) }}
          </template>
        </el-table-column>
        <el-table-column property="temperature" label="Температура">
          <template #default="scope">
            {{ scope.row.temperature }}°C
          </template>
        </el-table-column>
        <el-table-column property="wind" label="Ветер">
          <template #default="scope">
            {{ scope.row.wind }} м/с
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
  </div>
</template>
<script>
import moment from 'moment';
import {useAppStore} from '../../store/index.js';

export default {
  name: 'WeatherHistory',
  data() {
    return {
      cityList: [],
      loadingCity: false,
      pagination: {
        current_page: 1,
        per_page: 15,
        total: 1,
      },
      params: {
        filter: {
          city_id: null,
          date:null,
          date_from: null,
          date_to: null,
        }
      },
      loadingTable: false,
      tableData: [],
      loadFile: false,
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPIActirovki','isMobile']),
  },
  created() {
    this.initialData();
    this.getCityList().then(()=>{this.getWeathers();});
  },
  methods: {
    async getCityList() {
      try {
        this.loadingCity = true;
        let response = await this.$axios.get(this.linkAPIActirovki + 'widget/actirovki/cities');
        console.log('Города:', response);
        this.cityList = response.data.data.reduce((list, city) => {
          return {
            ...list,
            [city.id]: city,
          };
        }, {});
      } catch (error) {
        console.log(error);
      }
      finally {
        this.loadingCity = false;
      }
    },
    getWeathers(page) {
      this.loadingTable = true;
      let params = this.params;
      if(params.filter.date!==null){
        params.filter.date_from = params.filter.date[0];
        params.filter.date_to = params.filter.date[1];
      }else{
        params.filter.date_from = null;
        params.filter.date_to = null;
      }
      params.page = page ? page : this.pagination.current_page;
      params.per_page = this.pagination.per_page;
      this.$axios.get(this.linkAPIActirovki + 'widget/actirovki/weathers', {params})
        .then((response) => {
          console.log('Погода:', response);
          this.tableData = response.data.data;
          this.pagination.current_page = response.data.meta.current_page;
          this.pagination.per_page = response.data.meta.per_page;
          this.pagination.total = response.data.meta.total;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingTable = false;
        })
      ;
    },
    handleCurrentChange(val) {
      this.getWeathers(val);
      this.setParams('current_page',val);
    },
    handleSizeChange(val) {
      this.getWeathers();
      this.setParams('per_page',val);
    },
    getDateTime(date_time) {
      return moment(date_time).format('DD.MM.YYYY HH:mm:ss');
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
    initialData() {
      if (this.$route.query.city_id) {
        this.params.filter.city_id = parseInt(this.$route.query.city_id);
      }
      if (this.$route.query.current_page) {
        this.pagination.current_page = parseInt(this.$route.query.current_page);
      }
      if (this.$route.query.per_page) {
        this.pagination.per_page = parseInt(this.$route.query.per_page);
      }
      if (this.$route.query['date[]']) {
        this.params.filter.date = this.$route.query['date[]'];
      }
    },
    exportCSV() {
      this.loadFile = true;
      this.$axios.get(this.linkAPIActirovki + 'widget/actirovki/weathers/export-csv', {params:this.params,  responseType: 'blob' })
        .then((response) => {
          console.log('Ответ на скачивание файла:', response);
          const url = window.URL.createObjectURL(new Blob([response.data]));
          const link = document.createElement('a');
          link.href = url;
          link.setAttribute('download', 'pogoda.csv');
          document.body.appendChild(link);
          link.click();
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadFile = false;
        });
    }
  }
};
</script>

<style scoped>

.filter-box {
  display: grid;
  grid-template-columns: repeat(2, 1fr) max-content;
  gap: 20px;
}

.table-box {
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
@media (width <= 1920px) {
  grid-template-columns: repeat(2, 1fr);
}

@media (width <= 1200px) {
  .filter-box {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (width <= 992px) {
  .filter-box {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (width <= 768px) {
  .filter-box {
    grid-template-columns: 1fr;
  }
}


</style>

