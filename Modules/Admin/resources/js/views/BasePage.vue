<template>
  <div class="home-page">
    <div class="top-panel">
      <router-link to="/">
        <div class="logo" />
      </router-link>
      <UserProfile />
    </div>
    <div class="body-box">
      <div class="left-box">
        <SystemMenu />
      </div>
      <div class="right-box">
        <router-view />
      </div>
    </div>
  </div>
</template>

<script>
import UserProfile from '../components/UserProfile.vue';
import SystemMenu from '../components/SystemMenu.vue';

export default {
  name: 'HomePage',
  components: {
    UserProfile,
    SystemMenu,
  },
};
</script>

<style scoped>
.home-page {
  display: grid;
  grid-template-rows: auto 1fr;
  row-gap: 20px;
  width: 100%;
  min-height: 100%;
  font-family: Montserrat, sans-serif;
  background: #F5F6F8;
}

.body-box {
  display: grid;
  grid-template-columns: auto 1fr;
  column-gap: 20px;
  padding-bottom: 20px;
}

.left-box{
  padding-left: 20px;
}


.right-box{
  padding-right: 20px;
}

.top-panel{
  display: flex;
  gap: 20px;
  align-items: center;
  justify-content: space-between;

  min-height: 90px;
  padding: 0 20px;

  background: #2a7e76;
}

.logo{
  width: 60px;
  height: 60px;
  background-image: url("../../assets/img/logo-big.svg");
  background-size: 60px;
}

@media (width <= 768px) {
  .body-box  {
    grid-template-columns: initial;
    grid-template-rows: max-content;
    row-gap: 20px;
  }

  .left-box{
    padding-right: 20px;
  }

  .right-box{
    padding-left: 20px;
  }

}


</style>
