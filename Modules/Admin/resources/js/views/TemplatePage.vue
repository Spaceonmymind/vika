<template>
    <div class="template-page">
      <h1 class="title-page">{{ $route.meta.title }}</h1>
      <router-view />
    </div>
</template>

<script>
export default{
  name: 'TemplatePage'
};
</script>

<style scoped>
.title-page{
  margin: 0 0 20px;
  font-size: 30px;
  font-weight: 500;
}

</style>
