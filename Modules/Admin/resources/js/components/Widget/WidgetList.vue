<template>
  <div class="widget-list">

    <div class="white-box filter-box">
      <el-input
        v-model="filter.query"
        size="large"
        clearable
        placeholder="Поиск по названию и коду"
        @keyup.enter="getWidgetList();setParams('query',filter.query);"
        @clear="getWidgetList();setParams('query',filter.query);"
      ></el-input>
      <el-select
        v-model="filter.type_id"
        placeholder="Тип"
        filterable
        clearable
        :loading="loadingWidgetTypes"
        size="large"
        @change="getWidgetList();setParams('type_id',filter.type_id);">
        <el-option
          v-for="item in widgetTypesList"
          :key="'widgetTypesList'+item.id"
          :label="item.name"
          :value="item.id"
        >
        </el-option>
      </el-select>
      <el-select
        v-model="filter.is_active"
        placeholder="Активность"
        filterable
        clearable
        size="large"
        @change="getWidgetList();setParams('is_active',filter.is_active);">
        <el-option
          v-for="item in activeList"
          :key="'activeList'+item.id"
          :label="item.name"
          :value="item.id">
        </el-option>
      </el-select>
      <el-button
        size="large"
        class="filter-button"
        type="success"
        @click="setNewWidget()"
      >
        Добавить виджет
      </el-button>
    </div>

    <div class="table-box white-box">
      <el-table
        ref="intentTable"
        v-loading="loadingTable"
        :data="widgetList"
        row-key="id"
        style="width: 100%"
        stripe
        table-layout="auto"
        :scrollbar-always-on="true"
      >
        <el-table-column property="name" label="Название"/>
        <el-table-column property="code_name" label="Код"/>
        <el-table-column property="type.name" label="Тип"/>
        <el-table-column property="is_active" label="Активность" align="center" header-align="center">
          <template #default="scope">
            {{ scope.row.is_active ? 'Активен' : 'Не активен' }}
          </template>
        </el-table-column>
        <el-table-column label="" width="100px" align="center" header-align="center">
          <template #default="scope">
            <div class="table-button-box">
              <el-button circle type="warning" title="Редактировать виджет" @click="getWidget(scope.row.id)">
                <div class="ico ico-edit"></div>
              </el-button>
              <el-button v-if="scope.row.type.code==='link'" circle type="danger" title="Удалить виджет" @click="deleteWidget(scope.row)">
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
    </div>

    <el-dialog
      v-if="modalActiveNewWidget"
      v-model="modalActiveNewWidget"
      style="max-width: 600px; width: 90%; min-width: 350px"
      :close-on-click-modal="false"
      title="Новый виджет"
      :before-close="beforeCloseNewWidget"
    >
      <el-form
        ref="newWidgetRef"
        :model="newWidget"
        label-width="auto"
        size="large"
        :rules="rulesWidget"
        style="width: 100%"
        status-icon
        @keydown.stop.prevent.enter="createWidget()"
      >

        <el-form-item label="Активность" prop="is_active">
          <el-checkbox v-model="newWidget.is_active" :value="true" name="is_active">Активный</el-checkbox>
        </el-form-item>

        <el-form-item
          label="Код"
          prop="code_name"
        >
          <el-input
            v-model="newWidget.code_name"
            placeholder="Код"
            size="large"
          />
        </el-form-item>

        <el-form-item
          label="Название"
          prop="name"
        >
          <el-input
            v-model="newWidget.name"
            placeholder="Название"
            size="large"
          />
        </el-form-item>

        <el-form-item
          label="Описание"
          prop="description"
        >
          <el-input
            v-model="newWidget.description"
            placeholder="Описание"
            size="large"
          />
        </el-form-item>

        <el-form-item
          label="Ссылка"
          prop="url"
        >
          <el-input
            v-model="newWidget.url"
            placeholder="URL"
            size="large"
          />
        </el-form-item>

        <el-form-item
          label="Иконка"
          prop="icon_id"
        >
          <el-select
            v-model="newWidget.icon_id"
            placeholder="Иконка"
            filterable
            clearable
            :value-on-clear="null"
            :loading="loadingIcons"
            size="large">
            <el-option
              v-for="item in iconList"
              :key="'iconList'+item.id"
              :label="item.name"
              :value="item.id">
              <div :class="['icon',item.code ]">
                <div class="grad" style="background:#236bd8;"></div>
              </div>
              <div style="margin-left: 10px">{{ item.name }}</div>
            </el-option>
          </el-select>
        </el-form-item>

        <el-form-item
          label="Цвет иконки"
          prop="bg_colour"
        >
          <el-color-picker v-model="newWidget.bg_colour" size="large"/>
        </el-form-item>

      </el-form>

      <template #footer>
        <div class="dialog-footer">
          <el-button @click="closeNewWidget();">Отмена</el-button>
          <el-button type="primary" :loading="loadSave" @click="createWidget()">
            Добавить
          </el-button>
        </div>
      </template>

    </el-dialog>
    <el-dialog
      v-if="modalActiveUpdate"
      v-model="modalActiveUpdate"
      style="max-width: 600px; width: 90%; min-width: 350px"
      :close-on-click-modal="false"
      title="Редактировать виджет"
      :before-close="beforeCloseUpdateWidget"
    >
      <el-form
        ref="updateWidgetRef"
        :model="widgetInfo"
        label-width="auto"
        size="large"
        :rules="rulesWidget"
        style="width: 100%"
        status-icon
        @keydown.stop.prevent.enter="createWidget()"
      >

        <el-form-item label="Активность" prop="is_active">
          <el-checkbox v-model="widgetInfo.is_active" :value="true" name="is_active">Активный</el-checkbox>
        </el-form-item>

        <el-form-item
          label="Код"
          prop="code_name"
        >
          <el-input
            v-model="widgetInfo.code_name"
            placeholder="Код"
            size="large"
            :disabled="widgetInfo.type.code==='internal'"
          />
        </el-form-item>

        <el-form-item
          label="Название"
          prop="name"
        >
          <el-input
            v-model="widgetInfo.name"
            placeholder="Название"
            size="large"
          />
        </el-form-item>

        <el-form-item
          label="Описание"
          prop="description"
        >
          <el-input
            v-model="widgetInfo.description"
            placeholder="Описание"
            size="large"
          />
        </el-form-item>

        <el-form-item
          v-if="widgetInfo.type.code==='link'"
          label="Ссылка"
          prop="url"
        >
          <el-input
            v-model="widgetInfo.url"
            placeholder="URL"
            size="large"
          />
        </el-form-item>

        <el-form-item
          label="Иконка"
          prop="icon_id"
        >
          <el-select
            v-model="widgetInfo.icon_id"
            placeholder="Иконка"
            filterable
            :value-on-clear="null"
            clearable
            :loading="loadingIcons"
            size="large">
            <el-option
              v-for="item in iconList"
              :key="'iconList'+item.id"
              :label="item.name"
              :value="item.id">
              <div :class="['icon',item.code ]">
                <div class="grad" style="background:#236bd8;"></div>
              </div>
              <div style="margin-left: 10px">{{ item.name }}</div>
            </el-option>
          </el-select>
        </el-form-item>

        <el-form-item
          label="Цвет иконки"
          prop="bg_colour"
        >
          <el-color-picker v-model="widgetInfo.bg_colour" size="large"/>
        </el-form-item>

      </el-form>

      <template #footer>
        <div class="dialog-footer">
          <el-button @click="closeUpdateWidget()">Отмена</el-button>
          <el-button type="primary" :loading="loadSave" @click="updateWidget()">
            Изменить
          </el-button>
        </div>
      </template>

    </el-dialog>
  </div>
</template>
<script>
import {useAppStore} from '../../store/index.js';

export default {
  name: 'WidgetList',
  data() {
    return {
      pagination: {
        current_page: 1,
        per_page: 15,
        total: 1,
      },
      filter: {
        query: null,
        is_active: null,
        type_id: null,
        need_pagination: 1,
      },
      loadingTable: false,
      widgetList: [],
      activeList: [
        {
          id: 1,
          name: 'Активные',
        },
        {
          id: 0,
          name: 'Не активные',
        },
      ],
      loadingWidgetTypes: false,
      widgetTypesList: [],
      loadingIcons: false,
      iconList: [],
      newWidget: {
        code_name: null,
        name: null,
        description: null,
        icon_id: null,
        url: null,
        bg_colour: null,
        is_active: true
      },
      rulesWidget: {},
      modalActiveNewWidget: false,
      loadSave: false,
      modalActiveUpdate:false,
      widgetInfo:null,
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI','isMobile']),
  },
  created() {
    this.initialData();
    this.getWidgetTypes();
    this.getWidgetList();
    this.getIconsList();
  },
  methods: {
    getWidgetList(page) {
      this.loadingTable = true;
      let params = this.filter;
      params.page = page ? page : this.pagination.current_page;
      params.per_page = this.pagination.per_page;
      this.$axios.get(this.linkAPI + 'chat/widgets/list', {params})
        .then((response) => {
          console.log('Виджеты:', response);
          this.widgetList = response.data.data;
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
      this.getWidgetList(val);
      this.setParams('current_page',val);
    },
    handleSizeChange(val) {
      this.getWidgetList();
      this.setParams('per_page',val);
    },
    initialData() {
      if (this.$route.query.widget_id) {
        this.getWidget(this.$route.query.widget_id);
      }
      if (this.$route.query.is_active) {
        this.filter.is_active = this.$route.query.is_active;
      }
      if (this.$route.query.type_id) {
        this.filter.type_id = parseInt(this.$route.query.type_id);
      }
      if (this.$route.query.current_page) {
        this.pagination.current_page = parseInt(this.$route.query.current_page);
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
    getWidgetTypes() {
      this.loadingWidgetTypes = true;
      this.$axios.get(this.linkAPI + 'chat/widgets/get_types')
        .then((response) => {
          console.log('Типы виджетов:', response);
          this.widgetTypesList = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingWidgetTypes = false;
        });
    },
    getIconsList() {
      this.loadingIcons = true;
      this.$axios.get(this.linkAPI + 'chat/widgets/get_icons')
        .then((response) => {
          console.log('Иконки виджетов:', response);
          this.iconList = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingIcons = false;
        });
    },
    beforeCloseNewWidget(done) {
      this.closeNewWidget();
      done();
    },
    closeNewWidget() {
      this.newWidget = {
        code_name: null,
        name: null,
        description: null,
        icon_id: null,
        url: null,
        bg_colour: null,
        is_active: true
      };
      this.modalActiveNewWidget = false;
    },
    createWidget() {
      this.$refs['newWidgetRef'].validate((valid) => {
        if (valid) {
          this.loadSave = true;
          let params = this.newWidget;
          this.$axios.post(this.linkAPI + 'chat/widgets/create', params)
            .then((response) => {
              console.log('Создание нового виджета:', response.data);
              if (response.data.success) {
                ElMessage({
                  type: 'success',
                  message: 'Виджет успешно добавлен',
                });
                this.closeNewWidget();
                this.getWidgetList();
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
            });
        } else {
          ElMessage.error('Заполните обязательные поля');
          return false;
        }
      });
    },
    setNewWidget() {
      this.newWidget = {
        code_name: null,
        name: null,
        description: null,
        icon_id: null,
        url: null,
        bg_colour: null,
        is_active: true
      };
      this.rulesWidget = {
        'code_name': [{
          required: true,
          message: 'Введите код',
          trigger: 'blur',
        }],
        'name': [{
          required: true,
          message: 'Введите название',
          trigger: 'blur',
        }],
        'url': [{
          required: true,
          message: 'Введите ссылку',
          trigger: 'blur',
        }],
      };

      this.modalActiveNewWidget = true;
    },
    deleteWidget(widget) {
      ElMessageBox.confirm(
        'Вы действительно хотите удалить виджет «' + widget.name + '»?',
        'Внимание!',
        {
          confirmButtonText: 'Да',
          cancelButtonText: 'Нет',
          type: 'warning',
        }
      )
        .then(() => {
          this.loadingTable = true;
          this.$axios.post(this.linkAPI + 'chat/widgets/'+widget.id+'/delete')
            .then((response) => {
              console.log('Удаление виджета:', response.data);
              if (response.data.success) {
                ElMessage({
                  type: 'success',
                  message: 'Виджет успешно удален',
                });
                this.getWidgetList();
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
              this.loadingTable = false;
            });
        });
    },
    getWidget(id){
      this.loadingTable = true;
      this.$axios.get(this.linkAPI + 'chat/widgets/'+id+'/get')
        .then((response) => {
          console.log('Виджет:', response);
          this.widgetInfo = response.data;
          if(this.widgetInfo.type.code==='internal'){
            this.rulesWidget = {
              'code_name': [{
                required: true,
                message: 'Введите код',
                trigger: 'blur',
              }],
              'name': [{
                required: true,
                message: 'Введите название',
                trigger: 'blur',
              }],
            };
          } else if(this.widgetInfo.type.code==='link'){
            this.rulesWidget = {
              'code_name': [{
                required: true,
                message: 'Введите код',
                trigger: 'blur',
              }],
              'name': [{
                required: true,
                message: 'Введите название',
                trigger: 'blur',
              }],
              'url': [{
                required: true,
                message: 'Введите ссылку',
                trigger: 'blur',
              }],
            };
          }
          this.modalActiveUpdate = true;
          this.setParams('widget_id', this.widgetInfo.id);
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingTable = false;
        })
      ;
    },
    closeUpdateWidget(){
      this.modalActiveUpdate = false;
      this.widgetInfo = null;
      this.setParams('widget_id', null);
    },
    beforeCloseUpdateWidget(done) {
      this.closeUpdateWidget();
      done();
    },
    updateWidget(){
      this.$refs['updateWidgetRef'].validate((valid) => {
        if (valid) {
          this.loadSave = true;
          let params = this.widgetInfo;
          this.$axios.post(this.linkAPI + 'chat/widgets/'+this.widgetInfo.id+'/update', params)
            .then((response) => {
              console.log('Изменение  виджета:', response.data);
              if (response.data.success) {
                ElMessage({
                  type: 'success',
                  message: 'Виджет успешно изменен',
                });
                this.closeUpdateWidget();
                this.getWidgetList();
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
            });
        } else {
          ElMessage.error('Заполните обязательные поля');
          return false;
        }
      });
    },
  }
};
</script>

<style scoped>

.filter-box {
  display: grid;
  grid-template-columns: repeat(3, 1fr) max-content;
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
