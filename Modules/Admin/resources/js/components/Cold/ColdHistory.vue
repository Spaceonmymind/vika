<template>
  <div class="cold-history">
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
        @change="getActirovkiRows(); setParams('date[]',params.filter.date);"
        @clear="getActirovkiRows(); setParams('date[]',params.filter.date);"
      />
      <el-select
        v-model="params.filter.city_id"
        placeholder="Город"
        filterable
        clearable
        :loading="loadingCity"
        size="large"
        @change="getActirovkiRows(); setParams('city_id',params.filter.city_id);">
        <el-option
          v-for="item in cityList"
          :key="'cityList'+item.id"
          :label="item.name"
          :value="item.id"
        >
        </el-option>
      </el-select>
      <el-select
        v-model="params.filter.school_class"
        placeholder="Классы"
        filterable
        clearable
        size="large"
        @change="getActirovkiRows(); setParams('school_class',params.filter.school_class);">
        <el-option
          label="С 1 по 4"
          :value="4"/>
        <el-option
          label="С 1 по 8"
          :value="8"/>
        <el-option
          label="С 1 по 11"
          :value="11"/>
      </el-select>
      <el-select
        v-model="params.filter.school_shift"
        placeholder="Смена"
        filterable
        clearable
        size="large"
        @change="getActirovkiRows(); setParams('school_shift',params.filter.school_shift);">
        <el-option
          label="1 смена"
          :value="1"/>
        <el-option
          label="2 смена"
          :value="2"/>
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
        <el-table-column property="created_at" label="Дата">
          <template #default="scope">
            {{ getDateTime(scope.row.created_at) }}
          </template>
        </el-table-column>
        <el-table-column property="school_shift" label="Смена"/>
        <el-table-column property="weather_range.school_class" label="Классы">
          <template #default="scope">
            С 1 по {{ scope.row.weather_range.school_class }}
          </template>
        </el-table-column>
        <el-table-column property="weather" label="Погода">
          <template #default="scope">
            <div>Температура {{ scope.row.weather.temperature }}°C, Ветер {{ scope.row.weather.wind }} м/с</div>
            <div>{{scope.row.weather.received_at!==null ? getDateTime(scope.row.weather.received_at) : '&#9998; '+getDateTime(scope.row.weather.created_at)}}</div>
          </template>
        </el-table-column>
        <el-table-column property="weather_range" label="Правило">
          <template #default="scope">
            Температура {{ scope.row.weather_range.temperature }}°C, Ветер {{ scope.row.weather_range.wind }} м/с
          </template>
        </el-table-column>
        <el-table-column property="cancel_at" label="Статус">
          <template #default="scope">
            <div>{{scope.row.cancel_at!==null ? 'Отменена' : 'Активна'}}</div>
            <div v-if="scope.row.cancel_at!==null">{{scope.row.cancel_user ? scope.row.cancel_user.name :''}}<br/>{{scope.row.cancel_user ? scope.row.cancel_user.email : ''}}</div>
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
  name: 'ColdHistory',
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
          school_shift: null,
          school_class: null,
        }
      },
      loadingTable: false,
      tableData: [],
      loadFile: false,
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPIActirovki', 'isMobile']),
  },
  created() {
    this.initialData();
    this.getCityList().then(()=>{
      this.getActirovkiRows();
    });
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
    getActirovkiRows(page) {
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
      this.$axios.get(this.linkAPIActirovki + 'widget/actirovki/rows', {params})
        .then((response) => {
          console.log('Актировки:', response);
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
      this.getActirovkiRows(val);
      this.setParams('current_page',val);
    },
    handleSizeChange(val) {
      this.getActirovkiRows();
      this.setParams('per_page',val);
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
      if (this.$route.query.school_shift) {
        this.params.filter.school_shift = parseInt(this.$route.query.school_shift);
      }
      if (this.$route.query.school_class) {
        this.params.filter.school_class = parseInt(this.$route.query.school_class);
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
    getDateTime(date_time) {
      return moment(date_time).format('DD.MM.YYYY HH:mm:ss');
    },
    exportCSV() {
      this.loadFile = true;
      this.$axios.get(this.linkAPIActirovki + 'widget/actirovki/rows/export-csv', {params:this.params,  responseType: 'blob' })
        .then((response) => {
          console.log('Ответ на скачивание файла:', response);
          const url = window.URL.createObjectURL(new Blob([response.data]));
          const link = document.createElement('a');
          link.href = url;
          link.setAttribute('download', 'actirovki.csv');
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
  grid-template-columns: repeat(4, 1fr) max-content;
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
  grid-template-columns: repeat(4, 1fr);
}

@media (width <= 1200px) {
  .filter-box {
    grid-template-columns: repeat(3, 1fr);
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
