<template>
  <div
    class="vi-archive-ugra"
  >
    <div class="content-box">
      <div class="scroll-box">
        <div class="content">
          <div class="city-list">
            <div class="city-box">
              <!-- 1 -->
              <div
                class="name-box"
                @click="step1.show = !step1.show"
              >
                <h3 class="section_name">
                  1. Подать запрос в архив
                </h3>
                <div :class="['arrow', step1.show === true ? 'active' : '']" />
              </div>

              <div
                v-if="step1.show"
                class="list-slider"
              >
                <!-- 1.1 -->
                <div
                  class="name-box"
                  @click="step1.step1_1.show = !step1.step1_1.show"
                >
                  <h3 class="section_name">
                    Запрос социально-правового характера (социальные гарантии, пенсионное
                    обеспечение, получение льгот и компенсаций)
                  </h3>
                  <div :class="['arrow', step1.step1_1.show === true ? 'active' : '']" />
                </div>

                <div
                  v-if="step1.step1_1.show"
                  class="list-slider"
                >
                  <!-- 1.1.1 -->
                  <div
                    class="name-box"
                    @click="step1.step1_1.step1_1_1.show = !step1.step1_1.step1_1_1.show"
                  >
                    <h3 class="section_name">
                      стаж и/или заработная плата
                    </h3>
                    <div :class="['arrow', step1.step1_1.step1_1_1.show === true ? 'active' : '']" />
                  </div>
                  <div
                    v-if="step1.step1_1.step1_1_1.show"
                    class="list-slider-modal"
                  >
                    <div class="accordion-ul">
                      <ol>
                        <li><b>Лично или почтовым сообщением:</b></li>
                      </ol>
                      <div class="text-ul">
                          ул. Комсомольская, зд. 21, г. Ханты-Мансийск, Ханты-Мансийский автономный округ-Югра,
                          Тюменской обл.,
                        628012
                      </div>

                      <ol>
                        <li><b>По электронной почте:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            Почта Служба по делам архивов Ханты-Мансийского автономного округа – Югры <a
                              target="_blank"
                              href="mailto:archive@admhmao.ru"
                            >archive@admhmao.ru</a>
                          </li>
                          <li>
                            Почта Государственный архив Югры <a
                              target="_blank"
                              href="mailto:archive@gahmao.ru"
                            >archive@gahmao.ru</a>
                          </li>
                        </ul>
                      </div>

                        <ol>
                            <li><b>Посредством <a href="https://www.gosuslugi.ru/600149" target="_blank">портала
                                Госусулуг</a></b></li>
                        </ol>

                        <ol>
                        <li><b>Посредством Платформы обратной связи:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            <span><a
                              target="_blank"
                              href="https://archivesl.admhmao.ru/lk/send"
                            >Служба по делам архивов Ханты-Мансийского автономного округа – Югры</a></span>
                          </li>
                          <li>
                            <span><a
                              target="_blank"
                              href="https://gahmao.ru/obrashchenie-v-arkhiv/"
                            >Государственный архив Югры</a></span>
                          </li>
                        </ul>
                      </div>

                      <ol>
                        <li><b>Обратиться к специалисту:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            <span>Архивная служба Югры — <b><a
                              target="_blank"
                              href="tel:83467360159"
                            >8(3467) 360-159</a></b></span>
                          </li>
                          <li>
                            <span>Почта Государственный архив Югры — <b><a
                              target="_blank"
                              href="tel:83467322747"
                            >8(3467) 32-27-47</a></b></span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <!-- 1.1.2 -->
                  <div
                    class="name-box"
                    @click="step1.step1_1.step1_1_2.show = !step1.step1_1.step1_1_2.show"
                  >
                    <h3 class="section_name">
                      награждение
                    </h3>
                    <div :class="['arrow', step1.step1_1.step1_1_2.show === true ? 'active' : '']" />
                  </div>
                  <div
                    v-if="step1.step1_1.step1_1_2.show"
                    class="list-slider-modal"
                  >
                    <div class="accordion-ul">
                      <ol>
                        <li><b>Лично или почтовым сообщением:</b></li>
                      </ol>
                      <div class="text-ul">
                          ул. Комсомольская, зд. 21, г. Ханты-Мансийск, Ханты-Мансийский автономный округ-Югра,
                          Тюменской обл.,
                        628012
                      </div>

                      <ol>
                        <li><b>По электронной почте:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            Почта Служба по делам архивов Ханты-Мансийского автономного округа – Югры <a
                              target="_blank"
                              href="mailto:archive@admhmao.ru"
                            >archive@admhmao.ru</a>
                          </li>
                          <li>
                            Почта Государственный архив Югры <a
                              target="_blank"
                              href="mailto:archive@gahmao.ru"
                            >archive@gahmao.ru</a>
                          </li>
                        </ul>
                      </div>

                      <ol>
                        <li><b>Посредством Платформы обратной связи:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            <span><a
                              target="_blank"
                              href="https://archivesl.admhmao.ru/lk/send"
                            >Служба по делам архивов Ханты-Мансийского автономного округа – Югры</a></span>
                          </li>
                          <li>
                            <span><a
                              target="_blank"
                              href="https://gahmao.ru/obrashchenie-v-arkhiv/"
                            >Государственный архив Югры</a></span>
                          </li>
                        </ul>
                      </div>

                      <ol>
                        <li><b>Обратиться к специалисту:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            <span>Архивная служба Югры — <b><a
                              target="_blank"
                              href="tel:83467360159"
                            >8(3467) 360-159</a></b></span>
                          </li>
                          <li>
                            <span>Почта Государственный архив Югры — <b><a
                              target="_blank"
                              href="tel:83467322747"
                            >8(3467) 32-27-47</a></b></span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <!-- 1.1.3 -->
                  <div
                    class="name-box"
                    @click="step1.step1_1.step1_1_3.show = !step1.step1_1.step1_1_3.show"
                  >
                    <h3 class="section_name">
                      другое
                    </h3>
                    <div :class="['arrow', step1.step1_1.step1_1_3.show === true ? 'active' : '']" />
                  </div>
                  <div
                    v-if="step1.step1_1.step1_1_3.show"
                    class="list-slider-modal"
                  >
                    <div class="accordion-ul">
                      <ol>
                        <li><b>Лично или почтовым сообщением:</b></li>
                      </ol>
                      <div class="text-ul">
                          ул. Комсомольская, зд. 21, г. Ханты-Мансийск, Ханты-Мансийский автономный округ-Югра,
                          Тюменской обл.,
                        628012
                      </div>

                      <ol>
                        <li><b>По электронной почте:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            Почта Служба по делам архивов Ханты-Мансийского автономного округа – Югры <a
                              target="_blank"
                              href="mailto:archive@admhmao.ru"
                            >archive@admhmao.ru</a>
                          </li>
                          <li>
                            Почта Государственный архив Югры <a
                              target="_blank"
                              href="mailto:archive@gahmao.ru"
                            >archive@gahmao.ru</a>
                          </li>
                        </ul>
                      </div>

                      <ol>
                        <li><b>Посредством Платформы обратной связи:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            <span><a
                              target="_blank"
                              href="https://archivesl.admhmao.ru/lk/send"
                            >Служба по делам архивов Ханты-Мансийского автономного округа – Югры</a></span>
                          </li>
                          <li>
                            <span><a
                              target="_blank"
                              href="https://gahmao.ru/obrashchenie-v-arkhiv/"
                            >Государственный архив Югры</a></span>
                          </li>
                        </ul>
                      </div>

                      <ol>
                        <li><b>Обратиться к специалисту:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            <span>Архивная служба Югры — <b><a
                              target="_blank"
                              href="tel:83467360159"
                            >8(3467) 360-159</a></b></span>
                          </li>
                          <li>
                            <span>Почта Государственный архив Югры — <b><a
                              target="_blank"
                              href="tel:83467322747"
                            >8(3467) 32-27-47</a></b></span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- 1.2 -->
                <div
                  class="name-box"
                  @click="step1.step1_2.show = !step1.step1_2.show"
                >
                  <h3 class="section_name">
                    Тематический запрос (предоставление архивной информации по определенной,
                    теме)
                  </h3>
                  <div :class="['arrow', step1.step1_2.show === true ? 'active' : '']" />
                </div>
                <div
                  v-if="step1.step1_2.show"
                  class="list-slider"
                >
                  <!-- 1.2.1 -->
                  <div
                    class="name-box"
                    @click="step1.step1_2.step1_2_1.show = !step1.step1_2.step1_2_1.show"
                  >
                    <h3 class="section_name">
                      подтверждение права на имущество
                    </h3>
                    <div :class="['arrow', step1.step1_2.step1_2_1.show === true ? 'active' : '']" />
                  </div>
                  <div
                    v-if="step1.step1_2.step1_2_1.show"
                    class="list-slider-modal"
                  >
                    <div class="accordion-ul">
                      <ol>
                        <li><b>Лично или почтовым сообщением:</b></li>
                      </ol>
                      <div class="text-ul">
                          ул. Комсомольская, зд. 21, г. Ханты-Мансийск, Ханты-Мансийский автономный округ-Югра,
                          Тюменской обл.,
                        628012
                      </div>

                      <ol>
                        <li><b>По электронной почте:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            Почта Служба по делам архивов Ханты-Мансийского автономного округа – Югры <a
                              target="_blank"
                              href="mailto:archive@admhmao.ru"
                            >archive@admhmao.ru</a>
                          </li>
                          <li>
                            Почта Государственный архив Югры <a
                              target="_blank"
                              href="mailto:archive@gahmao.ru"
                            >archive@gahmao.ru</a>
                          </li>
                        </ul>
                      </div>

                      <ol>
                        <li><b>Посредством Платформы обратной связи:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            <span><a
                              target="_blank"
                              href="https://archivesl.admhmao.ru/lk/send"
                            >Служба по делам архивов Ханты-Мансийского автономного округа – Югры</a></span>
                          </li>
                          <li>
                            <span><a
                              target="_blank"
                              href="https://gahmao.ru/obrashchenie-v-arkhiv/"
                            >Государственный архив Югры</a></span>
                          </li>
                        </ul>
                      </div>

                      <ol>
                        <li><b>Обратиться к специалисту:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            <span>Архивная служба Югры — <b><a
                              target="_blank"
                              href="tel:83467360159"
                            >8(3467) 360-159</a></b></span>
                          </li>
                          <li>
                            <span>Почта Государственный архив Югры — <b><a
                              target="_blank"
                              href="tel:83467322747"
                            >8(3467) 32-27-47</a></b></span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <!-- 1.2.2 -->
                  <div
                    class="name-box"
                    @click="step1.step1_2.step1_2_2.show = !step1.step1_2.step1_2_2.show"
                  >
                    <h3 class="section_name">
                      подтверждение факта выделения жилой площади/земельного участка
                    </h3>
                    <div :class="['arrow', step1.step1_2.step1_2_2.show === true ? 'active' : '']" />
                  </div>
                  <div
                    v-if="step1.step1_2.step1_2_2.show"
                    class="list-slider-modal"
                  >
                    <div class="accordion-ul">
                      <ol>
                        <li><b>Лично или почтовым сообщением:</b></li>
                      </ol>
                      <div class="text-ul">
                          ул. Комсомольская, зд. 21, г. Ханты-Мансийск, Ханты-Мансийский автономный округ-Югра,
                          Тюменской обл.,
                        628012
                      </div>

                      <ol>
                        <li><b>По электронной почте:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            Почта Служба по делам архивов Ханты-Мансийского автономного округа – Югры <a
                              target="_blank"
                              href="mailto:archive@admhmao.ru"
                            >archive@admhmao.ru</a>
                          </li>
                          <li>
                            Почта Государственный архив Югры <a
                              target="_blank"
                              href="mailto:archive@gahmao.ru"
                            >archive@gahmao.ru</a>
                          </li>
                        </ul>
                      </div>

                      <ol>
                        <li><b>Посредством Платформы обратной связи:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            <span><a
                              target="_blank"
                              href="https://archivesl.admhmao.ru/lk/send"
                            >Служба по делам архивов Ханты-Мансийского автономного округа – Югры</a></span>
                          </li>
                          <li>
                            <span><a
                              target="_blank"
                              href="https://gahmao.ru/obrashchenie-v-arkhiv/"
                            >Государственный архив Югры</a></span>
                          </li>
                        </ul>
                      </div>

                      <ol>
                        <li><b>Обратиться к специалисту:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            <span>Архивная служба Югры — <b><a
                              target="_blank"
                              href="tel:83467360159"
                            >8(3467) 360-159</a></b></span>
                          </li>
                          <li>
                            <span>Почта Государственный архив Югры — <b><a
                              target="_blank"
                              href="tel:83467322747"
                            >8(3467) 32-27-47</a></b></span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <!-- 1.2.3 -->
                  <div
                    class="name-box"
                    @click="step1.step1_2.step1_2_3.show = !step1.step1_2.step1_2_3.show"
                  >
                    <h3 class="section_name">
                      генеалогический запрос
                    </h3>
                    <div :class="['arrow', step1.step1_2.step1_2_3.show === true ? 'active' : '']" />
                  </div>
                  <div
                    v-if="step1.step1_2.step1_2_3.show"
                    class="list-slider-modal"
                  >
                    <div class="accordion-ul">
                      <ol>
                        <li><b>Лично или почтовым сообщением:</b></li>
                      </ol>
                      <div class="text-ul">
                          ул. Комсомольская, зд. 21, г. Ханты-Мансийск, Ханты-Мансийский автономный округ-Югра,
                          Тюменской обл.,
                        628012
                      </div>

                      <ol>
                        <li><b>По электронной почте:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            Почта Служба по делам архивов Ханты-Мансийского автономного округа – Югры <a
                              target="_blank"
                              href="mailto:archive@admhmao.ru"
                            >archive@admhmao.ru</a>
                          </li>
                          <li>
                            Почта Государственный архив Югры <a
                              target="_blank"
                              href="mailto:archive@gahmao.ru"
                            >archive@gahmao.ru</a>
                          </li>
                        </ul>
                      </div>

                      <ol>
                        <li><b>Посредством Платформы обратной связи:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            <span><a
                              target="_blank"
                              href="https://archivesl.admhmao.ru/lk/send"
                            >Служба по делам архивов Ханты-Мансийского автономного округа – Югры</a></span>
                          </li>
                          <li>
                            <span><a
                              target="_blank"
                              href="https://gahmao.ru/obrashchenie-v-arkhiv/"
                            >Государственный архив Югры</a></span>
                          </li>
                        </ul>
                      </div>

                      <ol>
                        <li><b>Обратиться к специалисту:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            <span>Архивная служба Югры — <b><a
                              target="_blank"
                              href="tel:83467360159"
                            >8(3467) 360-159</a></b></span>
                          </li>
                          <li>
                            <span>Почта Государственный архив Югры — <b><a
                              target="_blank"
                              href="tel:83467322747"
                            >8(3467) 32-27-47</a></b></span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <!-- 1.2.4 -->
                  <div
                    class="name-box"
                    @click="step1.step1_2.step1_2_4.show = !step1.step1_2.step1_2_4.show"
                  >
                    <h3 class="section_name">
                      биографический запрос
                    </h3>
                    <div :class="['arrow', step1.step1_2.step1_2_4.show === true ? 'active' : '']" />
                  </div>
                  <div
                    v-if="step1.step1_2.step1_2_4.show"
                    class="list-slider-modal"
                  >
                    <div class="accordion-ul">
                      <ol>
                        <li><b>Лично или почтовым сообщением:</b></li>
                      </ol>
                      <div class="text-ul">
                          ул. Комсомольская, зд. 21, г. Ханты-Мансийск, Ханты-Мансийский автономный округ-Югра,
                          Тюменской обл.,
                        628012
                      </div>

                      <ol>
                        <li><b>По электронной почте:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            Почта Служба по делам архивов Ханты-Мансийского автономного округа – Югры <a
                              target="_blank"
                              href="mailto:archive@admhmao.ru"
                            >archive@admhmao.ru</a>
                          </li>
                          <li>
                            Почта Государственный архив Югры <a
                              target="_blank"
                              href="mailto:archive@gahmao.ru"
                            >archive@gahmao.ru</a>
                          </li>
                        </ul>
                      </div>

                      <ol>
                        <li><b>Посредством Платформы обратной связи:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            <span><a
                              target="_blank"
                              href="https://archivesl.admhmao.ru/lk/send"
                            >Служба по делам архивов Ханты-Мансийского автономного округа – Югры</a></span>
                          </li>
                          <li>
                            <span><a
                              target="_blank"
                              href="https://gahmao.ru/obrashchenie-v-arkhiv/"
                            >Государственный архив Югры</a></span>
                          </li>
                        </ul>
                      </div>

                      <ol>
                        <li><b>Обратиться к специалисту:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            <span>Архивная служба Югры — <b><a
                              target="_blank"
                              href="tel:83467360159"
                            >8(3467) 360-159</a></b></span>
                          </li>
                          <li>
                            <span>Почта Государственный архив Югры — <b><a
                              target="_blank"
                              href="tel:83467322747"
                            >8(3467) 32-27-47</a></b></span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <!-- 1.2.5 -->
                  <div
                    class="name-box"
                    @click="step1.step1_2.step1_2_5.show = !step1.step1_2.step1_2_5.show"
                  >
                    <h3 class="section_name">
                      запрос об участнике ВОВ
                    </h3>
                    <div :class="['arrow', step1.step1_2.step1_2_5.show === true ? 'active' : '']" />
                  </div>
                  <div
                    v-if="step1.step1_2.step1_2_5.show"
                    class="list-slider-modal"
                  >
                    <div class="accordion-ul">
                      <ol>
                        <li><b>Лично или почтовым сообщением:</b></li>
                      </ol>
                      <div class="text-ul">
                          ул. Комсомольская, зд. 21, г. Ханты-Мансийск, Ханты-Мансийский автономный округ-Югра,
                          Тюменской обл.,
                        628012
                      </div>

                      <ol>
                        <li><b>По электронной почте:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            Почта Служба по делам архивов Ханты-Мансийского автономного округа – Югры <a
                              target="_blank"
                              href="mailto:archive@admhmao.ru"
                            >archive@admhmao.ru</a>
                          </li>
                          <li>
                            Почта Государственный архив Югры <a
                              target="_blank"
                              href="mailto:archive@gahmao.ru"
                            >archive@gahmao.ru</a>
                          </li>
                        </ul>
                      </div>

                      <ol>
                        <li><b>Посредством Платформы обратной связи:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            <span><a
                              target="_blank"
                              href="https://archivesl.admhmao.ru/lk/send"
                            >Служба по делам архивов Ханты-Мансийского автономного округа – Югры</a></span>
                          </li>
                          <li>
                            <span><a
                              target="_blank"
                              href="https://gahmao.ru/obrashchenie-v-arkhiv/"
                            >Государственный архив Югры</a></span>
                          </li>
                        </ul>
                      </div>

                      <ol>
                        <li><b>Обратиться к специалисту:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            <span>Архивная служба Югры — <b><a
                              target="_blank"
                              href="tel:83467360159"
                            >8(3467) 360-159</a></b></span>
                          </li>
                          <li>
                            <span>Почта Государственный архив Югры — <b><a
                              target="_blank"
                              href="tel:83467322747"
                            >8(3467) 32-27-47</a></b></span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <!-- 1.2.6 -->
                  <div
                    class="name-box"
                    @click="step1.step1_2.step1_2_6.show = !step1.step1_2.step1_2_6.show"
                  >
                    <h3 class="section_name">
                      запросы об истории организаций (предприятий, учреждений, органов власти и
                      т.п.), населенных пунктов
                    </h3>
                    <div :class="['arrow', step1.step1_2.step1_2_6.show === true ? 'active' : '']" />
                  </div>
                  <div
                    v-if="step1.step1_2.step1_2_6.show"
                    class="list-slider-modal"
                  >
                    <div class="accordion-ul">
                      <ol>
                        <li><b>Лично или почтовым сообщением:</b></li>
                      </ol>
                      <div class="text-ul">
                          ул. Комсомольская, зд. 21, г. Ханты-Мансийск, Ханты-Мансийский автономный округ-Югра,
                          Тюменской обл.,
                        628012
                      </div>

                      <ol>
                        <li><b>По электронной почте:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            Почта Служба по делам архивов Ханты-Мансийского автономного округа – Югры <a
                              target="_blank"
                              href="mailto:archive@admhmao.ru"
                            >archive@admhmao.ru</a>
                          </li>
                          <li>
                            Почта Государственный архив Югры <a
                              target="_blank"
                              href="mailto:archive@gahmao.ru"
                            >archive@gahmao.ru</a>
                          </li>
                        </ul>
                      </div>

                      <ol>
                        <li><b>Посредством Платформы обратной связи:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            <span><a
                              target="_blank"
                              href="https://archivesl.admhmao.ru/lk/send"
                            >Служба по делам архивов Ханты-Мансийского автономного округа – Югры</a></span>
                          </li>
                          <li>
                            <span><a
                              target="_blank"
                              href="https://gahmao.ru/obrashchenie-v-arkhiv/"
                            >Государственный архив Югры</a></span>
                          </li>
                        </ul>
                      </div>

                      <ol>
                        <li><b>Обратиться к специалисту:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            <span>Архивная служба Югры — <b><a
                              target="_blank"
                              href="tel:83467360159"
                            >8(3467) 360-159</a></b></span>
                          </li>
                          <li>
                            <span>Почта Государственный архив Югры — <b><a
                              target="_blank"
                              href="tel:83467322747"
                            >8(3467) 32-27-47</a></b></span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>


                  <!-- 1.2.7 -->
                  <div
                    class="name-box"
                    @click="step1.step1_2.step1_2_7.show = !step1.step1_2.step1_2_7.show"
                  >
                    <h3 class="section_name">
                      административно-территориальные изменения
                    </h3>
                    <div :class="['arrow', step1.step1_2.step1_2_7.show === true ? 'active' : '']" />
                  </div>
                  <div
                    v-if="step1.step1_2.step1_2_7.show"
                    class="list-slider-modal"
                  >
                    <div class="accordion-ul">
                      <ol>
                        <li><b>Лично или почтовым сообщением:</b></li>
                      </ol>
                      <div class="text-ul">
                          ул. Комсомольская, зд. 21, г. Ханты-Мансийск, Ханты-Мансийский автономный округ-Югра,
                          Тюменской обл.,
                        628012
                      </div>

                      <ol>
                        <li><b>По электронной почте:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            Почта Служба по делам архивов Ханты-Мансийского автономного округа – Югры <a
                              target="_blank"
                              href="mailto:archive@admhmao.ru"
                            >archive@admhmao.ru</a>
                          </li>
                          <li>
                            Почта Государственный архив Югры <a
                              target="_blank"
                              href="mailto:archive@gahmao.ru"
                            >archive@gahmao.ru</a>
                          </li>
                        </ul>
                      </div>

                      <ol>
                        <li><b>Посредством Платформы обратной связи:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            <span><a
                              target="_blank"
                              href="https://archivesl.admhmao.ru/lk/send"
                            >Служба по делам архивов Ханты-Мансийского автономного округа – Югры</a></span>
                          </li>
                          <li>
                            <span><a
                              target="_blank"
                              href="https://gahmao.ru/obrashchenie-v-arkhiv/"
                            >Государственный архив Югры</a></span>
                          </li>
                        </ul>
                      </div>

                      <ol>
                        <li><b>Обратиться к специалисту:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            <span>Архивная служба Югры — <b><a
                              target="_blank"
                              href="tel:83467360159"
                            >8(3467) 360-159</a></b></span>
                          </li>
                          <li>
                            <span>Почта Государственный архив Югры — <b><a
                              target="_blank"
                              href="tel:83467322747"
                            >8(3467) 32-27-47</a></b></span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <!-- 1.2.8 -->
                  <div
                    class="name-box"
                    @click="step1.step1_2.step1_2_8.show = !step1.step1_2.step1_2_8.show"
                  >
                    <h3 class="section_name">
                      другое
                    </h3>
                    <div :class="['arrow', step1.step1_2.step1_2_8.show === true ? 'active' : '']" />
                  </div>
                  <div
                    v-if="step1.step1_2.step1_2_8.show"
                    class="list-slider-modal"
                  >
                    <div class="accordion-ul">
                      <ol>
                        <li><b>Лично или почтовым сообщением:</b></li>
                      </ol>
                      <div class="text-ul">
                          ул. Комсомольская, зд. 21, г. Ханты-Мансийск, Ханты-Мансийский автономный округ-Югра,
                          Тюменской обл.,
                        628012
                      </div>

                      <ol>
                        <li><b>По электронной почте:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            Почта Служба по делам архивов Ханты-Мансийского автономного округа – Югры <a
                              target="_blank"
                              href="mailto:archive@admhmao.ru"
                            >archive@admhmao.ru</a>
                          </li>
                          <li>
                            Почта Государственный архив Югры <a
                              target="_blank"
                              href="mailto:archive@gahmao.ru"
                            >archive@gahmao.ru</a>
                          </li>
                        </ul>
                      </div>

                      <ol>
                        <li><b>Посредством Платформы обратной связи:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            <span><a
                              target="_blank"
                              href="https://archivesl.admhmao.ru/lk/send"
                            >Служба по делам архивов Ханты-Мансийского автономного округа – Югры</a></span>
                          </li>
                          <li>
                            <span><a
                              target="_blank"
                              href="https://gahmao.ru/obrashchenie-v-arkhiv/"
                            >Государственный архив Югры</a></span>
                          </li>
                        </ul>
                      </div>

                      <ol>
                        <li><b>Обратиться к специалисту:</b></li>
                      </ol>
                      <div class="text-ul">
                        <ul>
                          <li>
                            <span>Архивная служба Югры — <b><a
                              target="_blank"
                              href="tel:83467360159"
                            >8(3467) 360-159</a></b></span>
                          </li>
                          <li>
                            <span>Почта Государственный архив Югры — <b><a
                              target="_blank"
                              href="tel:83467322747"
                            >8(3467) 32-27-47</a></b></span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <!-- 2 -->
              <div
                class="name-box"
                @click="step2.show = !step2.show"
              >
                <h3 class="section_name">
                  2. Найти информацию самостоятельно
                </h3>
                <div :class="['arrow', step2.show === true ? 'active' : '']" />
              </div>

              <div
                v-if="step2.show"
                class="list-slider"
              >
                <ul>
                  <li>
                    <a
                      target="_blank"
                      href="https://archivesugra.ru/"
                    >в ГИС «Электронный архив Югры»</a>
                  </li>
                  <li>
                    <a
                      target="_blank"
                      href="https://победа86.рф"
                    >на портале «Победа одна на всех»</a>
                  </li>
                  <li>
                    <a
                      target="_blank"
                      href="https://поколения-югры.рф"
                    >на портале «Связь поколений Югры»</a>
                  </li>
                  <li>
                    <a
                      target="_blank"
                      href="https://archivesl.admhmao.ru/dlsguide/"
                    >в БД «Справочник местонахождения
                      документов ликвидированных предприятий»</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ViArchiveUgra',
  data() {
    return {
      step1: {
        show: false,
        step1_1: {
          show: false,
          step1_1_1: {
            show: false,
          },
          step1_1_2: {
            show: false,
          },
          step1_1_3: {
            show: false,
          },
        },
        step1_2: {
          show: false,
          step1_2_1: {
            show: false,
          },
          step1_2_2: {
            show: false,
          },
          step1_2_3: {
            show: false,
          },
          step1_2_4: {
            show: false,
          },
          step1_2_5: {
            show: false,
          },
          step1_2_6: {
            show: false,
          },
          step1_2_7: {
            show: false,
          },
          step1_2_8: {
            show: false,
          },
        },
      },

      step2: {
        show: false,
      },
    };
  },
};
</script>

<style scoped>

.vi-archive-ugra {
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
  display: grid;
  grid-template-columns: 20px 1fr;
  flex-wrap: wrap;
  align-items: center;

  margin-bottom: 5px;
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


.name-box {
  cursor: pointer;

  display: flex;
  gap: 8px;
  align-items: center;

  margin-bottom: 15px;
  padding-bottom: 15px;
  border-bottom: 1px solid #e3e6eb;
}

.section_name {
  margin: 0;
  font-size: 16px;
  font-weight: 600;
}

.arrow {
  cursor: pointer;

  transform: rotate(90deg);

  width: 14px;
  height: 12px;

  opacity: 0.4;
  background: url("../../../assets/img/arrow.svg") center no-repeat;
  background-size: contain;
}

.text-ul {
  margin-bottom: 20px;
  margin-left: 20px;
}

</style>
