<template>
  <div class="vi-widget">
    <TopWidget :title="$route.meta.title" />
    <router-view />
  </div>
</template>

<script>
import TopWidget from '../components/Widget/TopWidget.vue';

export default {
  name: 'ViWidget',
  components: {
    TopWidget,
  }
};
</script>

<style scoped>
.vi-widget {
  display: grid;
  grid-template-rows: 90px calc(100% - 90px);
  height: 100dvh;
}

</style>
