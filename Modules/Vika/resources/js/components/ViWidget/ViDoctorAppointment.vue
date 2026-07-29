<template>
    <div v-loading="loader" class="vi-doctor-appointment">
        <div v-if="!isMax" class="messanger-max">
            <div class="text">
                Виджет работает только в мессенджере <a href="https://max.ru/ugra_vika_bot" target="_blank">Max</a>
            </div>

            <a href="https://max.ru/ugra_vika_bot" target="_blank">
                <div class="max-logo"></div>
            </a>
        </div>
        <div v-else class="step-box">
            <div v-if="phone===null" class="step-content">
                <div class="text">
                    Для работы виджета необходимо поделиться контактом.

                    <div class="button-box">
                        <el-checkbox
                            v-model="personalDataRequested"
                            label="Даю согласие на обработку персональных данных" size="large"
                            class="step-checkbox"/>
                        <el-button
                            class="btn button-blue"
                            style="width: 100%"
                            type="primary"
                            :disabled="!personalDataRequested"
                            @click="askPhone()"
                        >
                            Поделиться контактом
                        </el-button>
                    </div>
                </div>
            </div>

            <div v-if="step===0" class="step">
                <div class="step-content">
                    <div class="step-title">Выберите пациента</div>
                    <div class="step-list">
                        <div
                            v-for="item in patients" :key="'user'+item.guid" class="step-item"
                            @click="record.patient=item; step=1">
                            <div class="step-name">{{ item.last_name !== null ? item.last_name : '' }}
                                {{ item.first_name !== null ? item.first_name : '' }}
                                {{ item.middle_name !== null ? item.middle_name : '' }}
                            </div>
                            <div class="birthday">Дата рождения: <b>{{
                                    item.birth_date !== null ? item.birth_date : ''
                                }}</b></div>
                        </div>
                    </div>
                    <div v-if="findError!==null" class="text">{{ findError }}</div>
                </div>

            </div>

            <div v-if="step===1" class="step">
                <div class="header-box">
                    <div class="header-item">
                        <div class="header-name">{{ record.patient.last_name !== null ? record.patient.last_name : '' }}
                            {{ record.patient.first_name !== null ? record.patient.first_name : '' }}
                            {{ record.patient.middle_name !== null ? record.patient.middle_name : '' }}
                        </div>
                        <div class="header-name-2">Дата рождения:
                            <b>{{ record.patient.birth_date !== null ? record.patient.birth_date : '' }}</b></div>
                    </div>
                </div>
                <div class="step-content">
                    <div class="step-list">
                        <div class="step-item">
                            <el-button
                                type="primary"
                                class="btn button-blue"
                                @click="getMedOrganisations();"
                            >
                                Записаться на прием
                            </el-button>
                        </div>
                        <div class="step-item">
                            <el-button
                                type="primary"
                                class="btn button-yellow"
                                @click="getBookingList();"
                            >
                                Активные талоны
                            </el-button>
                        </div>
                    </div>
                </div>
                <div class="info-box">
                    <div class="title-info-box">Внимание</div>
                    <ul>
                        <li>👶 <b>Детские врачи</b> — только до 18 лет</li>
                        <li>🚫 <b>Гинеколог</b> — только для женщин</li>
                        <li>🔁 <b>Ограничение дублей</b> — один талон на специальность</li>
                    </ul>
                </div>


            </div>

            <div v-if="step===2" class="step">
                <div class="header-box">
                    <div class="header-item">
                        <div class="header-name">{{ record.patient.last_name !== null ? record.patient.last_name : '' }}
                            {{ record.patient.first_name !== null ? record.patient.first_name : '' }}
                            {{ record.patient.middle_name !== null ? record.patient.middle_name : '' }}
                        </div>
                        <div class="header-name-2">Дата рождения:
                            <b>{{ record.patient.birth_date !== null ? record.patient.birth_date : '' }}</b></div>
                    </div>
                </div>

                <div class="step-content">
                    <div class="step-title">Выберите медицинскую <br>организацию</div>
                    <div v-if="medOrganisations.length!==0" class="step-list">
                        <div class="step-item">
                            <el-input
                                v-model="searchMedOrganisations"
                                placeholder="Поиск медицинской организации"
                                clearable
                                class="filter-input"
                                @clear="searchMedOrganisations = ''"
                            />
                        </div>
                        <div
                            v-for="item in filterMedOrganisation(medOrganisations,searchMedOrganisations)"
                            :key="'med-org'+item.id" class="step-item"
                            @click="record.medOrganisation = item; getDoctorSpecialities();">
                            <div class="step-name">{{ item.name }}</div>
                            <div class="step-name-2">{{ item.address }}</div>
                        </div>
                    </div>
                    <div v-else class="text">
                        У выбранного пациента нет доступных для записи медицинских организаций
                    </div>
                </div>
            </div>

            <div v-if="step===3" class="step">

                <div class="header-box">
                    <div class="header-item">
                        <div class="header-name">{{ record.patient.last_name !== null ? record.patient.last_name : '' }}
                            {{ record.patient.first_name !== null ? record.patient.first_name : '' }}
                            {{ record.patient.middle_name !== null ? record.patient.middle_name : '' }}
                        </div>
                        <div class="header-name-2">Дата рождения:
                            <b>{{ record.patient.birth_date !== null ? record.patient.birth_date : '' }}</b></div>
                    </div>

                    <div v-if="patientInfoShow" class="patient-info-box">
                        <div class="header-item">
                            <div class="header-name">{{ record.medOrganisation.name }}</div>
                            <div class="header-name-2">{{ record.medOrganisation.address }}</div>
                        </div>
                    </div>

                    <div class="show-more" @click="patientInfoShow = !patientInfoShow">
                        <div>{{ !patientInfoShow ? 'Показать детали записи' : 'Скрыть детали записи' }}</div>
                    </div>
                </div>

                <div class="step-content">
                    <div class="step-title">Выберите <br>специальность врача</div>
                    <div v-if="doctorSpecialities.length!==0" class="step-list">
                        <div
                            v-for="item in doctorSpecialities" :key="'doc-spec'+item.post_id"
                            class="step-item"
                            @click="record.doctorSpeciality = item; getDoctorsWithFreeSlots();">
                            <div class="step-name">{{ item.post_name }}</div>
                        </div>
                    </div>
                    <div v-else class="text">
                        В выбранной медицинской организации нет доступных для записи специальностей врачей
                    </div>
                </div>

            </div>

            <div v-if="step===4" class="step">

                <div class="header-box">
                    <div class="header-item">
                        <div class="header-name">{{ record.patient.last_name !== null ? record.patient.last_name : '' }}
                            {{ record.patient.first_name !== null ? record.patient.first_name : '' }}
                            {{ record.patient.middle_name !== null ? record.patient.middle_name : '' }}
                        </div>
                        <div class="header-name-2">Дата рождения:
                            <b>{{ record.patient.birth_date !== null ? record.patient.birth_date : '' }}</b></div>
                    </div>

                    <div v-if="patientInfoShow" class="patient-info-box">
                        <div class="header-item">
                            <div class="header-name">{{ record.medOrganisation.name }}</div>
                            <div class="header-name-2">{{ record.medOrganisation.address }}</div>
                        </div>

                        <div class="header-item">
                            <div class="header-name-2">Специальность врача</div>
                            <div class="header-name">{{ record.doctorSpeciality.post_name }}</div>
                        </div>
                    </div>

                    <div class="show-more" @click="patientInfoShow = !patientInfoShow">
                        <div>{{ !patientInfoShow ? 'Показать детали записи' : 'Скрыть детали записи' }}</div>
                    </div>
                </div>

                <div class="step-content">
                    <div class="step-title">Выберите врача</div>
                    <div v-if="doctors.length!==0" class="step-list">
                        <div
                            v-for="item in doctors" :key="'doctor'+item.id" class="step-item"
                            @click="record.doctor = item; getDoctorFreeSlots();">
                            <div class="step-name">{{ item.last_name !== null ? item.last_name : '' }}
                                {{ item.first_name !== null ? item.first_name : '' }}
                                {{ item.middle_name !== null ? item.middle_name : '' }}
                            </div>
                            <div class="step-name-2">
                                Количество талонов:
                                <div class="talon-count">{{ item.free_slots_count }}</div>
                            </div>
                        </div>
                    </div>
                    <div v-else class="text">
                        В выбранной медицинской организации нет доступных для записи врачей по выбранной специальности
                    </div>
                </div>

            </div>

            <div v-if="step===5" class="step">
                <div class="header-box">
                    <div class="header-item">
                        <div class="header-name">{{ record.patient.last_name !== null ? record.patient.last_name : '' }}
                            {{ record.patient.first_name !== null ? record.patient.first_name : '' }}
                            {{ record.patient.middle_name !== null ? record.patient.middle_name : '' }}
                        </div>
                        <div class="header-name-2">Дата рождения:
                            <b>{{ record.patient.birth_date !== null ? record.patient.birth_date : '' }}</b></div>
                    </div>

                    <div v-if="patientInfoShow" class="patient-info-box">
                        <div class="header-item">
                            <div class="header-name">{{ record.medOrganisation.name }}</div>
                            <div class="header-name-2">{{ record.medOrganisation.address }}</div>
                        </div>

                        <div class="header-item">
                            <div class="header-name-2">Специальность врача</div>
                            <div class="header-name">{{ record.doctorSpeciality.post_name }}</div>
                        </div>

                        <div class="header-item">
                            <div class="header-name-2">Врач</div>
                            <div class="header-name">{{
                                    record.doctor.last_name !== null ? record.doctor.last_name : ''
                                }}
                                {{ record.doctor.first_name !== null ? record.doctor.first_name : '' }}
                                {{ record.doctor.middle_name !== null ? record.doctor.middle_name : '' }}
                            </div>
                        </div>
                    </div>

                    <div class="show-more" @click="patientInfoShow = !patientInfoShow">
                        <div>{{ !patientInfoShow ? 'Показать детали записи' : 'Скрыть детали записи' }}</div>
                    </div>
                </div>

                <div class="step-content">
                    <div class="step-title">Выберите время записи</div>
                    <div v-if="free_slots.length!==0" class="step-list">
                        <div v-for="item in free_slots" :key="'free-slot-date'+item.date" class="step-item">
                            <div class="date">{{ item.date }}</div>
                            <div class="time-slots">
                                <div
                                    v-for="itemTime in item.slots" :key="'slot-time'+itemTime.id" class="time"
                                    @click="record.slot = itemTime; step=6;">{{ itemTime.time }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else class="text">
                        У выбранного врача нет доступных для записи слотов
                    </div>
                </div>

            </div>

            <div v-if="step===6" class="step">
                <div class="step-content">
                    <div class="step-title">Проверьте данные</div>

                    <div class="step-list">
                        <div class="step-item">
                            <div class="step-name">{{
                                    record.patient.last_name !== null ? record.patient.last_name : ''
                                }}
                                {{ record.patient.first_name !== null ? record.patient.first_name : '' }}
                                {{ record.patient.middle_name !== null ? record.patient.middle_name : '' }}
                            </div>
                            <div class="step-name-2">Дата рождения:
                                <b>{{ record.patient.birth_date !== null ? record.patient.birth_date : '' }}</b></div>
                        </div>

                        <div class="step-item">
                            <div class="step-name">{{ record.medOrganisation.name }}</div>
                            <div class="step-name-2">{{ record.medOrganisation.address }}</div>
                        </div>

                        <div class="step-item">
                            <div class="step-name-2">Врач</div>
                            <div class="step-name">
                                {{ record.doctor.last_name !== null ? record.doctor.last_name : '' }}
                                {{ record.doctor.first_name !== null ? record.doctor.first_name : '' }}
                                {{ record.doctor.middle_name !== null ? record.doctor.middle_name : '' }}
                            </div>
                            <div class="step-name-2">{{ record.doctorSpeciality.post_name }}</div>
                        </div>

                        <div class="step-item">
                            <div class="step-name-2">Дата и время</div>
                            <div class="step-name">{{ record.slot.date }} {{ record.slot.time }}</div>
                        </div>
                        <div class="step-item">
                            <el-button
                                type="primary"
                                :loading="loadBook"
                                class="btn button-blue"
                                @click="setBook()"
                            >
                                Записаться на прием
                            </el-button>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="step===7" class="step">
                <div class="step-content">
                    <div class="step-title">Ваш талон</div>

                    <div class="step-list">
                        <div class="step-item">
                            <div class="step-name">{{
                                    record.patient.last_name !== null ? record.patient.last_name : ''
                                }}
                                {{ record.patient.first_name !== null ? record.patient.first_name : '' }}
                                {{ record.patient.middle_name !== null ? record.patient.middle_name : '' }}
                            </div>
                            <div class="step-name-2">Дата рождения:
                                <b>{{ record.patient.birth_date !== null ? record.patient.birth_date : '' }}</b></div>
                        </div>

                        <div class="step-item">
                            <div class="step-name">{{ record.medOrganisation.name }}</div>
                            <div class="step-name-2">{{ record.medOrganisation.address }}</div>
                        </div>

                        <div class="step-item">
                            <div class="step-name-2">Врач</div>
                            <div class="step-name">
                                {{ record.doctor.last_name !== null ? record.doctor.last_name : '' }}
                                {{ record.doctor.first_name !== null ? record.doctor.first_name : '' }}
                                {{ record.doctor.middle_name !== null ? record.doctor.middle_name : '' }}
                            </div>
                            <div class="step-name-2">{{ record.doctorSpeciality.post_name }}</div>
                        </div>

                        <div class="step-item">
                            <div class="step-name-2">Дата и время</div>
                            <div class="step-name">{{ record.slot.date }} {{ record.slot.time }}</div>
                        </div>
                        <div class="step-item">
                            <el-button
                                class="btn button-red"
                                style="width: 100%"
                                :loading="loadBook"
                                type="primary"
                                @click="cancelBooking()"
                            >
                                Отменить запись
                            </el-button>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="step===8" class="step">
                <div class="header-box">
                    <div class="header-item">
                        <div class="header-name">{{ record.patient.last_name !== null ? record.patient.last_name : '' }}
                            {{ record.patient.first_name !== null ? record.patient.first_name : '' }}
                            {{ record.patient.middle_name !== null ? record.patient.middle_name : '' }}
                        </div>
                        <div class="header-name-2">Дата рождения:
                            <b>{{ record.patient.birth_date !== null ? record.patient.birth_date : '' }}</b></div>
                    </div>
                </div>

                <div class="step-content">
                    <div class="step-title">Выберите интересующий <br>талон</div>
                    <div v-if="bookingList.length!==0" class="step-list">
                        <div
                            v-for="item in bookingList" :key="'book'+item.id" class="step-item"
                            @click="book = item; getDataForCancelBooking();">
                            <div class="step-name">{{ item.post_name }}</div>
                            <div class="step-name-2">{{ item.visit_time }}</div>
                        </div>
                    </div>
                    <div v-else class="text">
                        У выбранного пациента нет активных талонов
                    </div>
                </div>
            </div>

            <div v-if="step===9" class="step">
                <div class="step-content">
                    <div class="step-title">Ваш талон</div>

                    <div class="step-list">
                        <div class="step-item">
                            <div class="step-name">{{
                                    record.patient.last_name !== null ? record.patient.last_name : ''
                                }}
                                {{ record.patient.first_name !== null ? record.patient.first_name : '' }}
                                {{ record.patient.middle_name !== null ? record.patient.middle_name : '' }}
                            </div>
                            <div class="step-name-2">Дата рождения:
                                <b>{{ record.patient.birth_date !== null ? record.patient.birth_date : '' }}</b></div>
                        </div>

                        <div class="step-item">
                            <div class="step-name">{{ book.mo_name }}</div>
                            <div class="step-name-2">{{ book.address }}</div>
                        </div>

                        <div class="step-item">
                            <div class="step-name-2">Врач</div>
                            <div class="step-name">
                                {{ book.doctor_last_name !== null ? book.doctor_last_name : '' }}
                                {{ book.doctor_first_name !== null ? book.doctor_first_name : '' }}
                                {{ book.doctor_middle_name !== null ? book.doctor_middle_name : '' }}
                            </div>
                            <div class="step-name-2">{{ book.post_name }}</div>
                        </div>

                        <div class="step-item">
                            <div class="step-name-2">Дата и время</div>
                            <div class="step-name">{{ book.visit_time }}</div>
                        </div>
                        <div class="step-item">
                            <el-button
                                class="btn button-red"
                                style="width: 100%"
                                :loading="loadBook"
                                type="primary"
                                @click="cancelBooking({
                                'web_app_data': access.web_app_data,
                                'hash': access.hash,
                                'patient_id': book.patient_id,
                                'depart_oid': book.depart_oid,
                                'slot_id': book.slot_id,
                                'mo_oid': book.mo_oid,
                                'book_ext_id': book.book_ext_id,
                                 })"
                            >
                                Отменить запись
                            </el-button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="button-box">
                <el-button
                    v-if="step!==null && step!==7 && step>0 && step<=9"
                    type="primary"
                    class="btn button-grey"
                    @click="step===9 ? getBookingList() : step===8 ? step=1 : step=step-1"
                >
                    Назад
                </el-button>

                <el-button
                    v-if="step===7"
                    type="primary"
                    class="btn button-grey"
                    @click="clearRecord()"
                >
                    Вернуться к началу
                </el-button>
            </div>
        </div>
    </div>
</template>

<script>
import {useAppStore} from '../../store/index.js';

export default {
    name: 'ViDoctorAppointment',
    data() {
        return {
            personalDataRequested: false,
            loader: false,
            snils: null,
            phone: null,
            error: null,
            onPhoneEvent: null,
            isMax: false,
            access: null,
            patients: [],
            step: null,
            record: {
                patient: null,
                medOrganisation: null,
                doctorSpeciality: null,
                doctor: null,
                slot: null,
                book_ext_id: null,
            },
            medOrganisations: [],
            doctorSpecialities: [],
            doctors: [],
            free_slots: [],
            loadBook: false,
            patientInfoShow: false,
            findError: null,
            bookingList: [],
            book: null,
            searchMedOrganisations: '',
        };
    },
    computed: {
        ...mapState(useAppStore, ['linkAPI']),
    },
    created() {
        (
            async () => {
                try {
                    // дождёмся, пока WebApp (bridge) загрузится
                    this.webapp = await this.$_webappReady; // this.$webapp также будет установлен
                    this.isMax = !!(this.$webapp?.isWebApp || this.$webapp?.platform);
                    if (this.isMax) {
                        console.log('Виджет загружен в MAX', this.$webapp);
                        this.startParams();
                    }
                } catch (err) {
                    this.isMax = false;
                    this.error = 'Не удалось загрузить WebApp bridge';
                    console.error(err);
                }
            }
        )();
    },
    beforeUnmount() {
        // удалить обработчик чтобы не было утечек
        const WA = this.$webapp || this.webapp || window.WebApp;
        if (WA && this.onPhoneEvent) {
            WA.offEvent?.('WebAppRequestPhone', this.onPhoneEvent);
            this.onPhoneEvent = null;
        }
    },
    methods: {
        startParams() {
            if (this.$route.query.snils) {
                this.snils = this.$route.query.snils;
            }
            let WA = this.$webapp || this.webapp || window.WebApp;
            console.log('$webapp', WA);
            let initData = WA?.initData || null;
            this.access = this.buildDataCheckString(initData);
            this.isUserSavedContact(this.access.web_app_data, this.access.hash);
        },
        async askPhone() {
            this.error = null;

            if (!this.webapp && !this.$webapp) {
                this.error = 'WebApp недоступен';
                return;
            }

            const WA = this.$webapp || this.webapp || window.WebApp;

            // очистка старого обработчика (на случай повторных запросов)
            if (this.onPhoneEvent) {
                WA.offEvent?.('WebAppRequestPhone', this.onPhoneEvent);
                this.onPhoneEvent = null;
            }

            // подпишемся на событие, в котором нативный клиент вернёт телефон
            this.onPhoneEvent = (eventData) => {
                // eventData.phone — строка с телефоном согласно документации
                this.phone = eventData?.phone || null;
                console.log('Получен телефон из события', this.phone, eventData);
                if (this.phone !== null) {
                    this.saveMaxContact(this.phone);
                }
            };
            WA.onEvent?.('WebAppRequestPhone', this.onPhoneEvent);

            try {
                // вызов нативного диалога — платформа покажет UI и вернёт телефон через событие/промис
                // метод существует в WebApp API: requestContact()
                const maybeResult = WA.requestContact?.();
                // Иногда нативный клиент может вернуть результат через разрешение промиса — обработим это:
                if (maybeResult && typeof maybeResult.then === 'function') {
                    // если промис резолвится с данными
                    try {
                        const res = await maybeResult;
                        if (res && res.phone) {
                            this.phone = res.phone;
                            console.log('Получен телефон из промиса', this.phone, res);
                            if (this.phone !== null) {
                                this.saveMaxContact(this.phone);
                            }
                        }
                    } catch (e) {
                        // промис мог отклониться (пользователь отказал)
                        console.warn('requestContact rejected', e);
                    }
                }

                // если промис не возвращал телефон, телефон придёт в onEvent('WebAppRequestPhone', ...)
            } catch (err) {
                console.error('Ошибка при запросе контакта', err);
                this.error = 'Ошибка запроса телефона';
            }
        },
        buildDataCheckString(initDataStr) {
            const parts = String(initDataStr || '').split('&').filter(Boolean);
            const kv = [];
            let receivedHash = null;
            for (const part of parts) {
                const eq = part.indexOf('=');
                const keyEnc = eq === -1 ? part : part.slice(0, eq);
                const valEnc = eq === -1 ? '' : part.slice(eq + 1);
                const key = decodeURIComponent(keyEnc);
                const value = decodeURIComponent(valEnc);
                if (key === 'hash') {
                    receivedHash = value;
                    continue;
                }
                kv.push([key, value]);
            }
            // сортировка по ключам
            kv.sort((a, b) => (a[0] < b[0] ? -1 : a[0] > b[0] ? 1 : 0));
            console.log(kv);
            // склейка "key=value" через \n
            const dataCheckString = kv.map(([k, v]) => `${k}=${v}`).join('\n');
            return {'web_app_data': dataCheckString, 'hash': receivedHash};
        },
        isUserSavedContact(web_app_data, hash) {
            this.loader = true;
            let params = {
                web_app_data: web_app_data,
                hash: hash
            };
            this.$axios.post(this.linkAPI + 'widget/appointment_to_doctor/is_user_saved_contact', params)
                .then((response) => {
                    console.log('Контакт из Макс', response.data);
                    this.loader = false;
                    if (response.data.has_contact) {
                        this.phone = true;
                        this.findPeopleByMax(this.access);
                    }
                })
                .catch((error) => {
                    console.log(error);
                    this.loader = false;
                });
        },
        saveMaxContact(phone) {
            this.loader = true;
            let params = {
                web_app_data: this.access.web_app_data,
                hash: this.access.hash,
                phone: phone,
            };
            this.$axios.post(this.linkAPI + 'widget/appointment_to_doctor/save_max_contact', params)
                .then((response) => {
                    this.loader = false;
                    console.log('Сохранение номера телефона', response.data);
                    if (!response.data.success) {
                        this.findPeopleByMax(this.access);
                    } else {
                        this.isUserSavedContact(this.access.web_app_data, this.access.hash);
                    }
                })
                .catch((error) => {
                    this.loader = false;
                    console.log(error);
                });
        },
        findPeopleByMax() {
            this.loader = true;
            let params = {
                web_app_data: this.access.web_app_data,
                hash: this.access.hash,
            };
            this.$axios.post(this.linkAPI + 'widget/appointment_to_doctor/find_people_by_max', params)
                .then((response) => {
                    console.log('Поиск пациентов для записи', response.data);
                    this.findError = null;
                    if (response.data.success) {
                        this.patients = response.data.patients;
                        if (this.patients.length === 1) {
                            this.record.patient = this.patients[0];
                            this.step = 1;
                        } else {
                            this.step = 0;
                        }
                    } else {
                        this.step = 0;
                        this.findError = response.data.error;
                        //ElMessage.error(response.data.error);
                    }
                    this.loader = false;
                })
                .catch((error) => {
                    this.loader = false;
                    console.log(error);
                });

        },
        getMedOrganisations() {
            this.loader = true;
            let params = {
                web_app_data: this.access.web_app_data,
                hash: this.access.hash,
                patient_id: this.record.patient.guid,
            };
            this.$axios.post(this.linkAPI + 'widget/appointment_to_doctor/get_med_organisations', params)
                .then((response) => {
                    console.log('Медицинские организации', response.data);
                    if (response.data.success) {
                        this.medOrganisations = response.data.med_organisations;
                        this.step = 2;
                    } else {
                        ElMessage.error(response.data.error);
                    }
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loader = false;
                });
        },
        getDoctorSpecialities() {
            this.loader = true;
            let params = {
                web_app_data: this.access.web_app_data,
                hash: this.access.hash,
                patient_id: this.record.patient.guid,
                med_organisation_guid: this.record.medOrganisation.id,
            };
            this.$axios.post(this.linkAPI + 'widget/appointment_to_doctor/get_doctor_specialities', params)
                .then((response) => {
                    console.log('Специальности врачей', response.data);
                    if (response.data.success) {
                        this.doctorSpecialities = response.data.doctor_specialities;
                        this.step = 3;
                    } else {
                        ElMessage.error(response.data.error);
                    }
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loader = false;
                });
        },
        getDoctorsWithFreeSlots() {
            this.loader = true;
            let params = {
                web_app_data: this.access.web_app_data,
                hash: this.access.hash,
                post_id: this.record.doctorSpeciality.post_id,
                med_organisation_guid: this.record.medOrganisation.id,
            };
            this.$axios.post(this.linkAPI + 'widget/appointment_to_doctor/get_doctors_with_free_slots', params)
                .then((response) => {
                    console.log('Список врачей', response.data);
                    if (response.data.success) {
                        this.doctors = response.data.doctors;
                        this.step = 4;
                    } else {
                        ElMessage.error(response.data.error);
                    }
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loader = false;
                });
        },
        getDoctorFreeSlots() {
            this.loader = true;
            let params = {
                web_app_data: this.access.web_app_data,
                hash: this.access.hash,
                post_id: this.record.doctorSpeciality.post_id,
                med_organisation_guid: this.record.medOrganisation.id,
                doctor_id: this.record.doctor.id,
            };
            this.$axios.post(this.linkAPI + 'widget/appointment_to_doctor/get_doctor_free_slots', params)
                .then((response) => {
                    console.log('Список слотов', response.data);
                    if (response.data.success) {
                        this.free_slots = response.data.free_slots;
                        this.step = 5;
                    } else {
                        ElMessage.error(response.data.error);
                    }
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loader = false;
                });
        },
        setBook() {
            this.loadBook = true;
            let params = {
                web_app_data: this.access.web_app_data,
                hash: this.access.hash,
                patient_id: this.record.patient.guid,
                depart_oid: this.record.medOrganisation.branch_oid,
                slot_id: this.record.slot.id,
                mo_oid: this.record.medOrganisation.parent_id,
            };
            this.$axios.post(this.linkAPI + 'widget/appointment_to_doctor/book', params)
                .then((response) => {
                    console.log('Запись на прием', response.data);
                    if (response.data.success) {
                        this.record.book_ext_id = response.data.book_ext_id;
                        this.step = 7;
                    } else {
                        ElMessage.error(response.data.error);
                    }
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loadBook = false;
                });
        },
        cancelBooking(init) {
            ElMessageBox.confirm(
                'Вы действительно хотите отменить запись на прием?',
                'Внимание',
                {
                    confirmButtonText: 'Да',
                    cancelButtonText: 'Нет',
                    type: 'warning',
                }
            )
                .then(() => {
                    this.loadBook = true;
                    let params = null;
                    if (init !== undefined) {
                        params = init;
                    } else {
                        params = {
                            web_app_data: this.access.web_app_data,
                            hash: this.access.hash,
                            patient_id: this.record.patient.guid,
                            depart_oid: this.record.medOrganisation.branch_oid,
                            slot_id: this.record.slot.id,
                            mo_oid: this.record.medOrganisation.parent_id,
                            book_ext_id: this.record.book_ext_id,
                        };
                    }
                    this.$axios.post(this.linkAPI + 'widget/appointment_to_doctor/cancel_booking', params)
                        .then((response) => {
                            console.log('Отмена записи на прием', response.data);
                            if (response.data.success) {
                                ElMessage({
                                    message: 'Запись успешно отменена',
                                    type: 'success',
                                });
                                if (this.book !== 0) {
                                    this.loader = true;
                                    setTimeout(() => {
                                        this.loader = false;
                                        this.getBookingList();
                                    }, 5000);
                                } else {
                                    this.clearRecord();
                                }

                            } else {
                                ElMessage.error(response.data.error);
                            }
                        })
                        .catch((error) => {
                            console.log(error);
                        })
                        .finally(() => {
                            this.loadBook = false;
                        });
                })
                .catch(() => {

                });
        },
        clearRecord() {
            this.step = 0;
            this.record = {
                patient: null,
                medOrganisation: null,
                doctorSpeciality: null,
                doctor: null,
                slot: null,
                book_ext_id: null,
            };
            this.medOrganisations = [];
            this.doctorSpecialities = [];
            this.doctors = [];
            this.free_slots = [];
        },
        getBookingList() {
            this.loader = true;
            let params = {
                web_app_data: this.access.web_app_data,
                hash: this.access.hash,
                patient_id: this.record.patient.guid,
            };
            this.$axios.post(this.linkAPI + 'widget/appointment_to_doctor/get_booking_list', params)
                .then((response) => {
                    console.log('Активные записи', response.data);
                    if (response.data.success) {
                        this.bookingList = response.data.booking_list;
                        this.step = 8;
                        this.book = null;
                    } else {
                        ElMessage.error(response.data.error);
                    }
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loader = false;
                });
        },
        getDataForCancelBooking() {
            this.loader = true;
            let params = {
                web_app_data: this.access.web_app_data,
                hash: this.access.hash,
                patient_id: this.record.patient.guid,
                slot_id: this.book.slot_id,
                resource_id: this.book.resource_id,
            };
            this.$axios.post(this.linkAPI + 'widget/appointment_to_doctor/get_data_for_cancel_booking', params)
                .then((response) => {
                    console.log('Доп информация для отмены записи', response.data);
                    if (response.data.success) {
                        this.book = {...this.book, ...response.data.slot};
                        this.step = 9;
                    } else {
                        ElMessage.error(response.data.error);
                    }
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loader = false;
                });
        },
        filterMedOrganisation(items, query) {
            if (!query) return items;
            const q = query.trim().toLowerCase();
            return items.filter(item => {
                const name = (item.name || '').toLowerCase();
                const address = (item.address || '').toLowerCase();
                return name.includes(q) || address.includes(q);
            });
        }
    },
};
</script>

<style scoped lang="scss">
.text {
    line-height: 140%;
    color: #000;
    font-weight: 500;
    font-size: 16px;
}

.messanger-max {
    display: flex;
    flex-wrap: wrap;
    width: 100%;
    height: 100%;
    background: #fff;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    text-align: center;
    gap: 18px;
    font-size: 19px;
    font-weight: 600;
    font-family: Montserrat, sans-serif;
    padding: 50px;
}

.step-box{
    width: 100%;
    height: 100%;
}

.messanger-max {
    .text {
        width: 100%;

        a {
            color: #264ABF;
            text-decoration: none;
        }
    }

    .max-logo {
        width: 60px;
        height: 60px;
        display: table;
        background: url('../../../assets/img/max-logo.svg') no-repeat center;
        background-size: 60px;
    }
}

.step {
    font-family: Montserrat, sans-serif;
    height: max-content;
}

.step-checkbox {
    margin-right: 0;
    margin-bottom: 28px;
    height: initial;
}

.step-checkbox .el-checkbox__inner {
    height: 30px;
    width: 30px;
    background: #F2F4FB;
    border: 0 !important;
    margin-right: 11px;
}

.el-checkbox__input.is-checked .el-checkbox__inner {
    background: #264abf;
}


.header-box {
    padding: 25px 35px;
    background: #F3F7FA;
    margin-bottom: 22px;
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

.header-box .header-item {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    padding-bottom: 15px;
    width: 100%;
}

.header-box .header-item:last-child {
    padding-bottom: 0;
}

.header-box .header-item .header-name {
    font-size: 16px;
}

.header-box .header-item .header-name-2 {
    font-size: 15px;
    font-weight: 500;
}


.step-list {
    display: flex;
    gap: 22px;
    flex-wrap: wrap;
    width: 100%;
}

.step-item {
    padding-bottom: 22px;
    border-bottom: 1px solid #E6E6E6;
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    width: 100%;
    cursor: pointer;
}

.step-item:last-child {
    border-bottom: 0;
}

.step-title {
    font-size: 18px;
    font-weight: 600;
    padding-bottom: 22px;
    margin-bottom: 22px;
    line-height: 130%;
    color: #A2A7BD;
    border-bottom: 1px solid #E6E6E6;
}

.step-content {
    padding: 0 35px;
    font-family: Montserrat, sans-serif;
    height: max-content;
}

.step-name {
    font-size: 17px;
    line-height: 120%;
    font-weight: 600;
    text-transform: capitalize;
    width: 100%;
}

.step-name-2 {
    font-size: 15px;
    color: #5D616D;
    line-height: 120%;
    font-weight: 500;
    width: 100%;
    display: flex;
    flex-wrap: wrap;
}

.header-name {
    font-size: 17px;
    line-height: 120%;
    font-weight: 600;
    text-transform: capitalize;
    width: 100%;
}

.header-name-2 {
    font-size: 15px;
    color: #5D616D;
    line-height: 120%;
    font-weight: 500;
    width: 100%;
}

.birthday {
    font-size: 16px;
    font-weight: 600;
    color: #5D616D;
}

.birthday b {
    color: #000;
    font-weight: 600;
}


.patient-info-box {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

.show-more {
    font-size: 15px;
    color: #264ABF;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 10px;
}

.show-more::before {
    content: '';
    display: table;
    width: 22px;
    height: 7px;
    background: url('../../../assets/img/show-more.svg') no-repeat center;
    background-size: 22px;
}

.step-item .date {
    font-size: 16px;
    font-weight: 600;
    color: #000;
    margin-bottom: 10px;
}

.time-slots {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 19px;
    justify-content: space-evenly;
    width: 100%;
}

.time-slots .time {
    padding: 17px 20px;
    background: #F3F7FA;
    border-radius: 10px;
    text-align: center;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
}

.talon-count {
    font-size: 15px;
    color: #359C41;
    font-weight: 500;
    display: flex;
    gap: 8px;
    margin-left: 8px;
}

.talon-count::before {
    content: '';
    display: table;
    width: 20px;
    height: 20px;
    background: url('../../../assets/img/talon-ico.svg') no-repeat center;
    background-size: 20px;
}


.message-box {
    padding: 20px;
    border-radius: 10px;
    background: #f2f4fb;
    width: fit-content;
    font-family: Montserrat, sans-serif;
    font-size: 16px;
    font-weight: 500;
    line-height: 24px;
    color: #282828;
    text-align: center;
}

.button-phone {
    box-sizing: content-box;
    padding: 9px 0;
    border: 0;
    border-radius: 15px !important;

    font-family: Montserrat, sans-serif;
    font-size: 16px;
    font-weight: 600;
    white-space: normal;

    background: #264abf;
    box-shadow: 0 10px 30px rgb(168 179 214 / 70%);
}

.button-phone.is-disabled {
    border-color: #1e3685;
    opacity: .5;
    background: #1e3685;
}

.button-phone.is-disabled:hover {
    border-color: #1e3685;
    opacity: .5;
    background: #1e3685;
}


.vi-doctor-appointment {
    min-height: calc(100% - 100px);
    height: calc(100% - 100px);
    overflow-y: auto;
}


.doctors-item .slots {
    font-size: 16px;
    font-weight: 600;
    color: #727A86;
}

.free-slots-list .free-slots-item {
    width: 100%;
}

.free-slots-list .free-slots-item .date {
    font-size: 16px;
    font-weight: 600;
    color: #727a86;
    margin-bottom: 11px;
}

.free-slots-list .free-slots-item .time-slots {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
}

.free-slots-list .free-slots-item .time-slots .time {
    padding: 15px;
    background: #fff;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 600;
    text-align: center;
}

.button-box {
    margin: 0 auto;
    left: 0;
    right: 0;
    bottom: 40px;
    position: absolute;
    width: calc(100% - 70px);
}

.btn {
    box-sizing: content-box;
    padding: 9px 0;
    border: 0;
    font-family: Montserrat, sans-serif;
    font-size: 16px;
    font-weight: 600;
    white-space: normal;
    background: #F2F4FB;
    width: 100%;
    border-radius: 15px;
    color: #818697;
}

.btn.button-grey {
    background: #F2F4FB;
    color: #818697;
}

.btn.button-blue {
    background: #264abf;
    color: #fff;
}

.btn.button-yellow {
    background: #49d3d9;
    color: #fff;
}

.btn.button-blue:disabled {
    opacity: 0.5;
}

.btn.button-red {
    background: #D44242;
    color: #fff;
}

.info-box {
    background: #f3f7fa;
    padding: 25px 35px 15px 35px;
    margin-bottom: 22px;
    .title-info-box {
        font-weight: 600;
    }
    ul {
        padding-inline-start: 0;
        font-size: 15px;
        list-style: none;
        li {
            margin-bottom: 8px;
        }
    }
}
</style>
