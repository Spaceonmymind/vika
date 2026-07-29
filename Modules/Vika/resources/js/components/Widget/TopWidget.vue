<template>
  <div class="top-widget">
      <div class="logo-head" />
    <div class="tag-head">
      {{ title }}
    </div>

      <div
          class="go_back"
          :title="!telegram && !max ? 'Закрыть виджет' : 'Все сервисы'"
          @click="closeWidget()"
      />
  </div>
</template>

<script>
import {useAppStore} from '../../store/index.js';

export default {
  name: 'TopWidget',
  props: {
    title: {
      type: String,
      default: 'Виджет',
    }
  },
  data(){
    return{
      tg:false,
    };
  },
  computed: {
    ...mapState(useAppStore, ['telegram', 'max']),
  },
  methods:{
    closeWidget(){
      if(!this.telegram && !this.max){
        this.$router.push('/');
      }else{
        if(this.$route.path !== '/widget/list'){
          this.$router.push('/widget/list');
        }else{
          console.log('Закрытие app');
          Telegram.WebApp.close();
            this.$webapp?.close();
        }
      }
    }
  }

};
</script>

<style scoped>
.top-widget {
  display: flex;
  gap: 20px;
  align-items: center;
  justify-content: space-between;

  box-sizing: border-box;
  width: 100%;
  height: 100%;
  padding: 0 25px;
}

.top-widget .logo-head {
  width: 30px;
  height: 30px;
  min-width: 30px;
  background: url("../../../assets/img/vi-blue.svg") no-repeat;
  background-size: 26px;
}

.top-widget .tag-head {
  font-family: Montserrat, sans-serif;
  font-size: 16px;
  font-weight: 500;
  line-height: 24px;
  color: #282828;
  text-align: center;
}

.top-widget .go_back {
  cursor: pointer;
  min-width: 30px;
  width: 30px;
  height: 30px;
  background: url("../../../assets/img/close.svg") center no-repeat;
  background-size: 20px;
  transition: 0.3s ease;
}

</style>
