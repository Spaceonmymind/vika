<template>
  <div class="users-list">
    <div class="white-box filter-box">
      <el-input
          v-model="filter.query"
          size="large"
          clearable
          placeholder="Поиск по ФИО, e-mail"
          @clear="getUserList(); setParams('query',filter.query);"
          @keyup.enter="getUserList(); setParams('query',filter.query);"
      ></el-input>
      <el-select
          v-model="filter.roles"
          placeholder="Роли"
          multiple
          filterable
          clearable
          collapse-tags
          size="large"
          collapse-tags-tooltip
          :max-collapse-tags="3"
          @change="getUserList(); setParams('roles[]',filter.roles);">
        <el-option
            v-for="item in roleList"
            :key="'roleList'+item.id"
            :label="item.russian_name"
            :value="item.id"
        >
        </el-option>
      </el-select>
      <el-select
          v-model="filter.permissions"
          placeholder="Разрешения"
          multiple
          filterable
          clearable
          size="large"
          collapse-tags
          collapse-tags-tooltip
          :max-collapse-tags="3"
          @change="getUserList(); setParams('permissions[]',filter.permissions);">
        <el-option
            v-for="item in permissionsList"
            :key="'permissionsList'+item.id"
            :label="item.russian_name"
            :value="item.id">
        </el-option>
      </el-select>
      <el-button
          size="large"
          class="filter-button"
          type="success"
          @click="setNewUser()"
      >
        Добавить пользователя
      </el-button>
    </div>
    <div class="table-box white-box">
      <el-table
          ref="userTable"
          v-loading="loadingTable"
          :data="userList"
          row-key="id"
          style="width: 100%"
          table-layout="auto"
          stripe
          @selection-change="selectionTableChange"
      >
        <el-table-column type="selection" width="55"/>
        <el-table-column property="person" label="ФИО">
          <template #default="scope">
            {{scope.row.person.last_name!==null ? scope.row.person.last_name : ''}} {{scope.row.person.first_name!==null ? scope.row.person.first_name : ''}} {{scope.row.person.middle_name!==null ? scope.row.person.middle_name : ''}}
          </template>
        </el-table-column>
        <el-table-column property="last_logged_in" label="Последняя авторизация">
          <template #default="scope">
            {{scope.row.last_logged_in!==null ? scope.row.last_logged_in : 'Не известно'}}
          </template>
        </el-table-column>
        <el-table-column property="email" label="Email"/>
        <el-table-column label="Роли">
          <template #default="scope">
            <ul>
              <li v-for="role in scope.row.roles" :key="'role'+role.id">{{ role.russian_name }}</li>
            </ul>
          </template>
        </el-table-column>
        <el-table-column label="Разрешения">
          <template #default="scope">
            <ul>
              <li v-for="permission in scope.row.permissions" :key="'permission'+permission.id">
                {{ permission.russian_name }}
              </li>
            </ul>
          </template>
        </el-table-column>
        <el-table-column label="" width="120px">
          <template #default="scope">
            <div class="table-button-box">
              <el-button circle type="primary" title="Авторизоваться" @click="loginUser(scope.row.id)">
                <div class="ico ico-login"></div>
              </el-button>
              <el-button circle type="warning" title="Редактировать пользователя" @click="getUser(scope.row.id)">
                <div class="ico ico-edit"></div>
              </el-button>
              <el-button circle type="danger" title="Удалить пользователя" @click="setDeleteUser(scope.row)">
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
        <el-button v-if="selectTable.length!==0" circle type="danger" title="Удалить пользователей" @click="setDeleteUserGroup()">
          <div class="ico ico-delete"></div>
        </el-button>
      </div>

    </div>

    <el-dialog
        v-if="modalActive"
        v-model="modalActive"
        :close-on-click-modal="false"
        :before-close="handleClose"
        :title="userInfo.id ? 'Редактирование пользователя' :'Новый пользователь'"
    >
      <el-form
          ref="user-form"
          :model="userInfo"
          label-width="auto"
          size="large"
          :rules="rules"
          style="width: 100%"
          status-icon
          @keydown.stop.prevent.enter='userInfo.id ? updateUser() :createUser()'
      >

        <el-form-item
            label="Фамилия"
            prop="person.last_name"
        >
          <el-input
              v-model="userInfo.person.last_name"
              placeholder="Фамилия"
              size="large"
          />
        </el-form-item>

        <el-form-item
            label="Имя"
            prop="person.first_name"
        >
          <el-input
              v-model="userInfo.person.first_name"
              placeholder="Имя"
              size="large"
          />
        </el-form-item>

        <el-form-item
            label="Отчество"
            prop="person.middle_name"
        >
          <el-input
              v-model="userInfo.person.middle_name"
              placeholder="Отчество"
              size="large"
          />
        </el-form-item>

        <el-form-item
            label="Логин"
            prop="user.name"
        >
          <el-input
              v-model="userInfo.user.name"
              placeholder="Логин"
              size="large"
          />
        </el-form-item>

        <el-form-item
            label="Email"
            prop="user.email"
        >
          <el-input
              v-model="userInfo.user.email"
              placeholder="Email"
              size="large"
          />
        </el-form-item>

        <el-form-item
            label="Пароль"
            prop="user.password"
        >
          <el-input
              v-model="userInfo.user.password"
              type="password"
              placeholder="Пароль"
              show-password
              size="large"
          />
        </el-form-item>

        <el-form-item
            label="Повтор пароля"
            prop="user.doublePassword"
        >
          <el-input
              v-model="userInfo.user.doublePassword"
              type="password"
              placeholder="Пароль"
              show-password
              size="large"
          />
        </el-form-item>

        <el-form-item label="Роли" prop="user.roles">
          <el-checkbox-group v-model="userInfo.user.roles" @change="getPermissionsUser()">
            <el-checkbox v-for="role in roleList" :key="'role'+role.id" :value="role.id" name="role">
              {{ role.russian_name }}
            </el-checkbox>
          </el-checkbox-group>
        </el-form-item>

        <el-form-item label="Разрешения" prop="user.permissions">
          <el-checkbox-group v-model="userInfo.user.permissions">
            <el-checkbox
                v-for="permission in permissionsList"
                :key="'permission'+permission.id" :disabled="isRolePermission(permission.id)" :value="permission.id"
                name="permission">
              {{ permission.russian_name }}
            </el-checkbox>
          </el-checkbox-group>
        </el-form-item>

      </el-form>

      <template #footer>
        <div class="dialog-footer">
          <el-button @click="closeUser();">Отмена</el-button>
          <el-button type="primary" :loading="loadSave" @click="userInfo.id ? updateUser() :createUser()">
            {{ userInfo.id ? 'Сохранить' : 'Добавить' }}
          </el-button>
        </div>
      </template>

    </el-dialog>
  </div>
</template>

<script>
import {useAppStore} from '../../store/index.js';

export default {
  name: 'UsersList',
  data() {
    return {
      pagination: {
        current_page: 1,
        per_page: 15,
        total: 1,
      },
      filter: {
        query: null,
        roles: [],
        permissions: []
      },
      loadingRole: false,
      loadingPermissions: false,
      roleList: [],
      permissionsList: [],
      loadingTable: false,
      userList: [],
      selectTable: [],
      userInfo: {
        user: {
          email: null,
          name: null,
          password: null,
          doublePassword: null,
          roles: [],
          permissions: []
        },
        person: {
          last_name: null,
          first_name: null,
          middle_name: null
        }
      },
      rules: {
        'user.name': [{
          required: true,
          message: 'Введите логин',
          trigger: 'blur',
        }],
        'user.email': [{
          required: true,
          message: 'Введите email',
          trigger: 'blur',
        }],
        'person.first_name': [{
          required: true,
          message: 'Введите имя',
          trigger: 'blur',
        }],
        'person.last_name': [{
          required: true,
          message: 'Введите фамилию',
          trigger: 'blur',
        }],
      },
      modalActive: false,
      loadSave: false,
      loadingPermissionsUser: false,
      permissionsListRole: [],
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI','fetchUser','isMobile']),
  },
  created() {
    this.initialData();
    this.getRoles();
    this.getPermissions();
    this.getUserList();
  },
  methods: {
    getRoles() {
      this.loadingRole = true;
      this.$axios.get(this.linkAPI + 'users/get_roles')
          .then((response) => {
            console.log('Роли:', response);
            this.roleList = response.data;
          })
          .catch((error) => {
            console.log(error);
          })
          .finally(() => {
            this.loadingRole = false;
          })
      ;
    },
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
    getUserList(page) {
      this.loadingTable = true;
      let params = this.filter;
      params.page = page ? page : this.pagination.current_page;
      params.per_page = this.pagination.per_page;
      this.$axios.get(this.linkAPI + 'users/list', {params})
          .then((response) => {
            console.log('Пользователи:', response);
            this.userList = response.data.data;
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
      this.getUserList(val);
      this.setParams('current_page',val);
    },
    handleSizeChange(val) {
      this.getUserList();
      this.setParams('per_page',val);
    },
    setNewUser() {
      this.userInfo = {
        user: {
          email: null,
          name: null,
          password: null,
          doublePassword: null,
          roles: [],
          permissions: []
        },
        person: {
          last_name: null,
          first_name: null,
          middle_name: null
        }
      };

      this.rules['user.password'] = [{
        required: true,
        message: 'Введите пароль',
        trigger: 'blur',
      },
        {min: 8, message: 'Пароль должен быть длиннее 8 символов', trigger: 'blur'},
      ];

      this.rules['user.doublePassword'] = [
        {
          required: true,
          message: 'Введите повтор пароль',
          trigger: 'blur',
        },
        {
          validator: (rule, value, callback) => {
            if (value !== this.userInfo.user.password) {
              callback(new Error('Пароли не совпадают'));
            } else {
              callback();
            }
          },
          trigger: 'blur'
        },
        {min: 8, message: 'Пароль должен быть длиннее 8 символов', trigger: 'blur'},
      ];
      this.permissionsListRole = [];
      this.modalActive = true;
    },
    createUser() {
      this.$refs['user-form'].validate((valid) => {
        if (valid) {
          this.loadSave = true;
          let params = this.userInfo;
          params.user.permissions = params.user.permissions.filter(item => !this.isRolePermission(item));
          this.$axios.post(this.linkAPI + 'users/create', params)
              .then((response) => {
                this.loading = false;
                console.log('Создание нового пользователя:', response.data);
                if (response.data.success) {
                  this.modalActive = false;
                  ElMessage({
                    type: 'success',
                    message: 'Пользователь успешно добавлен',
                  });
                  this.getUserList(this.pagination.current_page);
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
    getPermissionsUser() {
      this.loadingPermissionsUser = true;
      let params = {
        roles: this.userInfo.user.roles,
        without_grouping: 0,
      };
      this.$axios.get(this.linkAPI + 'users/get_permissions', {params})
          .then((response) => {
            console.log('Разрешения:', response);
            this.permissionsListRole = response.data.permissions_in_roles;
            this.userInfo.user.permissions = [...new Set([...this.userInfo.user.permissions, ...response.data.permissions_in_roles.map(item => item.id)])];
          })
          .catch((error) => {
            console.log(error);
          })
          .finally(() => {
            this.loadingPermissionsUser = false;
          })
      ;
    },
    isRolePermission(id) {
      return this.permissionsListRole.map(item => item.id).includes(id);
    },
    getUser(id) {
      this.loadingTable = true;
      this.$axios.get(this.linkAPI + 'users/' + id + '/get')
          .then((response) => {
            console.log('Пользователь:', response);
            this.userInfo.id = response.data.id;
            this.userInfo.user.name = response.data.name;
            this.userInfo.user.email = response.data.email;
            this.userInfo.user.roles = response.data.roles.map(item => item.id);
            this.userInfo.user.permissions = response.data.permissions.map(item => item.id);
            this.userInfo.user.password = null;
            this.userInfo.user.doublePassword = null;
            this.userInfo.person.last_name = response.data.person.last_name;
            this.userInfo.person.first_name = response.data.person.first_name;
            this.userInfo.person.middle_name = response.data.person.middle_name;
            this.permissionsListRole = [];
            this.getPermissionsUser();
            this.rules['user.password'] = [
              {
                validator: (rule, value, callback) => {
                  if (value !== null && value.length !== 0 && value.length < 8) {
                    callback(new Error('Пароль должен быть длиннее 8 символов'));
                  } else {
                    callback();
                  }
                },
                trigger: 'blur'
              },
            ];
            this.rules['user.doublePassword'] = [
              {
                validator: (rule, value, callback) => {
                  if (this.userInfo.user.password !== null && this.userInfo.user.password.length !== 0 && value !== this.userInfo.user.password) {
                    callback(new Error('Пароли не совпадают'));
                  } else {
                    callback();
                  }
                },
                trigger: 'blur'
              },
            ];
            this.modalActive = true;
            this.setParams('user_id', this.userInfo.id);
          })
          .catch((error) => {
            console.log(error);
          })
          .finally(() => {
            this.loadingTable = false;
          })
      ;
    },
    updateUser() {
      this.$refs['user-form'].validate((valid) => {
        if (valid) {
          this.loadSave = true;
          let params = this.userInfo;
          params.user.permissions = params.user.permissions.filter(item => !this.isRolePermission(item));
          if (params.user.password === null || params.user.password.length === 0) {
            delete params.user.password;
            delete params.user.doublePassword;
          }
          this.$axios.post(this.linkAPI + 'users/' + this.userInfo.id + '/update', params)
              .then((response) => {
                this.loading = false;
                console.log('Изменение пользователя:', response.data);
                if (response.data.success) {
                  this.modalActive = false;
                  ElMessage({
                    type: 'success',
                    message: 'Пользователь успешно обновлен',
                  });
                  this.getUserList(this.pagination.current_page);
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
    async deleteUser(id) {
      try {
        let response = await this.$axios.post(this.linkAPI + 'users/' + id + '/delete');
        return response;
      } catch (error) {
        console.log(error);
        return error;
      }
    },
    setDeleteUser(user) {
      ElMessageBox.confirm(
          'Вы действительно хотите удалить пользователя ' + user.name + '?',
          'Внимание!',
          {
            confirmButtonText: 'Да',
            cancelButtonText: 'Нет',
            type: 'warning',
          }
      )
          .then(async () => {
            this.loadingTable = true;
            let response = await this.deleteUser(user.id);
            this.loadingTable = false;
            if (response.data.success) {
              ElMessage({
                type: 'success',
                message: 'Пользователь успешно удален',
              });
              this.getUserList(this.pagination.current_page);
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
    setDeleteUserGroup() {
      ElMessageBox.confirm(
          'Вы действительно хотите удалить выбранных пользователей?',
          'Внимание!',
          {
            confirmButtonText: 'Да',
            cancelButtonText: 'Нет',
            type: 'warning',
          }
      )
          .then(() => {
            this.loadingTable = true;
            Promise.allSettled(this.selectTable.map(item=>this.deleteUser(item.id))).finally(() => {
              this.loadingTable = false;
              this.getUserList(this.pagination.current_page);
            });
          })
          .catch(() => {
            ElMessage({
              type: 'info',
              message: 'Удаление отменено',
            });
          });
    },
    async loginUser(id){
      try {
        let response = await this.$axios.post(this.linkAPI + 'users/' + id + '/login');
         if(response.data.success){
            await this.fetchUser();
            this.$router.push('/');
        }
      } catch (error) {
        console.log(error);
      }
    },
    initialData() {
      if (this.$route.query.user_id) {
        this.getUser(this.$route.query.user_id);
      }
      if (this.$route.query.query) {
        this.filter.query = this.$route.query.query;
      }
      if (this.$route.query['roles[]']) {
        if(Array.isArray(this.$route.query['roles[]'])){
          this.filter.roles = this.$route.query['roles[]'].map(item=>parseInt(item));
        }else{
          this.filter.roles = [parseInt(this.$route.query['roles[]'])];
        }
      }
      if (this.$route.query['permissions[]']) {
        if(Array.isArray(this.$route.query['permissions[]'])){
          this.filter.permissions = this.$route.query['permissions[]'].map(item=>parseInt(item));
        }else{
          this.filter.permissions = [parseInt(this.$route.query['permissions[]'])];
        }
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
      this.closeUser();
      done();
    },
    closeUser() {
      this.modalActive = false;
      this.setParams('user_id', null);
    }
  }
};
</script>

<style scoped>

.filter-box {
  display: grid;
  grid-template-columns: repeat(3, auto) max-content;
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

.ico.ico-login {
  background-color: var(--el-color-white);

  mask-image: url("../../../assets/icons/Sign_in.svg");
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
