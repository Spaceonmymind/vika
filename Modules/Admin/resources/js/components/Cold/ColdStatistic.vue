<template>
  <div class="cold-statistic">
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
        @change="getStatistic(); setParams('date[]',params.filter.date);"
        @clear="getStatistic(); setParams('date[]',params.filter.date);"
      />
      <el-select
        v-model="params.filter.city_id"
        placeholder="Город"
        filterable
        clearable
        :loading="loadingCity"
        size="large"
        @change="getStatistic(); ; setParams('city_id',params.filter.city_id);">
        <el-option
          v-for="item in cityList"
          :key="'cityList'+item.id"
          :label="item.name"
          :value="item.id"
        >
        </el-option>
      </el-select>
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
        <el-table-column property="city" label="Город"/>
        <el-table-column label="Первая смена">
          <el-table-column property="shifts.1.4" label="1-4"/>
          <el-table-column property="shifts.1.8" label="1-8"/>
          <el-table-column property="shifts.1.11" label="1-11"/>
        </el-table-column>
        <el-table-column label="Вторая смена">
          <el-table-column property="shifts.2.4" label="1-4"/>
          <el-table-column property="shifts.2.8" label="1-8"/>
          <el-table-column property="shifts.2.11" label="1-11"/>
        </el-table-column>
      </el-table>
    </div>
  </div>
</template>
<script>
import {useAppStore} from '../../store/index.js';

export default {
  name: 'ColdStatistic',
  data() {
    return {
      cityList: [],
      loadingCity: false,
      params: {
        filter: {
          city_id: null,
          date: null,
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
    ...mapState(useAppStore, ['linkAPIActirovki',]),
  },
  created() {
    this.initialData();
    this.getCityList();
    this.getStatistic();
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
      } finally {
        this.loadingCity = false;
      }
    },
    getStatistic() {
      this.loadingTable = true;
      let params = this.params;
      if (params.filter.date !== null) {
        params.filter.date_from = params.filter.date[0];
        params.filter.date_to = params.filter.date[1];
      } else {
        params.filter.date_from = null;
        params.filter.date_to = null;
      }
      this.$axios.get(this.linkAPIActirovki + 'widget/actirovki/statistic', {params})
        .then((response) => {
          console.log('Статистика:', response);
          this.tableData = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingTable = false;
        })
      ;
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
      if (this.$route.query['date[]']) {
        this.params.filter.date = this.$route.query['date[]'];
      }
    },
  }
};
</script>

<style scoped>

.filter-box {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
}

.table-box {
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
