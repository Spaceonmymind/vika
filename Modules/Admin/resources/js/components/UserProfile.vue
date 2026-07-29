<template>
  <div class="user-profile">
    <div class="user">
      <div class="name">
        {{ user.name }}
      </div>
      <div class="email">
        {{ user.email }}
      </div>
    </div>
    <div
        class="exit"
        @click="user.is_logged_in_by_another_user ? logoutFromAnotherUser():logout()"
    >
      Выйти
      <div class="ico"/>
    </div>
  </div>
</template>

<script>
import {useAppStore} from '../store/index.js';

export default {
  name: 'UserProfile',
  data() {
    return {
      loading: false,
    };
  },
  computed: {
    ...mapWritableState(useAppStore, {
      linkAPI: 'linkAPI',
      user: 'user',
      fetchUser: 'fetchUser',
    }),
  },
  methods: {
    logout() {
      this.loading = true;
      this.$axios.get(this.linkAPI + 'user/logout')
          .then((response) => {
            console.log('Выход:', response);
            if (response.data.success) {
              this.user = null;
              this.$router.push('/login');
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
            this.loading = false;
          })
      ;
    },
    logoutFromAnotherUser() {
      this.loading = true;
      this.$axios.get(this.linkAPI + 'user/logout_from_another_user')
        .then(async (response) => {
          console.log('Выход из пользователя:', response);
          if (response.data.success) {
            await this.fetchUser();
            this.$router.push('/users/list');
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
          this.loading = false;
        })
      ;
    }
  }
};
</script>

<style scoped>
.user-profile {
  display: flex;
  gap: 20px;
  align-items: center;
  color: #fff;
}

.user {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
}

.email {
  font-size: 12px;
}

.exit {
  cursor: pointer;
  display: flex;
  gap: 5px;
  align-items: center;
}

.exit:hover {
  color: #f1f1f1;
}

.exit .ico {
  width: 25px;
  height: 25px;

  background-color: #fff;

  mask-image: url("../../assets/icons/Sign_in.svg");
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 25px;
}

.exit:hover .ico {
  background-color: #f1f1f1;
}

</style>
