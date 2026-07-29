<template>
  <div
    class="vi-pushkin-card"
  >
    <div class="content-box">
      <div class="scroll-box">
        <div class="content">
          <h3>1. Общая информация:</h3>
          <p>
            <b>«Пушкинская карта»</b> — это карта платежной системы «Мир». Открыть Пушкинскую карту можно в специальном
            мобильном приложении «Госуслуги.Культура» или в отделении банка — участника программы. Владелец карты платит
            ею при покупке билета и получает возможность посещать учреждения культуры, участвующие в программе за счет
            средств федерального бюджета. Доходы получателя на баланс карты не повлияют. Чтобы использовать баланс
            текущего года, карту нужно оформить и использовать до 31 декабря.
          </p>

          <p>
            «Пушкинская карта» может быть: виртуальной или пластиковой картой «Мир» — они имеют одинаковую силу. <a
              href="https://пушка.рф/?ysclid=lzi4n3cfqu339988377"
              target="_blank"
            >Более подробная информация</a>
          </p>

          <h3>2. Условия для оформления:</h3>

          <ul>
            <li>Гражданство РФ.</li>
            <li>Возраст от 14 до 22 лет.</li>
            <li>Наличие паспорта.</li>
            <li>Подтвержденная учетная запись на «Едином портале государственных и муниципальных услуг(функций)».</li>
          </ul>
          <a
            href="https://culture.gosuslugi.ru/"
            target="_blank"
            class="button"
          >Приступим?</a>


          <h3>3. Как получить карту:</h3>
          <ul>
            <li>Зарегистрируйтесь на портале ЕПГУ (госуслуги);</li>
            <li>Подтвердите учётную запись;</li>
            <li>Скачайте приложение «Госуслуги.Культура»;</li>
            <li>Подтвердите выпуск Пушкинской карты.</li>
          </ul>


          <h3>4. Что еще нужно знать о «Пушкинской карте»:</h3>
          <ul>
            <li>На нее нельзя положить деньги.</li>
            <li>Получать на карту пособия тоже нельзя.</li>
            <li>Оплатить часть стоимости билета не получится, только все целиком.</li>
            <li>Если исполнилось 14 лет, сначала получите паспорт и учетную запись на госуслугах, потом — карту.</li>
            <li>Особых условий для льготников по этой карте нет.</li>
            <li>Для купленных билетов действуют общие правила возврата.</li>
            <li>Обналичить деньги с этой карты нельзя.</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ViPushkinCard'
};
</script>

<style scoped>

.vi-pushkin-card {
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

.content .button {
  display: table;

  margin-top: 10px;
  padding: 11px 20px;
  border: 0;
  border-radius: 15px;

  font-family: Montserrat, sans-serif;
  font-size: 15px;
  font-weight: 600;
  color: #fff;
  text-decoration: none;

  background: #264ABF;
}

</style>
