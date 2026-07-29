<script>
import ru from 'element-plus/es/locale/lang/ru';
import {useAppStore} from './store/index.js';
export default {
  name: 'App',
  data() {
    return {
      locale: ru,
      screenWidth: window.innerWidth
    };
  },
  computed: {
    ...mapWritableState(useAppStore, {
      isMobile: 'isMobile',
    }),
  },
  watch:{
    'screenWidth': {
      immediate: true,
      handler(newVal) {
        if(newVal){
          this.isMobile = newVal < 768;
        }
      }
    },
  },
  mounted() {
    window.addEventListener('resize', this.updateScreenWidth);
    this.updateScreenWidth(); // сразу установить значение
  },
  beforeUnmount() {
    window.removeEventListener('resize', this.updateScreenWidth);
  },
  methods: {
    updateScreenWidth() {
      this.screenWidth = window.innerWidth;
    }
  }

};
</script>

<template>
  <el-config-provider :locale="locale">
    <router-view />
  </el-config-provider>
</template>

<style scoped>

</style>
