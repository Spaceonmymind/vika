<template>
  <div class="login-page">
    <div v-if="!recovery" class="white-box login-box">
      <div class="logo"></div>
      <div class="title-login">
        Авторизация
      </div>
      <el-form
        ref="login-form"
        :model="form"
        label-width="auto"
        label-position="top"
        size="large"
        style="width: 100%"
        @keydown.stop.prevent.enter="login()"
      >
        <el-form-item
          label="Логин (Email)"
          prop="email"
          :rules="[rules.email]"
        >
          <el-input
            v-model="form.email"
            placeholder="Логин"
            size="large"
          />
        </el-form-item>

        <el-form-item
          label="Пароль"
          prop="password"
          :rules="[rules.password]"
        >
          <el-input
            v-model="form.password"
            type="password"
            placeholder="Пароль"
            show-password
            size="large"
          />
        </el-form-item>
      </el-form>

      <div class="recovery-box">
        <el-button
          type="primary"
          link
          @click="recovery=true"
        >
          Не помню пароль
        </el-button>
      </div>

      <el-button
        type="success"
        style="width: 100%"
        size="large"
        :loading="loading"
        @click="login()"
      >
        Войти
      </el-button>
    </div>
    <div v-else class="white-box login-box">
      <div class="logo"></div>
      <div class="title-login">
        Восстановление доступа
      </div>
      <el-form
        ref="recovery-form"
        :model="recoveryForm"
        label-width="auto"
        label-position="top"
        size="large"
        style="width: 100%"
        :rules="ruleRecovery"
        @keydown.stop.prevent.enter="setRecovery()"
      >
        <el-form-item
          label="Email"
          prop="email"
        >
          <el-input
            v-model="recoveryForm.email"
            placeholder="Введите Email"
            size="large"
          />
        </el-form-item>
      </el-form>

      <div class="recovery-button-box">
        <el-button
          style="width: 100%"
          size="large"
          @click="recovery = false"
        >
          Назад
        </el-button>

        <el-button
          type="success"
          style="width: 100%"
          size="large"
          :loading="loading"
          @click="setRecovery()"
        >
          Отправить
        </el-button>
      </div>
    </div>
  </div>
</template>

<script>
import {useAppStore} from '../store/index.js';

export default {
  name: 'LoginPage',
  data() {
    return {
      form: {
        email: '',
        password: '',
      },
      loading: false,
      rules: {
        email: {
          required: true,
          message: 'Введите логин',
          trigger: 'blur',
        },
        password: {
          required: true,
          message: 'Введите пароль',
          trigger: 'blur',
        }
      },
      ruleRecovery: {
        email: [
          {required: true, message: 'Введите email', trigger: 'blur',}
        ]
      },
      recoveryForm: {
        email: null,
      },
      recovery: false,
    };
  },
  computed: {
    ...mapWritableState(useAppStore, {
      linkAPI: 'linkAPI',
      user: 'user',
    }),
  },
  methods: {
    login() {
      this.$refs['login-form'].validate((valid) => {
        if (valid) {
          this.loading = true;
          this.$axios.post(this.linkAPI + 'user/login', {email: this.form.email, password: this.form.password})
            .then((response) => {
              this.loading = false;
              console.log('Авторизация:', response.data);
              if (response.data.auth) {
                this.user = response.data.user;
                this.$router.push('/');
              } else {
                ElMessage({
                  type: 'error',
                  message: response.data.error,
                });
              }
            })
            .catch((error) => {
              this.loading = false;
              console.log(error);
              if (error.response.data.errors) {
                ElMessage({
                  type: 'error',
                  message: error.response.data.message,
                });
              }
            });
        } else {
          ElMessage.error('Заполните обязательные поля');
          return false;
        }
      });
    },
    setRecovery() {
      this.$refs['recovery-form'].validate((valid) => {
        if (valid) {
          this.loading = true;
          this.$axios.post(this.linkAPI + 'user/send_reset_password_link', {email: this.recoveryForm.email})
            .then((response) => {
              this.loading = false;
              console.log('Ответ на отправку письма с восстановлением пароля:', response.data);
              if (response.data.success) {
                ElMessage({
                  type: 'success',
                  message: 'Письмо с информацией для восстановления пароля отправлено на указанный Email',
                });
                this.recovery = false;
                this.recoveryForm.email = null;
              } else {
                ElMessage({
                  type: 'error',
                  message: response.data.error,
                });
              }
            })
            .catch((error) => {
              this.loading = false;
              console.log(error);
              if (error.response.data.errors) {
                for (const value of Object.entries(error.response.data.errors)) {
                  ElMessage({
                    type: 'error',
                    message: value[0],
                  });
                }
              }
            });
        } else {
          ElMessage.error('Заполните обязательные поля');
          return false;
        }
      });
    }
  }
};
</script>

<style scoped>
.login-page {
  display: flex;
  align-items: center;
  justify-content: center;

  width: 100%;
  height: 100%;

  font-family: Montserrat, sans-serif !important;

  background: #F5F6F8;
}

.logo {
  width: 80px;
  height: 80px;
  background: url("../../assets/img/logo-big.svg") center no-repeat;
  background-size: 80px;
}

.title-login {
  margin: 30px 0;
  font-size: 22px;
  font-weight: 500;
}

.login-box {
  display: flex;
  flex-direction: column;
  align-items: center;

  width: 90%;
  max-width: 400px;
}

.item-form {
  margin-bottom: 20px;
}

.form-box .item-form:last-child {
  margin-bottom: 0;
}

.recovery-box {
  width: 100%;
  margin-bottom: 13px;
}

.recovery-button-box {
  display: grid;
  grid-template-columns: 1fr 1fr;
  column-gap: 20px;

  width: 100%;
  margin-top: 25px;
}

</style>
