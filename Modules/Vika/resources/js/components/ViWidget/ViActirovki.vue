<template>
    <div v-loading="loader" class="vi-actirovki">
        <div class="content-box">
            <div
                v-if="cityInfo===null"
                class="hello-box"
            >
                Выберите населенный пункт
            </div>
            <div
                v-else
                class="scroll-box"
                style="overflow-y: auto"
            >
                <div>
                    <div class="city">
                        <div class="city-name">{{ cityInfo.name }}</div>

                        <div v-if="isMax" class="subscribe-box">

                            <div v-if="subscribeShow" v-loading="loadSubscribe"  class="subscribe-list">

                                <div v-for="item in subscribe" :key="'schoolShiftItem'+item.school_shift" class="schoolShiftItem">
                                    <div class="subscribe-title">Смена: {{item.school_shift}}</div>
                                    <div
                                        v-for="range in item.school_class_range"
                                        :key="'rangeSub'+range.id"
                                        class="subscribe"
                                    >
                                        <el-switch
                                            v-model="range.selected"
                                            style="--el-switch-on-color: #13ce66; --el-switch-off-color: #ff4949"
                                            :active-value="true"
                                            :inactive-value="false"
                                            @change="(val)=>{
                            if(val){
                                setSubscribe(cityInfo.id, range.id, item.school_shift);
                            }else{
                                setUnsubscribe(range.subscription_id);
                            }
                        }"
                                        />
                                        <div>{{range.name}}</div>
                                    </div>
                                </div>

                            </div>
                            <div class="subscribe-button">
                                <el-button
                                    class="filter-button"
                                    type="primary"
                                    @click="!subscribeShow ? getSubscriptions(filter.cityId): ''; subscribeShow=!subscribeShow; "
                                >
                                    {{!subscribeShow ? 'Подписка на уведомления' : 'Сохранить'}}
                                </el-button>
                            </div>
                        </div>
                    </div>
                    <div class="actirovka-box">

                        <div
                            v-for="(item, index) in searchResult" :key="'act'+index"
                            :class="['item-actirovka',item.status]">
                            <div v-if="item.row!==null" class="weather">
                                <div class="weather-box">
                                    <div class="temperature">
                                        <div class="ico"/>
                                        {{ item.row.weather.temperature }}°C
                                    </div>
                                    <div>
                                        <div class="wind">
                                            <div class="ico"/>
                                            {{ item.row.weather.wind }} м/сек
                                        </div>
                                        <div class="date-time">{{ getDateTime(item.row.weather.received_at) }}</div>
                                    </div>

                                </div>
                            </div>
                            <div class="message">{{ item.message }}</div>

                            <div v-if="item.row!==null" class="info">Информация о погоде получена от Ханты-Мансийского
                                ЦГМС - филиал
                                ФГБУ "Обь-Иртышское
                                УГМС"
                            </div>
                        </div>


                    </div>
                    <div v-if="weatherRanges.length>0" class="range-box">
                        <div class="title-range">Правила объявления актировки</div>
                        <div
                            v-for="item in weatherRanges" :key="'range'+item.id"
                            :class="['item-range', isActiveRange(item.id)? 'active' : '']">
                            <div class="value-range school-class">
                                <div :class="['ico', getRange(item.id)]"/>
                                С 1 по {{ item.school_class }}
                            </div>
                            <div class="value-range temperature">
                                <div class="ico"/>
                                {{ item.temperature }} °C
                            </div>
                            <div class="value-range wind">
                                <div class="ico"/>
                                {{ item.wind }} м/сек
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="filter-box">
            <div class="filter">
                <div class="title-filter">
                    Населенный пункт
                </div>
                <div class="filter-input-box">
                    <el-select
                        v-model="filter.cityId"
                        class="filter-select"
                        placeholder="Выберите город"
                        filterable
                        @change="setCity()"
                    >
                        <el-option
                            v-for="item in cityList"
                            :key="'city'+item.id"
                            :label="item.name"
                            :value="item.id"
                        />
                    </el-select>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import moment from 'moment';
import {useAppStore} from '../../store/index.js';

export default {
    name: 'ViActirovki',
    data() {
        return {
            cityList: [],
            loadFilterData: false,
            filter: {
                cityId: null,
            },
            searchResult: null,
            loader: false,
            weatherRanges: [],
            loadWeatherRanges: false,
            cityInfo: null,
            activeRange: [],
            isMax: false,
            access: null,
            event: null,
            subscriptionList: [],
            loadSubscribe: false,
            subscribe: [],
            subscribeShow: false,
        };
    },
    computed: {
        ...mapState(useAppStore, ['linkAPI']),
    },
    created() {
        this.getSubscriptionEventTypes();
        this.getSubscriptionWeatherSchoolClassRanges();
        (
            async () => {
                try {
                    // дождёмся, пока WebApp (bridge) загрузится
                    this.webapp = await this.$_webappReady; // this.$webapp также будет установлен
                    this.isMax = !!(this.$webapp?.isWebApp || this.$webapp?.platform);
                    if (this.isMax) {
                        console.log('Виджет загружен в MAX', this.$webapp);
                        let WA = this.$webapp || this.webapp || window.WebApp;
                        console.log('$webapp', WA);
                        let initData = WA?.initData || null;
                        this.access = this.buildDataCheckString(initData);
                        this.getSubscriptionEventTypes();
                    }
                } catch (err) {
                    this.isMax = false;
                    this.error = 'Не удалось загрузить WebApp bridge';
                    console.error(err);
                }
            }
        )();

        this.startParams();
        this.getCities();
    },
    methods: {
        startParams() {
            if (this.$route.query.city_id) {
                this.filter.cityId = parseInt(this.$route.query.city_id);
            }
            if (this.filter.cityId !== null) {
                this.setCity();
            }
        },
        getCities() {
            this.loadFilterData = true;
            this.$axios.get(this.linkAPI + 'widget/actirovki/cities')
                .then((response) => {
                    console.log('Города: ', response.data);
                    this.cityList = response.data.data;
                })
                .catch((error) => {
                    console.error('Ошибка при получении городов: ', error);
                })
                .finally(() => {
                    this.loadFilterData = false;
                });
        },
        setCity() {
            this.getCity(this.filter.cityId);
            this.getWeatherRanges(this.filter.cityId);
            this.getActirovkiToday(this.filter.cityId);
            if(this.isMax && this.subscribeShow){
                this.getSubscriptions(this.filter.cityId);
            }
        },
        getWeatherRanges(id) {
            this.loadWeatherRanges = true;
            this.$axios.get(this.linkAPI + 'widget/actirovki/cities/' + id + '/weather-ranges')
                .then((response) => {
                    console.log('Правила', response);
                    this.weatherRanges = response.data.data;
                })
                .catch((error) => {
                    console.error('Ошибка при получении правил: ', error);
                })
                .finally(() => {
                    this.loadWeatherRanges = false;
                });
        },
        getCity(id) {
            this.loader = true;
            this.$axios.get(this.linkAPI + 'widget/actirovki/cities/' + id)
                .then((response) => {
                    console.log('Город: ', response.data);
                    this.cityInfo = response.data.data;
                })
                .catch((error) => {
                    console.error('Ошибка при получении города: ', error);
                })
                .finally(() => {
                    this.loader = false;
                });
        },
        getActirovkiToday(id) {
            this.$axios.get(this.linkAPI + 'widget/actirovki/cities/' + id + '/actirovki/today')
                .then((response) => {
                    console.log('Актировки: ', response.data);
                    this.searchResult = response.data.data;
                    this.activeRange = [];
                    this.searchResult.forEach((item) => {
                        if (item.row !== null) {
                            this.activeRange.push({weather_range_id:item.row.weather_range_id, school_shift: item.school_shift});
                        }
                    });
                })
                .catch((error) => {
                    console.error('Ошибка при получении актировок: ', error);
                });
        },
        getDateTime(date_time) {
            if (date_time) {
                return moment(date_time).format('DD.MM.YYYY HH:mm');
            } else {
                return '—';
            }

        },
        isActiveRange(id) {
            if(this.activeRange.find(item => item.weather_range_id === id)!==undefined){
                return true;
            }else{
                return false;
            }
        },
        getRange(id){
            let range = this.activeRange.filter(item => item.weather_range_id === id);
            if(range.length === 1){
                return 'active'+range[0].school_shift;
            }else{
                return '';
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
        getSubscriptionEventTypes() {
            this.loader = true;
            this.$axios.get(this.linkAPI + 'max/get_subscription_event_types')
                .then((response) => {
                    this.loader = false;
                    console.log('События для подписки: ', response.data);
                    this.event = response.data.find(item => item.code === 'actirovki').id;
                })
                .catch((error) => {
                    this.loader = false;
                    console.error('Ошибка при получении списка события для подписки: ', error);
                });
        },
        getSubscriptionWeatherSchoolClassRanges() {
            this.loader = true;
            this.$axios.get(this.linkAPI + 'max/get_subscription_weather_school_class_ranges')
                .then((response) => {
                    this.loader = false;
                    console.log('Периоды актировок: ', response.data);
                    let temp = [];
                    for (let i = 1; i <= 2; i++) {
                        temp.push({
                            school_shift: i,
                            school_class_range: response.data.map(item => {
                                return {...item, selected: false};
                            }),
                        });
                    }
                    this.subscribe = temp;
                })
                .catch((error) => {
                    this.loader = false;
                    console.error('Ошибка при получении списка события для подписки: ', error);
                });
        },
        getSubscriptions(cityId) {
            this.loader = true;
            let params = {
                web_app_data: this.access.web_app_data,
                hash: this.access.hash,
                event_type_id: this.event,
                city_id: cityId,
            };
            this.$axios.post(this.linkAPI + 'max/get_subscriptions', params)
                .then((response) => {
                    console.log('Активные подписки', response.data);
                    this.subscriptionList = response.data;
                    this.subscribe.forEach((itemShift) => {
                        itemShift.school_class_range.forEach((itemRange)=>{
                            delete itemRange.subscription_id;
                            itemRange.selected = false;
                            let found = this.subscriptionList.find(sub=>{
                                return sub.weather_subscription.school_shift === itemShift.school_shift
                                    && sub.weather_subscription.school_class_range_id === itemRange.id;
                            });
                            if(found!==undefined){
                                itemRange.selected = true;
                                itemRange.subscription_id = found.id;
                            }
                        });
                    });
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loader = false;
                });
        },
        setSubscribe(cityId, schoolClassRangeId, schoolShift) {
            this.loadSubscribe = true;
            let params = {
                web_app_data: this.access.web_app_data,
                hash: this.access.hash,
                event_type_id: this.event,
                city_id: cityId,
                school_class_range_id: schoolClassRangeId,
                school_shift: schoolShift
            };
            this.$axios.post(this.linkAPI + 'max/subscribe', params)
                .then((response) => {
                    console.log('Ответ на подписку', response.data);
                    if (response.data.success) {
                        this.getSubscriptions(this.cityInfo.id);
                    } else {
                        ElMessage.error(response.data.message);
                        this.getSubscriptions(this.cityInfo.id);
                    }
                })
                .catch((error) => {
                    console.log(error);
                    this.getSubscriptions(this.cityInfo.id);
                })
                .finally(() => {
                    this.loadSubscribe = false;
                });
        },
        setUnsubscribe(id) {
            this.loadSubscribe = true;
            let params = {
                web_app_data: this.access.web_app_data,
                hash: this.access.hash,
                subscription_id: id
            };
            this.$axios.post(this.linkAPI + 'max/unsubscribe', params)
                .then((response) => {
                    console.log('Ответ на отписку', response.data);
                    if (response.data.success) {
                        this.getSubscriptions(this.cityInfo.id);
                    }
                })
                .catch((error) => {
                    console.log(error);
                    this.getSubscriptions(this.cityInfo.id);
                })
                .finally(() => {
                    this.loadSubscribe = false;
                });
        }
    }
};
</script>

<style scoped>

.city-name-subscribe {
    font-size: 20px;
    font-weight: 500;
    text-align: center;
    margin-bottom: 20px;
}



.schoolShiftItem:last-child {
    margin-bottom: 0;
}

.subscribe-title {
    text-align: center;
    font-weight: 600;
    margin-bottom: 15px;
}


.vi-actirovki {
    display: grid;
    grid-template-rows: calc(100% - 175px) 175px;
    font-family: 'Montserrat', sans-serif;
}

.hello-box {
    padding: 0 25px;

    font-family: Montserrat, sans-serif;
    font-size: 15px;
    font-weight: 500;
    line-height: 160%;
    color: #000;
    text-align: center;
}

.content-box {
    position: relative;
    height: 100%;
}

.filter-box {
    z-index: 10;
    display: flex;
    align-items: flex-start;
    justify-content: center;
}

.filter {
    position: absolute;
    z-index: 99;
    bottom: 22px;
    box-sizing: border-box;
    width: calc(100% - 50px);
    padding: 28px;
    border-radius: 30px;
    background: #f2f4fb;
}

.title-filter {
    margin-bottom: 17px;
    font-family: Montserrat, sans-serif;
    font-size: 17px;
    font-weight: 600;
}

.filter-input-box {
    position: relative;
}

.value-range .ico {
    width: 22px;
    height: 22px;
    mask-position: center;
    mask-repeat: no-repeat;
    mask-size: 22px;
    background-color: var(--el-text-color-regular);
}

.value-range.school-class .ico {
    mask-image: url("../../../assets/icons/Users.svg");
}

.value-range.school-class .ico.active1 {
    mask-image: url("../../../assets/icons/one.svg") !important;
    mask-size: 22px !important;;
}

.value-range.school-class .ico.active2 {
    mask-image: url("../../../assets/icons/two.svg") !important;
    mask-size: 18px !important;;
}

.value-range.temperature .ico {
    mask-image: url("../../../assets/icons/thermometer.svg");
}

.value-range.wind .ico {
    mask-image: url("../../../assets/icons/wind.svg");
}

.range-box {
    background: #f2f4fb;
    margin: 25px;
    padding: 15px;
    border-radius: 25px;
}

.title-range {
    font-size: 18px;
    margin-bottom: 20px;
    font-weight: 500;
}

.item-range {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 18px;
    margin-top: 5px;
}

.item-range.active {
    background: var(--el-color-error-light-7);
    border-radius: 16px;
    padding: 5px 10px;
    margin-left: -10px;
    width: calc(100% + 20px);
}

.value-range {
    display: flex;
    align-items: center;
    gap: 5px;
    flex-wrap: nowrap;
}

.city {
    background: #f2f4fb;
    padding: 15px 40px;
}

.city-name {
    text-align: center;
    font-weight: 600;
    font-size: 21px;
    line-height: 160%;
}

.item-actirovka {
    background: #f2f4fb;
    margin: 25px;
    padding: 25px;
    border-radius: 25px;
}

.item-actirovka.not_announced {
    background: var(--el-color-success-light-9);
}

.item-actirovka.announced {
    background: var(--el-color-error-light-9);
}

.weather-box {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
}

.weather-box .temperature {
    display: flex;
    align-items: center;
    flex-wrap: nowrap;
    gap: 10px;
    font-size: 45px;
}

.weather-box .wind {
    display: flex;
    align-items: center;
    flex-wrap: nowrap;
    gap: 4px;
    font-size: 16px;
    margin-bottom: 5px;
}

.weather-box .temperature .ico {
    width: 36px;
    height: 43px;
    mask-position: center;
    mask-repeat: no-repeat;
    mask-size: 43px;
    background-color: var(--el-text-color-regular);
    mask-image: url("../../../assets/icons/thermometer.svg");
}

.weather-box .wind .ico {
    width: 16px;
    height: 16px;
    mask-position: center;
    mask-repeat: no-repeat;
    mask-size: 16px;
    background-color: var(--el-text-color-regular);
    mask-image: url("../../../assets/icons/wind.svg");
}

.item-actirovka .message {
    font-size: 18px;
    line-height: 140%;
}

.item-actirovka .info {
    margin-top: 20px;
    font-size: 14px;
    color: var(--el-text-color-regular);
}

.item-actirovka .date-time {
    font-size: 12px;
}

.subscribe-button {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 20px;
}

.subscribe-list {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 25px;
}

.subscribe {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-top: 10px;
}

.sub-title {
    font-size: 14px;
}

.filter-button {
    box-sizing: content-box;
    padding: 9px 20px;
    border: 0;
    border-radius: 15px !important;

    font-family: Montserrat, sans-serif;
    font-size: 16px;
    font-weight: 600;
    white-space: normal;

    background: #264abf;
    box-shadow: 0 10px 30px rgb(168 179 214 / 70%);
}

.filter-button.is-disabled {
    border-color: #1e3685;
    opacity: .5;
    background: #1e3685;
}

.filter-button.is-disabled:hover {
    border-color: #1e3685;
    opacity: .5;
    background: #1e3685;
}

</style>

<style>
.el-dialog.question-box {
    display: grid;
    grid-template-rows: auto 1fr;
    max-height: calc(100dvh - 40px);
    border-radius: 15px
}

.el-dialog.question-box .el-dialog__body {
    display: contents;

    font-family: Montserrat, sans-serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 135%;
    color: #000;
}

.el-dialog.question-box .el-dialog__title {
    font-family: Montserrat, sans-serif;
    font-size: 18px;
    font-weight: 500;
    line-height: 140%;
    color: #000;
}

.el-dialog.question-box ul, .el-dialog.question-box ol {
    padding-left: 0;
}

.el-dialog.question-box ul li, .el-dialog.question-box ol li {
    position: relative;

    display: inline-block;

    margin-bottom: 5px;
    padding-left: 15px;

    list-style: none;
}

.el-dialog.question-box li::before {
    content: '';

    position: absolute;
    top: 7px;
    left: 0;

    width: 7px;
    height: 7px;
    border-radius: 100%;

    background: #264ABF;
}
</style>
