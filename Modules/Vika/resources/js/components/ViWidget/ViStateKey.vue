<template>
  <div
    class="vi-state-key"
  >
    <div class="content-box">
      <div class="scroll-box">
        <div class="content">
          <ul>
            <li>
              <a
                href="https://www.gosuslugi.ru/help/faq/app_gosuslugi/55501"
                target="_blank"
              >Что такое приложение «Госключ»</a>
            </li>
            <li>
              <a
                href="https://www.gosuslugi.ru/goskey"
                target="_blank"
              >Приложение «Госключ»</a>
            </li>
            <li>
              <a
                href="https://www.gosuslugi.ru/help/faq/state_key/55503"
                target="_blank"
              >Что можно подписывать с помощью приложения «Госключ»</a>
            </li>
            <li>
              <a
                href="https://www.gosuslugi.ru/help/faq/state_key/174540"
                target="_blank"
              >Кто может получить сертификат УКЭП в приложении «Госключ»</a>
            </li>
            <li>
              <a
                href="https://www.gosuslugi.ru/600373/1/form?_=1723099821432"
                target="_blank"
              >Подписание документов в приложении «Госключ»</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ViStateKey'
};
</script>

<style scoped>

.vi-state-key {
  display: grid;
  grid-template-rows: 100%;
}

.content-box {
  position: relative;
  height: 100%;
  padding-bottom: 30px;
}

.content {
  padding: 0 25px;

  font-family: Montserrat, sans-serif;
  font-size: 16px;
  font-weight: 500;
  line-height: 170%;
}

.content ul, ol {
  margin-left: 0;
  padding-left: 0;
}

.content ul li, .content ol li {
  display: flex;
  align-items: center;
  margin-bottom: 5px;
  list-style: none;
}

.content li::before {
  content: '';

  flex-shrink: 0;

  width: 7px;
  height: 7px;
  margin-right: 13px;
  border-radius: 100%;

  background: #264ABF;
}

.content a {
  color: #264ABF;
  text-decoration: none;
}

</style>
