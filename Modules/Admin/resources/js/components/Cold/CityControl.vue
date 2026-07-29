<template>
  <div class="city-control">
    <div class="white-box filter-box">
      <el-input
        v-model="params.filter.name"
        size="large"
        clearable
        placeholder="Поиск по названию"
        @clear="getCityList(); setParams('name', params.filter.name);"
        @keyup.enter="getCityList(); setParams('name', params.filter.name);"
      ></el-input>
      <el-button
        size="large"
        class="filter-button"
        type="success"
        @click="addCity()"
      >
        Добавить город
      </el-button>
    </div>
    <div class="table-box white-box">
      <el-table
        ref="answerTable"
        v-loading="loadingTable"
        :data="cityList"
        row-key="id"
        style="width: 100%"
        table-layout="auto"
        stripe
        :scrollbar-always-on="true"
        @selection-change="selectionTableChange"
      >
        <el-table-column type="selection" width="55"/>
        <el-table-column property="id" label="ID"/>
        <el-table-column property="name" label="Название"/>
        <el-table-column property="fias_id" label="ФИАС ID"/>
        <el-table-column label="" width="100px" align="center" header-align="center">
          <template #default="scope">
            <div class="table-button-box">
              <el-button circle type="primary" title="Правила" @click="setWeatherRanges(scope.row)">
                <div class="ico ico-weather"></div>
              </el-button>
              <el-button circle type="warning" title="Редактировать город" @click="getCity(scope.row.id)">
                <div class="ico ico-edit"></div>
              </el-button>
              <el-button circle type="danger" title="Удалить город" @click="setDeleteCity(scope.row)">
                <div class="ico ico-delete"></div>
              </el-button>
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
        :background="true"
        :pager-count="isMobile ? 5 : 7"
        :layout="isMobile ? 'prev, pager, next' : 'total,sizes, prev, pager, next, jumper'"
        @size-change="handleSizeChange"
        @current-change="handleCurrentChange"
      />
      <div class="button-box">
        <el-button
          v-if="selectTable.length!==0" circle type="danger" title="Удалить города" @click="setDeleteCityGroup()">
          <div class="ico ico-delete"></div>
        </el-button>
      </div>

    </div>

    <el-dialog
      v-if="modalRangeActive"
      v-model="modalRangeActive"
      style="max-width: 900px; width: 90%; min-width: 350px"
      :close-on-click-modal="false"
      :before-close="handleCloseRange"
      :title="addRange.city"
    >
      <el-table
        v-loading="loadWeatherRanges"
        :data="weatherRanges"
      >
        <el-table-column
          prop="school_class"
          label="Диапазон классов">
          <template #default="scope">
            c 1 по {{ scope.row.school_class }}
          </template>
        </el-table-column>
        <el-table-column
          prop="temperature"
          label="Температура, °C"/>
        <el-table-column
          prop="wind"
          label="Ветер, м/сек"/>
        <el-table-column label="" width="50" align="center" header-align="center">
          <template #default="scope">
            <div class="table-button-box">
              <el-button circle type="danger" title="Удалить правило" @click="deleteRangeActirovki(scope.row.id)">
                <div class="ico ico-delete"></div>
              </el-button>
            </div>
          </template>
        </el-table-column>
      </el-table>
      <div class="add-range-box">
        <div class="title-add-range-box">Добавить правило</div>
        <div class="add-range-form-box">
          <div class="item-form-add-range">с 1 по
            <el-input-number
              v-model="addRange.school_class" size="large" :min="1"
              :max="11"></el-input-number>
          </div>
          <div class="item-form-add-range">
            <el-input-number
              v-model="addRange.temperature" size="large"
              :min="-100"
              :max="100"></el-input-number>
            °C
          </div>
          <div class="item-form-add-range">
            <el-input-number
              v-model="addRange.wind" size="large" :min="0"
              :max="100"></el-input-number>
            м/сек
          </div>
          <el-button
            size="large"
            type="success"
            :loading="loadAddRange"
            @click="addRangeActirovki()"
          >
            Добавить
          </el-button>
        </div>
      </div>
    </el-dialog>

    <el-dialog
      v-if="modalCityActive"
      v-model="modalCityActive"
      style="max-width: 600px; width: 90%; min-width: 350px"
      :close-on-click-modal="false"
      :before-close="handleCloseCity"
      :title="cityInfo.id ? 'Редактирование города' :'Новый город'"
    >
      <div>
        <el-form
          ref="city-form"
          :model="cityInfo"
          label-width="auto"
          size="large"
          :rules="rules"
          style="width: 100%"
          status-icon
          @keydown.stop.prevent.enter="cityInfo.id ? updateCity() :createCity()"
        >

          <el-form-item
            label="Название"
            prop="name"
          >
            <el-input
              v-model="cityInfo.name"
              placeholder="Название"
              size="large"
            />
          </el-form-item>

          <el-form-item
            label="ФИАС ID"
            prop="fias_id"
          >
            <el-input
              v-model="cityInfo.fias_id"
              placeholder="ФИАС ID"
              size="large"
            />
          </el-form-item>
          <el-form-item
            v-if="!cityInfo.id"
            label="Клонирование правил"
            prop="reference_city_id"
          >
            <el-select
              v-model="cityInfo.reference_city_id"
              placeholder="Город"
              filterable
              clearable
              :value-on-clear="null"
              size="large">
              <el-option
                v-for="item in cityList"
                :key="'cityList'+item.id"
                :label="item.name"
                :value="item.id"
              >
              </el-option>
            </el-select>
          </el-form-item>
        </el-form>

      </div>

      <template #footer>
        <div class="dialog-footer">
          <el-button @click="closeCity();">Отмена</el-button>
          <el-button type="primary" :loading="loadSave" @click="cityInfo.id ? updateCity() :createCity()">
            {{ cityInfo.id ? 'Сохранить' : 'Добавить' }}
          </el-button>
        </div>
      </template>

    </el-dialog>

  </div>
</template>
<script>
import {useAppStore} from '../../store/index.js';

export default {
  name: 'CityControl',
  data() {
    return {
      pagination: {
        current_page: 1,
        per_page: 15,
        total: 1,
      },
      params: {
        sort: 'name',
        filter: {
          name: null,
        }
      },
      loadingTable: false,
      cityList: [],
      selectTable: [],
      modalRangeActive: false,
      weatherRanges: [],
      loadWeatherRanges: false,
      loadAddRange: false,
      addRange: {
        city_id: null,
        city: null,
        temperature: -40,
        wind: 10,
        school_class: 11
      },
      modalCityActive: false,
      cityInfo: {
        name: null,
        fias_id: null,
        reference_city_id:null,
      },
      rules: {
        'name': [{
          required: true,
          message: 'Введите название',
          trigger: 'blur',
        }],
        'fias_id': [{
          required: true,
          message: 'Введите ФИАС ID',
          trigger: 'blur',
        },
          {
            min: 36, max: 36, message: 'ФИАС ID должен состоять из 36 символов', trigger: 'blur'
          }
        ],
      },
      loadSave: false,
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPIActirovki', 'isMobile']),
  },
  created() {
    this.initialData();
    this.getCityList();
  },
  methods: {
    getCityList(page) {
      this.loadingTable = true;
      let params = this.params;
      params.page = page ? page : this.pagination.current_page;
      params.per_page = this.pagination.per_page;
      this.$axios.get(this.linkAPIActirovki + 'widget/actirovki/cities', {params})
        .then((response) => {
          console.log('Города:', response);
          this.cityList = response.data.data;
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
      this.setParams('current_page', val);
      this.getCityList(val);
    },
    handleSizeChange(val) {
      this.setParams('per_page', val);
      this.getCityList();
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
      if (this.$route.query.name) {
        this.params.filter.name = this.$route.query.name;
      }
      if (this.$route.query.current_page) {
        this.pagination.current_page = parseInt(this.$route.query.current_page);
      }
      if (this.$route.query.per_page) {
        this.pagination.per_page = parseInt(this.$route.query.per_page);
      }
      if (this.$route.query.city_id) {
        this.getCity(parseInt(this.$route.query.city_id));
      }
    },
    selectionTableChange(selection) {
      this.selectTable = selection;
    },
    setWeatherRanges(city) {
      this.addRange.city_id = city.id;
      this.addRange.city = city.name;
      this.modalRangeActive = true;
      this.weatherRanges = [];
      this.getWeatherRanges(city.id);
    },
    getWeatherRanges(id) {
      this.loadWeatherRanges = true;
      this.$axios.get(this.linkAPIActirovki + 'widget/actirovki/cities/' + id + '/weather-ranges')
        .then((response) => {
          console.log('Правила', response);
          this.weatherRanges = response.data.data;
        }).finally(() => {
        this.loadWeatherRanges = false;
      });
    },
    handleCloseRange(done) {
      this.addRange.city_id = null;
      this.addRange.city = null;
      this.addRange.temperature = -40;
      this.addRange.wind = 10;
      this.addRange.school_class = 11;
      this.weatherRanges = [];
      this.loadWeatherRanges = false;
      this.loadAddRange = false;
      done();
    },
    addRangeActirovki() {
      this.loadAddRange = true;
      this.$axios.post(this.linkAPIActirovki + 'widget/actirovki/weather-ranges', this.addRange).then((response) => {
        console.log('Ответ на добавление правила', response);
        ElMessage({
          message: 'Правило добавлено',
          type: 'success',
        });
        this.getWeatherRanges(this.addRange.city_id);
      }).finally(() => {
        this.loadAddRange = false;
      });
    },
    deleteRangeActirovki(id) {
      ElMessageBox.confirm(
        'Вы действительно хотите удалить правило?',
        'Внимание!',
        {
          confirmButtonText: 'Да',
          cancelButtonText: 'Нет',
          type: 'warning',
        }
      )
        .then(() => {
          this.loadWeatherRanges = true;
          this.$axios.post(this.linkAPIActirovki + 'widget/actirovki/weather-ranges/' + id + '/delete')
            .then((response) => {
              console.log('Удаление правила:', response.data);
              this.getWeatherRanges(this.addRange.city_id);
            })
            .catch((error) => {
              console.log(error);
            })
            .finally(() => {
              this.loadWeatherRanges = false;
            });
        });
    },
    handleCloseCity(done) {
      this.closeCity();
      done();
    },
    closeCity() {
      this.modalCityActive = false;
      this.setParams('city_id', null);
    },
    createCity() {
      this.$refs['city-form'].validate((valid) => {
        if (valid) {
          this.loadSave = true;
          let params = {
            name: this.cityInfo.name,
            fias_id: this.cityInfo.fias_id
          };
          if(this.cityInfo.reference_city_id!==null){
            params.reference_city_id = this.cityInfo.reference_city_id;
          }
          this.$axios.post(this.linkAPIActirovki + 'widget/actirovki/cities', params)
            .then((response) => {
              console.log('Создание нового города:', response.data);
              ElMessage({
                type: 'success',
                message: 'Город успешно добавлен',
              });
              this.modalCityActive = false;
              this.getCityList();
            })
            .catch((error) => {
              console.log(error);
              ElMessage({
                type: 'error',
                message: error.response.data.message,
              });
            })
            .finally(() => {
              this.loadSave = false;
            })
          ;
        } else {
          ElMessage.error('Заполните обязательные поля');
          return false;
        }
      });
    },
    updateCity() {
      this.$refs['city-form'].validate((valid) => {
        if (valid) {
          this.loadSave = true;
          this.$axios.post(this.linkAPIActirovki + 'widget/actirovki/cities/' + this.cityInfo.id + '/update', this.cityInfo)
            .then((response) => {
              console.log('Обновление города:', response.data);
              ElMessage({
                type: 'success',
                message: 'Город успешно изменен',
              });
              this.modalCityActive = false;
              this.getCityList();
            })
            .catch((error) => {
              console.log(error);
              ElMessage({
                type: 'error',
                message: error.response.data.message,
              });
            })
            .finally(() => {
              this.loadSave = false;
            })
          ;
        } else {
          ElMessage.error('Заполните обязательные поля');
          return false;
        }
      });
    },
    getCity(id) {
      this.loadingTable = true;
      this.$axios.get(this.linkAPIActirovki + 'widget/actirovki/cities/' + id)
        .then((response) => {
          console.log('Город:', response);
          this.cityInfo = response.data.data;
          this.modalCityActive = true;
          this.setParams('city_id', this.cityInfo.id);
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingTable = false;
        })
      ;
    },
    addCity() {
      this.cityInfo = {
        name: null,
        fias_id: null,
        reference_city_id:null,
      };
      this.modalCityActive = true;
    },
    async deleteCity(id) {
      try {
        await this.$axios.post(this.linkAPIActirovki + 'widget/actirovki/cities/'+id+'/delete');
      } catch (error) {
        console.log(error);
        ElMessage({
          type: 'error',
          message: error.response.data.message,
        });
        return error;
      }
    },
    setDeleteCity(city) {
      ElMessageBox.confirm(
        'Вы действительно хотите удалить город «' + city.name + '»?',
        'Внимание!',
        {
          confirmButtonText: 'Да',
          cancelButtonText: 'Нет',
          type: 'warning',
        }
      )
        .then(async () => {
          this.loadingTable = true;
          await this.deleteCity(city.id);
          this.loadingTable = false;
          this.getCityList();
        });

    },
    setDeleteCityGroup() {
      ElMessageBox.confirm(
        'Вы действительно хотите удалить выбранные города?',
        'Внимание!',
        {
          confirmButtonText: 'Да',
          cancelButtonText: 'Нет',
          type: 'warning',
        }
      )
        .then(() => {
          this.loadingTable = true;
          Promise.allSettled(this.selectTable.map(item => this.deleteCity(item.id))).finally(() => {
            this.loadingTable = false;
            this.getCityList();
          });
        });
    },
  }
};
</script>

<style scoped>

.filter-box {
  display: grid;
  grid-template-columns: auto max-content;
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

.table-button-box {
  display: flex;
  flex-wrap: nowrap;
  gap: 5px;
}

.dialog-footer {
  display: flex;
  gap: 10px;
  align-items: center;
  justify-content: flex-end;
}

.ico {
  width: 22px;
  height: 22px;
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 22px;
}

.ico.ico-edit {
  background-color: var(--el-color-white);
  mask-image: url("../../../assets/icons/Pencil.svg");
}

.ico.ico-weather {
  background-color: var(--el-color-white);
  mask-image: url("../../../assets/icons/Cloud-Sun.svg");
}

.ico.ico-delete {
  background-color: var(--el-color-white);
  mask-image: url("../../../assets/icons/Trash 3.svg");
}

.ico.ico-close {
  background-color: var(--el-color-black);
  mask-image: url("../../../assets/icons/Cross.svg");
}

.ico.ico-login {
  background-color: var(--el-color-white);

  mask-image: url("../../../assets/icons/Sign_in.svg");
}

.add-range-box {
  padding: 20px 0;
  margin-top: 20px;
}

.title-add-range-box {
  font-size: 16px;
  font-weight: 500;
  margin-bottom: 20px;
}

.add-range-form-box {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
  align-items: center;
  justify-content: flex-start;
}

.item-form-add-range {
  display: flex;
  flex-wrap: nowrap;
  align-items: center;
  gap: 10px;
}


@media (width <= 1920px) {
  .form-box {
    grid-template-columns: auto max-content;;
  }
}

@media (width <= 1200px) {
  .filter-box {
    grid-template-columns: 1fr 1fr;
  }

  .form-box {
    grid-template-columns: auto max-content;;
  }
}

@media (width <= 992px) {
  .filter-box {
    grid-template-columns: 1fr;
  }

  .form-box {
    grid-template-columns: auto max-content;;
  }
}

@media (width <= 768px) {
  .filter-box {
    grid-template-columns: 1fr;
  }

  .form-box {
    grid-template-columns: repeat(1, 1fr);;
  }
}


</style>

