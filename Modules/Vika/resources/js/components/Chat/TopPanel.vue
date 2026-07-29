<script>
export default {
    name: 'TopPanel'
};
</script>

<template>
  <div class="top-panel">
    <div class="title">
      Сообщения
    </div>
    <div class="logo" />
  </div>
</template>

<style scoped>
    .top-panel{
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        text-align: center;
    }

    .title{
        font-family: Montserrat, sans-serif;
        font-size: 17px;
        font-weight: 500;
        color: #282828;
    }

    .logo{
        position: absolute;
        right: 40px;
        width: 26px;
        height: 20px;
        background: url("../../../assets/img/vi-logo.svg");
        background-size: 26px;
    }

</style>
