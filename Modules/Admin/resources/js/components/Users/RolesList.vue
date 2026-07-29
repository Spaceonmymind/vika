<template>
  <div class="roles-list">
    <div class="white-box filter-box">
      <el-input
        v-model="filter.name"
        size="large"
        clearable
        placeholder="Поиск по названию"
        @clear="getRoleList();setParams('name', filter.name)"
        @keyup.enter="getRoleList();setParams('name', filter.name)"
      ></el-input>
      <el-button
        size="large"
        class="filter-button"
        type="success"
        @click="setNewRole()"
      >
        Добавить роль
      </el-button>
    </div>
    <div class="table-box white-box">
      <el-table
        ref="userTable"
        v-loading="loadingTable"
        :data="roleList"
        row-key="id"
        stripe
        style="width: 100%"
        table-layout="auto"
        @selection-change="selectionTableChange"
      >
        <el-table-column type="selection" width="55"/>
        <el-table-column property="name" label="Код" width="200px"/>
        <el-table-column property="russian_name" label="Название"/>

        <el-table-column property="users_count" label="Количество пользователей" width="250px" align="center" header-align="center">
          <template #default="scope">
            <el-button link type="primary" @click="toUserPage(scope.row.id)">
              {{scope.row.users_count}}
            </el-button>
          </template>
        </el-table-column>

        <el-table-column label="" width="90px">
          <template #default="scope">
            <div class="table-button-box">
              <el-button circle type="warning" title="Редактировать роль" @click="getRole(scope.row.id)">
                <div class="ico ico-edit"></div>
              </el-button>
              <el-button circle type="danger" title="Удалить роль" @click="setDeleteRole(scope.row)">
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
        <el-button v-if="selectTable.length!==0" circle type="danger" title="Удалить пользователей" @click="setDeleteRoleGroup()">
          <div class="ico ico-delete"></div>
        </el-button>
      </div>

    </div>

    <el-dialog
      v-if="modalActive"
      v-model="modalActive"
      :close-on-click-modal="false"
      :before-close="handleClose"
      :title="roleInfo.id ? 'Редактирование роли' :'Новая роль'"
    >
      <el-form
        ref="role-form"
        :model="roleInfo"
        label-width="auto"
        size="large"
        :rules="rules"
        style="width: 100%"
        status-icon
        @keydown.stop.prevent.enter='roleInfo.id ? updateRole() :createRole()'
      >

        <el-form-item
          label="Код"
          prop="name"
        >
          <el-input
            v-model="roleInfo.name"
            placeholder="Код"
            size="large"
          />
        </el-form-item>

        <el-form-item
          label="Название"
          prop="russian_name"
        >
          <el-input
            v-model="roleInfo.russian_name"
            placeholder="Название"
            size="large"
          />
        </el-form-item>

        <el-form-item label="Разрешения" prop="permissions">
          <el-checkbox-group v-model="roleInfo.permissions">
            <el-checkbox
              v-for="permission in permissionsList"
              :key="'permission'+permission.id" :value="permission.id"
              name="permission">
              {{ permission.russian_name }}
            </el-checkbox>
          </el-checkbox-group>
        </el-form-item>

      </el-form>

      <template #footer>
        <div class="dialog-footer">
          <el-button @click="closeRole()">Отмена</el-button>
          <el-button type="primary" :loading="loadSave" @click="roleInfo.id ? updateRole() :createRole()">
            {{ roleInfo.id ? 'Сохранить' : 'Добавить' }}
          </el-button>
        </div>
      </template>

    </el-dialog>
  </div>
</template>

<script>
import {useAppStore} from '../../store/index.js';

export default {
  name: 'RolesList',
  data() {
    return {
      pagination: {
        current_page: 1,
        per_page: 15,
        total: 1,
      },
      filter: {
        name: null,
      },
      loadingPermissions: false,
      permissionsList: [],
      loadingTable: false,
      roleList: [],
      selectTable: [],
      roleInfo: {
        name: null,
        russian_name: null,
        permissions: []
      },
      rules: {
        'name': [{
          required: true,
          message: 'Введите код роли',
          trigger: 'blur',
        }],
        'russian_name': [{
          required: true,
          message: 'Введите название роли',
          trigger: 'blur',
        }],
        'permissions':[
          {
            validator: (rule, value, callback) => {
              if (value.length===0) {
                callback(new Error('Выберите разрешения для роли'));
              } else {
                callback();
              }
            },
            required: true,
            trigger: 'blur'
          },
        ]
      },
      modalActive: false,
      loadSave: false,
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI','isMobile']),
  },
  created() {
    this.initialData();
    this.getPermissions();
    this.getRoleList();
  },
  methods: {
    getPermissions() {
      this.loadingPermissions = true;
      let params = {
        without_grouping: 1,
      };
      this.$axios.get(this.linkAPI + 'users/get_permissions', {params})
        .then((response) => {
          console.log('Разрешения:', response);
          this.permissionsList = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingPermissions = false;
        })
      ;
    },
    getRoleList(page) {
      this.loadingTable = true;
      let params = this.filter;
      params.page = page ? page : this.pagination.current_page;
      params.per_page = this.pagination.per_page;
      this.$axios.get(this.linkAPI + 'roles/list', {params})
        .then((response) => {
          console.log('Роли:', response);
          this.roleList = response.data.data;
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
    selectionTableChange(selection) {
      this.selectTable = selection;
    },
    handleCurrentChange(val) {
      this.getRoleList(val);
      this.setParams('current_page',val);
    },
    handleSizeChange(val) {
      this.getRoleList();
      this.setParams('per_page',val);
    },
    setNewRole() {
      this.roleInfo = {
        name: null,
        russian_name: null,
        permissions: []
      };
      this.modalActive = true;
    },
    createRole() {
      this.$refs['role-form'].validate((valid) => {
        if (valid) {
          this.loadSave = true;
          let params = this.roleInfo;
          this.$axios.post(this.linkAPI + 'roles/create', params)
            .then((response) => {
              this.loading = false;
              console.log('Создание нового роль:', response.data);
              if (response.data.success) {
                this.modalActive = false;
                ElMessage({
                  type: 'success',
                  message: 'Роль успешно добавлена',
                });
                this.getRoleList(this.pagination.current_page);
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
    getRole(id) {
      this.loadingTable = true;
      this.$axios.get(this.linkAPI + 'roles/' + id + '/get')
        .then((response) => {
          console.log('Роль:', response);
          this.roleInfo.id = response.data.id;
          this.roleInfo.name = response.data.name;
          this.roleInfo.russian_name = response.data.russian_name;
          this.roleInfo.permissions = response.data.permissions.map(item => item.id);
          this.modalActive = true;
          this.setParams('role_id', this.roleInfo.id);
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingTable = false;
        })
      ;
    },
    updateRole() {
      this.$refs['role-form'].validate((valid) => {
        if (valid) {
          this.loadSave = true;
          let params = this.roleInfo;
          this.$axios.post(this.linkAPI + 'roles/' + this.roleInfo.id + '/update', params)
            .then((response) => {
              this.loading = false;
              console.log('Изменение роли:', response.data);
              if (response.data.success) {
                this.modalActive = false;
                ElMessage({
                  type: 'success',
                  message: 'Роль успешно обновлена',
                });
                this.getRoleList(this.pagination.current_page);
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
    async deleteRole(id) {
      try {
        let response = await this.$axios.post(this.linkAPI + 'roles/' + id + '/delete');
        return response;
      } catch (error) {
        console.log(error);
        return error;
      }
    },
    setDeleteRole(role) {
      ElMessageBox.confirm(
        'Вы действительно хотите удалить роль "' + role.russian_name + '"?',
        'Внимание!',
        {
          confirmButtonText: 'Да',
          cancelButtonText: 'Нет',
          type: 'warning',
        }
      )
        .then(async () => {
          this.loadingTable = true;
          let response = await this.deleteRole(role.id);
          this.loadingTable = false;
          if (response.data.success) {
            ElMessage({
              type: 'success',
              message: 'Роль успешно удалена',
            });
            this.getRoleList(this.pagination.current_page);
          } else {
            ElMessage({
              type: 'error',
              message: response.data.error,
            });
          }
        })
        .catch(() => {
          ElMessage({
            type: 'info',
            message: 'Удаление отменено',
          });
        });

    },
    setDeleteRoleGroup() {
      ElMessageBox.confirm(
        'Вы действительно хотите удалить выбранные роли?',
        'Внимание!',
        {
          confirmButtonText: 'Да',
          cancelButtonText: 'Нет',
          type: 'warning',
        }
      )
        .then(() => {
          this.loadingTable = true;
          Promise.allSettled(this.selectTable.map(item=>this.deleteRole(item.id))).finally(() => {
            this.loadingTable = false;
            this.getRoleList(this.pagination.current_page);
          });
        })
        .catch(() => {
          ElMessage({
            type: 'info',
            message: 'Удаление отменено',
          });
        });
    },
    toUserPage(id){
      this.$router.push({ path: '/users/list', query: { 'roles[]': id } });
    },
    initialData() {
      if (this.$route.query.role_id) {
        this.getRole(this.$route.query.role_id);
      }
      if (this.$route.query.name) {
        this.filter.name = this.$route.query.name;
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
    handleClose(done) {
      this.closeRole();
      done();
    },
    closeRole() {
      this.modalActive = false;
      this.setParams('role_id', null);
    }
  }
};
</script>

<style scoped>

.filter-box {
  display: grid;
  grid-template-columns: 1fr max-content;
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


@media (width <= 1200px) {
  .filter-box {
    grid-template-columns: 1fr max-content;
  }
}

@media (width <= 992px) {
  .filter-box {
    grid-template-columns: 1fr max-content;
  }
}

@media (width <= 768px) {
  .filter-box {
    grid-template-columns: 1fr max-content;
  }
}


</style>
