<template>
  <div
    class="vi-loss-person"
  >
    <div class="content-box">
      <div class="scroll-box">
        <div class="content">
          <b>1. Что делать, если умер человек</b>

          <p>
            <b>1.1. Если человек умер в больнице</b>
            «О происшедшем родственникам должны сообщить сотрудники больницы, так же, как и информацию о том, в каком
            морге находится тело покойного. В этом случае близкие могут сразу обратиться в регистратуру морга для
            оформления медицинского свидетельства о смерти».
          </p>

          <p>
            <b>1.2. Если человек умер дома</b>
          </p>
          <ul>
            <li>
              позвонить в скорую помощь по телефону 103, позвонить в полицию по телефону 102 и сообщить о смерти
              человека, назвав его ФИО
            </li>
            <li>дождаться визита медицинской бригады и полиции, они засвидетельствует факт смерти</li>
            <li>обратиться в регистратуру морга, куда было направлено тело за медицинской справкой о смерти</li>
            <li>обратиться в органы ЗАГС или МФЦ за свидетельством о смерти</li>
            <li>при необходимости обратиться в ритуальную службу</li>
          </ul>


          <p>
            <b>2. <a
              href="https://www.gosuslugi.ru/help/faq/registrate_death/84863"
              target="_blank"
            >Что делать, если
              человек умер за границей</a></b>
          </p>

          <p>
            <b>3. <a
              href="https://www.gosuslugi.ru/help/faq/registrate_death/64846?ysclid=l6c20pg1jq128375564"
              target="_blank"
            >Как зарегистрировать смерть</a></b>
          </p>

          <p>
            <b>4. Социальное пособие на погребение</b>
          </p>

          <ul>
            <li>
              <a
                href="https://www.gosuslugi.ru/life/details/pensioner_death?categoryCode=semya"
                target="_blank"
              >Пособие
                на погребение, если умер пенсионер</a>
            </li>
            <li>
              <a
                href="https://www.gosuslugi.ru/life/details/worker_death?categoryCode=semya"
                target="_blank"
              >Пособие
                на погребение, если умерший работал или был несовершеннолетним</a>
            </li>
            <li>
              <a
                href="https://www.gosuslugi.ru/life/details/insured_death?categoryCode=semya"
                target="_blank"
              >Пособия
                на погребение, если умер индивидуальный предприниматель или специалист частной практики</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ViLossPerson'
};
</script>

<style scoped>

.vi-loss-person {
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
