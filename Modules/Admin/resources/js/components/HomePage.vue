<template>
  <div class="home-page">
    <div class="white-box hello">
      <div class="title">Добро пожаловать в панель администрирования!</div>
      <p>По вопросам технической поддержки обращаться в СКИТ:</p>
      <p><a href="mailto:helpdesk@admhmao.ru">helpdesk@admhmao.ru</a> </p>
    </div>
  </div>
</template>
<script>
export default {
  name: 'HomePage'
};
</script>


<style scoped>
.home-page{
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
  gap: 20px;
  flex-wrap: wrap;
}

.home-page .title{
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 10px;
}

.hello{
  width: fit-content;
}

</style>
