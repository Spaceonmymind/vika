<template>
  <div
    class="vi-ugra-team"
  >
    <div class="content-box">
      <div class="scroll-box">
        <div class="content">
          <ul>
            <li>
              <a
                href="https://ugrateam.admhmao.ru/job/"
                target="_blank"
              >Вакансии</a>
            </li>
            <li>
              <a
                href="https://ugrateam.admhmao.ru/conkursi/"
                target="_blank"
              >Конкурсы</a>
            </li>
            <li>
              <a
                href="https://ugrateam.admhmao.ru/rezerv/"
                target="_blank"
              >Кадровый резерв</a>
            </li>
            <li>
              <a
                href="https://ugrateam.admhmao.ru/gossluzhba/"
                target="_blank"
              >Госслужба</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ViUgraTeam'
};
</script>

<style scoped>

.vi-ugra-team {
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
