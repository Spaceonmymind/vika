<template>
  <div class="vika-type">
    <div class="white-box filter-box">
      <el-input
        v-model="filter.query"
        size="large"
        clearable
        placeholder="Поиск по названию и коду"
        @clear="getVikaTypes();setParams('query',filter.query);"
        @keyup.enter="getVikaTypes();setParams('query',filter.query);"
      ></el-input>
      <el-button
        size="large"
        class="filter-button"
        type="success"
        @click="setNewVikaType();"
      >
        Добавить тип Vika
      </el-button>
    </div>
    <div class="table-box white-box">
      <el-table
        ref="intentTable"
        v-loading="loadingTable"
        :data="vikaTypesList"
        row-key="id"
        style="width: 100%"
        stripe
        table-layout="auto"
        :scrollbar-always-on="true"
        @selection-change="selectionTableChange"
      >
        <el-table-column type="selection" width="55"/>
        <el-table-column property="description" label="Название"/>
        <el-table-column property="name" label="Код"/>
        <el-table-column label="" width="100px" align="center" header-align="center">
          <template #default="scope">
            <div class="table-button-box">
              <el-button circle type="warning" title="Редактировать тип Vika" @click="getVikaType(scope.row.id)">
                <div class="ico ico-edit"></div>
              </el-button>
              <el-button circle type="danger" title="Удалить тип Vika" @click="setDeleteVikaType(scope.row)">
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
        :pager-count="isMobile ? 5 : 7"
        :background="true"
        :layout="isMobile ? 'prev, pager, next' : 'total,sizes, prev, pager, next, jumper'"
        @size-change="handleSizeChange"
        @current-change="handleCurrentChange"
      />
      <div class="button-box">
        <el-button
          v-if="selectTable.length!==0" circle type="danger" title="Удалить типы Vika"
          @click="setDeleteVikaTypeGroup()">
          <div class="ico ico-delete"></div>
        </el-button>
      </div>
    </div>
    <el-dialog
      v-if="modalActive"
      v-model="modalActive"
      style="max-width: 600px; width: 90%; min-width: 350px"
      :close-on-click-modal="false"
      :before-close="handleClose"
      :title="vikaTypeInfo.id ? 'Редактирование типа Vika' :'Новый тип Vika'"
    >
      <div>
        <el-form
          ref="vika-type-form"
          :model="vikaTypeInfo"
          label-width="auto"
          size="large"
          :rules="rules"
          style="width: 100%"
          status-icon
          @keydown.stop.prevent.enter="vikaTypeInfo.id ? updateVikaType() :createVikaType()"
        >

          <el-form-item
            label="Название"
            prop="description"
          >
            <el-input
              v-model="vikaTypeInfo.description"
              placeholder="Название"
              size="large"
            />
          </el-form-item>

          <el-form-item
            label="Код"
            prop="name"
          >
            <el-input
              v-model="vikaTypeInfo.name"
              placeholder="Код"
              size="large"
            />
          </el-form-item>
        </el-form>

        <div class="resource-box">
          <div class="title">Ресурсы <el-button
            type="success"
            @click="addResource()"
          >Добавить</el-button></div>

          <div v-for="(item,index) in vikaTypeInfo.resources" :key="'resources'+index" class="item-resource">
            <el-input
              v-model="vikaTypeInfo.resources[index]"
              placeholder="URL"
              size="large"
            />
            <el-button circle type="danger" title="Удалить ресурс" @click="deleteResource(index)">
              <div class="ico ico-delete"></div>
            </el-button>
          </div>
        </div>

      </div>

      <template #footer>
        <div class="dialog-footer">
          <el-button @click="closeVikaType();">Отмена</el-button>
          <el-button type="primary" :loading="loadSave" @click="vikaTypeInfo.id ? updateVikaType() :createVikaType()">
            {{ vikaTypeInfo.id ? 'Сохранить' : 'Добавить' }}
          </el-button>
        </div>
      </template>

    </el-dialog>
  </div>
</template>
<script>
import {useAppStore} from '../../store/index.js';

export default{
  name: 'VikaType',
  data(){
    return{
      pagination: {
        current_page: 1,
        per_page: 15,
        total: 1,
      },
      filter: {
        query: null,
        need_pagination: 1,
      },
      rules: {
        'name': [{
          required: true,
          message: 'Введите код',
          trigger: 'blur',
        }],
        'description': [{
          required: true,
          message: 'Введите название',
          trigger: 'blur',
        }],
      },
      selectTable: [],
      modalActive: false,
      loadSave: false,
      loadingTable: false,
      vikaTypesList:[],
      vikaTypeInfo:{
        name: null,
        description: null,
        resources: []
      }
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI','isMobile']),
  },
  created() {
    this.initialData();
    this.getVikaTypes();
  },
  methods:{
    initialData() {
      if (this.$route.query.query) {
        this.filter.query = this.$route.query.query;
      }
      if (this.$route.query.vika_type_id) {
        this.getVikaType(this.$route.query.vika_type_id);
      }
      if (this.$route.query.page) {
        this.pagination.current_page = parseInt(this.$route.query.page);
      }
      if (this.$route.query.per_page) {
        this.pagination.per_page = parseInt(this.$route.query.per_page);
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
    getVikaTypes(page) {
      this.loadingTable = true;
      let params = this.filter;
      params.page = page ? page : this.pagination.current_page;
      params.per_page = this.pagination.per_page;
      this.$axios.get(this.linkAPI + 'chat/vika_types/list', {params})
        .then((response) => {
          console.log('Типы Vika:', response);
          this.vikaTypesList = response.data.data;
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
    handleCurrentChange(val) {
      this.getVikaTypes(val);
      this.setParams('current_page',val);
    },
    handleSizeChange(val) {
      this.getVikaTypes();
      this.setParams('per_page',val);
    },
    selectionTableChange(selection) {
      this.selectTable = selection;
    },
    async deleteVikaType(id) {
      try {
        let response = await this.$axios.post(this.linkAPI + 'chat/vika_types/' + id + '/delete');
        return response;
      } catch (error) {
        console.log(error);
        ElMessage({
          type: 'error',
          message: error.response.data.message,
        });
        return error;
      }
    },
    setDeleteVikaType(vikaType) {
      ElMessageBox.confirm(
        'Вы действительно хотите удалить тип Vika «' + vikaType.description + '»?',
        'Внимание!',
        {
          confirmButtonText: 'Да',
          cancelButtonText: 'Нет',
          type: 'warning',
        }
      )
        .then(async () => {
          this.loadingTable = true;
          let response = await this.deleteVikaType(vikaType.id);
          this.loadingTable = false;
          if (response.data.success) {
            ElMessage({
              type: 'success',
              message: 'Тип Vika успешно удален',
            });
            this.getVikaTypes(this.pagination.current_page);
          } else {
            ElMessage({
              type: 'error',
              message: response.data.error,
            });
          }
        });
    },
    setDeleteVikaTypeGroup() {
      ElMessageBox.confirm(
        'Вы действительно хотите удалить выбранные типы Vika?',
        'Внимание!',
        {
          confirmButtonText: 'Да',
          cancelButtonText: 'Нет',
          type: 'warning',
        }
      )
        .then(() => {
          this.loadingTable = true;
          Promise.allSettled(this.selectTable.map(item => this.deleteVikaType(item.id))).finally(() => {
            this.loadingTable = false;
            this.getVikaTypes(this.pagination.current_page);
          });
        });
    },
    setNewVikaType() {
      this.vikaTypeInfo = {
        name: null,
        description: null,
        resources: []
      };
      this.modalActive = true;
    },
    closeVikaType() {
      this.vikaTypeInfo = {
        name: null,
        description: null,
        resources: []
      };
      this.modalActive = false;
      this.setParams('vika_type_id', null);
    },
    handleClose(done) {
      this.closeVikaType();
      done();
    },
    getVikaType(id) {
      this.loadingTable = true;
      this.$axios.get(this.linkAPI + 'chat/vika_types/' + id + '/get')
        .then((response) => {
          console.log('Тип Vika:', response);
          this.vikaTypeInfo.id = response.data.id;
          this.vikaTypeInfo.name = response.data.name;
          this.vikaTypeInfo.description = response.data.description;
          this.vikaTypeInfo.resources = response.data.resources.map(item=>item.resource_host);
          this.modalActive = true;
          this.setParams('vika_type_id', this.vikaTypeInfo.id);
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingTable = false;
        })
      ;
    },
    createVikaType() {
      this.$refs['vika-type-form'].validate((valid) => {
        if (valid) {
          this.loadSave = true;
          let params = this.vikaTypeInfo;
          this.$axios.post(this.linkAPI + 'chat/vika_types/create', params)
            .then((response) => {
              console.log('Создание нового типа Vika:', response.data);
              if (response.data.success) {
                this.modalActive = false;
                ElMessage({
                  type: 'success',
                  message: 'Тип Vika успешно добавлен',
                });
                this.getVikaTypes(this.pagination.current_page);
              } else {
                ElMessage({
                  type: 'error',
                  message: response.data.error,
                });
              }
            })
            .catch((error) => {
              console.log(error);

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
    updateVikaType() {
      this.$refs['vika-type-form'].validate((valid) => {
        if (valid) {
          this.loadSave = true;
          let params = this.vikaTypeInfo;
          this.$axios.post(this.linkAPI + 'chat/vika_types/'+this.vikaTypeInfo.id+'/update', params)
            .then((response) => {
              console.log('Изменение типа Vika:', response.data);
              if (response.data.success) {
                this.modalActive = false;
                ElMessage({
                  type: 'success',
                  message: 'Тип Vika успешно изменен',
                });
                this.getVikaTypes(this.pagination.current_page);
              } else {
                ElMessage({
                  type: 'error',
                  message: response.data.error,
                });
              }
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
    deleteResource(index){
      this.vikaTypeInfo.resources.splice(index, 1);
    },
    addResource(){
      this.vikaTypeInfo.resources.push(null);
    }
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

.resource-box {

}

.resource-box .title {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
}

.resource-box .item-resource {
  display: flex;
  margin-top: 20px;
  align-items: center;
  gap: 10px;
}




.test-requests-box {
  max-height: 50dvh;
  overflow-y: auto;
}

.test-requests-title {
  font-size: 18px;
  font-weight: 500;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 20px;
}

.test-requests-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 20px;
  gap: 20px;
}

.recommendation-box {
  min-height: 50px;
}

.title-recommendation {
  font-size: 16px;
  font-weight: 500;
}

.item-recommendation {
  margin-top: 5px;
}

.graphic-box {
  width: 100%;
  height: calc(100% - 23px);
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
