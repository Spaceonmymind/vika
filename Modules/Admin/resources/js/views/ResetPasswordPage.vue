<template>
  <div class="reset-password">
    <div  class="white-box reset-box">
      <div class="logo"></div>
      <div class="title-reset">
        Восстановление пароля
      </div>
      <el-form
        ref="reset-form"
        :model="form"
        label-width="auto"
        label-position="top"
        size="large"
        style="width: 100%; margin-bottom: 20px"
        @keyup.stop.prevent.enter="reset()"
      >
        <el-form-item
          label="Пароль"
          prop="password"
          :rules="rules.password"
        >
          <el-input
            v-model="form.password"
            type="password"
            placeholder="Пароль"
            show-password
            size="large"
          />
        </el-form-item>

        <el-form-item
          label="Повтор пароля"
          prop="doublePassword"
          :rules="rules.doublePassword"
        >
          <el-input
            v-model="form.doublePassword"
            type="password"
            placeholder="Пароль"
            show-password
            size="large"
          />
        </el-form-item>
      </el-form>

      <el-button
        type="success"
        style="width: 100%"
        size="large"
        :loading="loading"
        @click="reset()"
      >
        Сохранить пароль
      </el-button>
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
        password: null,
        doublePassword: null,
        email:this.$route.query.email,
        token:this.$route.query.token,
      },
      loading: false,
      rules: {
        doublePassword: [
          {
            required: true,
            message: 'Введите повтор пароль',
            trigger: 'blur',
          },
          {
            validator: (rule, value, callback) => {
              if (value !== this.form.password) {
                callback(new Error('Пароли не совпадают'));
              } else {
                callback();
              }
            },
            trigger: 'blur'
          },
          {min: 8, message: 'Пароль должен быть длиннее 8 символов', trigger: 'blur'},
        ],
        password: [
          {
            required: true,
            message: 'Введите пароль',
            trigger: 'blur',
          },
          {min: 8, message: 'Пароль должен быть длиннее 8 символов', trigger: 'blur'},
        ]
      },
    };
  },
  computed: {
    ...mapWritableState(useAppStore, {
      linkAPI: 'linkAPI',
    }),
  },
  methods: {
    reset() {
      this.$refs['reset-form'].validate((valid) => {
        if (valid) {
          this.loading = true;
          this.$axios.post(this.linkAPI + 'user/reset_password', {email: this.form.email, password: this.form.password, token:this.form.token})
            .then((response) => {
              this.loading = false;
              console.log('Изменение пароля:', response.data);
              if (response.data.success) {
                ElMessage({
                  type: 'success',
                  message: 'Пароль успешно изменен',
                });
                this.$router.push('/login');
              } else {
                ElMessage({
                  type: 'error',
                  message: 'Что то пошло не так...',
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
    },
  }
};
</script>

<style scoped>
.reset-password {
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

.title-reset {
  margin: 30px 0;
  font-size: 22px;
  font-weight: 500;
}

.reset-box {
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

.recovery-button-box{
  display: grid;
  grid-template-columns: 1fr 1fr;
  column-gap: 20px;

  width: 100%;
  margin-top: 25px;
}

</style>
