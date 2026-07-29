<template>
    <div v-loading="loader" class="vi-region-head-hotline">
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
                    <div v-if="findError!==null" class="text">{{ findError }}</div>
                </div>

            </div>

            <div v-if="step===1" class="step">
                <div class="step-content">
                    <div class="step-list">
                        <el-form
                            ref="form-complaints"
                            :model="record"
                            label-width="auto"
                            label-position="top"
                            size="large"
                            :rules="rules"
                            style="width: 100%"
                            status-icon
                        >
                            <el-form-item
                                label="ФИО"
                                prop="fio"
                            >
                                <el-input
                                    v-model="record.fio"
                                    placeholder="ФИО"
                                    clearable
                                    style="width: 100%"
                                />
                            </el-form-item>

                            <el-form-item
                                label="Адрес проживания"
                                prop="address"
                            >
                                <el-select
                                    v-model="record.address"
                                    style="width: 100%"
                                    filterable
                                    remote
                                    reserve-keyword
                                    cleareble
                                    :value-on-clear="null"
                                    placeholder="Введите адрес"
                                    :remote-method="searchAddress"
                                    :loading="address.loader"
                                    class="address-select"
                                >
                                    <el-option
                                        v-for="item in address.list"
                                        :key="item.unrestricted_value"
                                        :label="item.unrestricted_value"
                                        :value="item.unrestricted_value"
                                    />
                                </el-select>
                            </el-form-item>

                            <el-form-item
                                label="Email"
                                prop="email"
                            >
                                <el-input
                                    v-model="record.email"
                                    placeholder="Email"
                                    clearable
                                    style="width: 100%"
                                />
                            </el-form-item>

                            <el-form-item
                                label="Текст обращения"
                                prop="complaint"
                            >
                                <el-input
                                    v-model="record.complaint"
                                    maxlength="1000"
                                    show-word-limit
                                    :autosize="{ minRows: 5, maxRows: 10 }"
                                    type="textarea"
                                    style="width: 100%"
                                    placeholder="Текст обращения"
                                />
                            </el-form-item>

                            <div class="help-box">
                                В одном сообщении Вы можете описать только одну проблему. Это поможет нам быстрее и точнее разобраться с вашим обращением.
                            </div>

                        </el-form>

                    </div>
                </div>
            </div>

            <div class="button-box">
                <el-button
                    v-if="step!==null && step>0"
                    type="primary"
                    class="btn button-blue"
                    @click="setAppeal()"
                >
                    Отправить
                </el-button>
            </div>
        </div>
    </div>
</template>

<script>
import {useAppStore} from '../../store/index.js';

export default {
    name: 'ViRegionHeadHotline',
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
            step: null,
            record: {
                phone: null,
                fio: null,
                address: null,
                email: null,
                complaint: null,
            },
            rules: {
                'fio': [{
                    required: true,
                    message: 'Укажите ФИО',
                    trigger: 'blur',
                }],
                'address': [{
                    required: true,
                    message: 'Укажите адрес',
                    trigger: 'blur',
                }],
                'email': [
                    {
                        required: true,
                        message: 'Укажите email',
                        trigger: 'blur',
                    },
                    {
                        type: 'email',
                        message: 'Введите корректный email',
                        trigger: ['blur', 'change']
                    }],
                'complaint': [{
                    required: true,
                    message: 'Укажите текст обращение',
                    trigger: 'blur',
                }],
            },
            address: {
                loader: false,
                list: [],
            },
            idempotencyKey: null,
        };
    },
    computed: {
        ...mapState(useAppStore, ['linkAPI', 'dadata_api_key']),
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
            this.idempotencyKey = crypto.randomUUID();
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
            this.$axios.post(this.linkAPI + 'widget/region_head_hotline/is_user_saved_contact', params)
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
            this.$axios.post(this.linkAPI + 'widget/region_head_hotline/save_max_contact', params, {
                headers: {
                    'Idempotency-Key': this.idempotencyKey
                }
            })
                .then((response) => {
                    this.loader = false;
                    console.log('Сохранение номера телефона', response.data);
                    if (!response.data.success) {
                        this.findPeopleByMax(this.access);
                        this.idempotencyKey = crypto.randomUUID();
                    } else {
                        this.isUserSavedContact(this.access.web_app_data, this.access.hash);
                        this.idempotencyKey = crypto.randomUUID();
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
            this.$axios.post(this.linkAPI + 'widget/region_head_hotline/find_people_by_max', params)
                .then((response) => {
                    this.loader = false;
                    console.log('Поиск контакта', response.data);
                    this.findError = null;
                    if (response.data.success) {
                        this.record.phone = response.data.phone;
                        this.step = 1;
                    } else {
                        this.step = 0;
                        this.findError = response.data.error;
                        //ElMessage.error(response.data.error);
                    }
                })
                .catch((error) => {
                    this.loader = false;
                    console.log(error);
                });

        },
        createAppeal() {
            this.loader = true;
            let params = {
                web_app_data: this.access.web_app_data,
                hash: this.access.hash,
                appeal: this.record,
            };
            this.$axios.post(this.linkAPI + 'widget/region_head_hotline/create_appeal', params,
                {
                    headers: {
                        'Idempotency-Key': this.idempotencyKey
                    }
                })
                .then((response) => {
                    console.log('Ответ на отправку ', response.data);
                    this.loader = false;
                    if (response.data.success) {
                        ElMessage({
                            message: 'Обращение успешно отправлено',
                            type: 'success'
                        });

                        this.record.complaint = null;
                        this.idempotencyKey = crypto.randomUUID();

                    } else {
                        this.error = response.data.error;
                        ElMessage.error(response.data.error);
                    }
                })
                .catch((error) => {
                    this.loader = false;
                    console.log(error);

                    // === Обработка отсутствия интернета ===
                    if (!navigator.onLine || error.code === 'ERR_NETWORK') {
                        ElMessage.error('Нет подключения к интернету. Проверьте сеть и попробуйте снова.');
                        return;
                    }

                    // Прочие ошибки (например, 500, 404 и т.д.)
                    ElMessage.error('Произошла ошибка при отправке. Попробуйте позже.');

                });
        },
        searchAddress(query) {
            if (query !== '') {
                let params = {
                    query: query,
                    count: 5,
                    language: 'ru',
                    restrict_value: true,
                    /*                    locations: {
                                            region_fias_id: "d66e5325-3a25-4d29-ba86-4ca351d9704b",
                                            kladr_id: "8600000000000",
                                        },
                                        locations_boost: {
                                            region: "Ханты-Мансийский Автономный округ - Югра",
                                            region_fias_id: "d66e5325-3a25-4d29-ba86-4ca351d9704b",
                                            region_iso_code: "RU-KHM",
                                            region_kladr_id: "8600000000000",
                                            region_type: "АО",
                                            region_type_full: "автономный округ",
                                            region_with_type: "Ханты-Мансийский Автономный округ - Югра",
                                            timezone: "UTC+5",
                                        }*/
                };

                this.$axios.post('https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address', params, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Token ' + this.dadata_api_key,
                    }
                })
                    .then(response => {
                        console.log('Поиск адреса в DADATA', response);
                        this.address.list = response.data.suggestions;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } else {
                this.address.list = [];
            }
        },
        setAppeal() {
            this.$refs['form-complaints'].validate((valid) => {
                if (valid) {
                    this.createAppeal();
                } else {
                    return false;
                }
            });
        }
    }
};
</script>


<style lang="scss">
.address-select {
    .el-select__selection {
        position: relative;
        display: block;
        height: fit-content !important;
    }

    .el-select__wrapper {
        height: fit-content !important;
    }

    .el-select__placeholder {
        white-space: pre-wrap;
        position: initial !important;
        transform: initial !important;
        margin-top: -25px;
    }
}

.vi-region-head-hotline {

    .el-form {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;

        * {
            font-family: 'Montserrat', sans-serif !important;
            font-weight: 500 !important;
        }
    }


    .el-form-item__label {
        font-weight: 500 !important;
        font-size: 15px !important;
    }

    .el-form-item {
        margin-bottom: 0 !important;
        width: 100% !important;
    }

    .el-input__wrapper {
        background: #f0f2f5 !important;
        box-shadow: initial !important;
        border-radius: 10px !important;
        font-weight: 600 !important;
        height: 46px;
        padding: 13px 20px;
        font-family: 'Montserrat', sans-serif;
        width: 100% !important;
    }

    .el-select__wrapper {
        background: #f0f2f5 !important;
        box-shadow: initial !important;
        border-radius: 10px !important;
        font-weight: 600 !important;
        height: 46px;
        padding: 13px 20px;
        width: 100% !important;
    }

    .el-select__input {
        color: #000;
        border-radius: 10px !important;
        width: 100% !important;
    }

    .el-select-dropdown__item {
        white-space: initial !important;
        line-height: initial !important;
        height: initial !important;
        padding: 10px 32px 10px 20px !important;
        border-radius: 10px !important;
        width: 100% !important;
    }

    .el-textarea {
        .el-textarea__inner {
            box-shadow: initial;
            font-weight: 600 !important;
            padding: 10px 16px;
            background: #f0f2f5;
            border-radius: 10px !important;
            height: 100px !important;
            min-height: 100px !important;
            width: 100% !important;
        }
    }

    .el-textarea .el-input__count {
        background: transparent !important;
        color: #a8abb2 !important;
    }
}
</style>


<style scoped lang="scss">

.help-box {
    font-size: 13px;
    color: #616161;
    margin-bottom: 10px;
}
.text {
    line-height: 140%;
    color: #000;
    font-weight: 500;
    font-size: 16px;
}

.step-box {
    width: 100%;
    height: 100%;
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

.item-form {
    width: 100%;

    .title-form {
        margin-bottom: 8px;
        font-family: Montserrat, sans-serif;
        font-size: 13px;
        font-weight: 400;
        color: #272727;
        text-shadow: 0.1px 0.1px 0.1px rgb(0 0 0 / 30%);
        letter-spacing: 0.2px;
    }
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
    gap: 10px;
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


.vi-region-head-hotline {
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
        padding-inline-start: 20px;
        font-size: 15px;

        li {
            margin-bottom: 8px;
        }
    }
}
</style>

