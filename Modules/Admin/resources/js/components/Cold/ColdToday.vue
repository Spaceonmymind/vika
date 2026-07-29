<template>
    <div class="cold-today">
<!--        <div v-loading="loadStatistic" class="statistic white-box">
            <div class="title">Статистика за сегодня</div>
            <div v-if="statistic!==null" class="statistic-box">
                <div v-for="item in statistic" :key="'shift'+item.shifts" class="item-shifts">
                    <div class="name">Смена {{ item.shifts }}</div>
                    <div class="line-box">
                        <div
v-for="itemClass in item.class" :key="'shift'+item.shifts+'class'+itemClass.name"
                             class="item-class">С 1 по {{ itemClass.name }}: <span>{{ itemClass.value }}</span></div>
                    </div>
                </div>
            </div>
            <el-button type="primary" link @click="goToDetail()">Посмотреть статистику подробнее</el-button>
        </div>-->
        <div class="weather-box-top">
            <div class="weather white-box">
                <div class="title">Город</div>
                <el-select
                    v-model="weathers.city_id"
                    placeholder="Город"
                    filterable
                    clearable
                    :loading="loadingCity"
                    size="large"
                    @change="setCity(); setParams('city_id',weathers.city_id);">
                    <el-option
                        v-for="item in cityList"
                        :key="'cityList'+item.id"
                        :label="item.name"
                        :value="item.id"
                    >
                    </el-option>
                </el-select>
                <div class="title" style="margin-top: 20px">Погода</div>
                <div v-loading="loadingWeather" class="weather-box">
                    <div class="temperature">
                        <div class="ico"/>
                        {{ cityWeather !== null ? cityWeather.temperature : '—' }}°C
                    </div>
                    <div>
                        <div class="wind">
                            <div class="ico"/>
                            {{ cityWeather !== null ? cityWeather.wind : '—' }} м/сек
                        </div>
                        <div class="date-time">
                            {{
                                cityWeather !== null ? cityWeather.received_at !== null ? getDateTime(cityWeather.received_at) : ' &#9998; ' + getDateTime(cityWeather.created_at) : '—'
                            }}
                        </div>
                    </div>

                </div>
                <div v-loading="loadWeatherRanges" class="title">Объявленные актировки</div>
                <div v-if="actirovkiCity!==null" class="actirovki-box">
                    <div
v-for="(item,index) in actirovkiCity" :key="'act'+index"
                         :class="['item-actirovka', item.status]">
                        {{ item.message }}
                        <el-button
                            v-if="item.row!==null" circle type="danger" title="Отменить актировку"
                            @click="rowsCancel(item.row.id)">
                            <div class="ico ico-delete"></div>
                        </el-button>
                    </div>
                </div>
            </div>
            <div v-loading="loadWeatherRanges" class="range-box white-box">
                <div class="title">Правила объявления актировки</div>
                <div
                    v-for="item in weatherRanges" :key="'range'+item.id"
                    :class="['item-range', isActiveRange(item.id)? 'active' : '' , actirovkaId === item.id ? 'active-border' : '']">
                    <div class="value-range school-class">
                        <div class="ico"/>
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
            <div class="form white-box">
                <div class="title">Добавить погоду</div>
                <el-form
                    ref="city-weather-form"
                    :model="weathers"
                    label-width="auto"
                    label-position="top"
                    size="large"
                    :rules="rules"
                    style="width: 100%"
                    status-icon
                    @keydown.stop.prevent.enter="setWeather()"
                >

                    <el-form-item
                        label="Температура, °C"
                        prop="temperature"
                    >
                        <el-input-number
                            v-model="weathers.temperature"
                            style="width: 100%" :min="-100"
                            :max="100"
                            placeholder="Температура"
                            size="large"
                        />
                    </el-form-item>

                    <el-form-item
                        label="Ветер, м/сек"
                        prop="wind"
                    >
                        <el-input-number
                            v-model="weathers.wind"
                            style="width: 100%" :min="0"
                            :max="100"
                            placeholder="Ветер"
                            size="large"
                        />
                    </el-form-item>

                    <el-form-item style="margin-bottom: 0">
                        <el-button
                            type="primary" :loading="saveLoad" style="width: 100%; margin-top: 10px"
                            @click="setWeather()">Добавить
                        </el-button>
                    </el-form-item>

                </el-form>
            </div>
        </div>
    </div>
</template>
<script>
import moment from 'moment';
import {useAppStore} from '../../store/index.js';

export default {
    name: 'ColdToday',
    data() {
        return {
            cityList: [],
            weathers: {
                city_id: null,
                temperature: null,
                wind: null
            },
            rules: {
                'temperature': [{
                    required: true,
                    message: 'Введите температуру',
                    trigger: 'blur',
                }],
                'wind': [{
                    required: true,
                    message: 'Введите ветер',
                    trigger: 'blur',
                }],
            },
            loadingCity: false,
            loadingWeather: false,
            cityWeather: null,
            actirovkiCity: null,
            activeRange: [],
            loadWeatherRanges: false,
            weatherRanges: [],
            loadStatistic: false,
            statistic: null,
            saveLoad: false,
            actirovkaId: null,

        };
    },
    computed: {
        ...mapState(useAppStore, ['linkAPIActirovki',]),
    },
    watch:{
        weathers:{
            handler(){
                this.calculateActirovka();
            },
            deep: true,
        }
    },
    created() {
        this.initialData();
        this.getCityList().then(() => {
            if (this.weathers.city_id === null) {
                this.weathers.city_id = 71;
            }
            this.setCity();
        });
    },
    methods: {
        async getCityList() {
            try {
                this.loadingCity = true;
                let response = await this.$axios.get(this.linkAPIActirovki + 'widget/actirovki/cities');
                console.log('Города:', response);
                this.cityList = response.data.data.reduce((list, city) => {
                    return {
                        ...list,
                        [city.id]: city,
                    };
                }, {});
            } catch (error) {
                console.log(error);
            } finally {
                this.loadingCity = false;
            }
        },
        setParams(name, value) {
            if (name !== undefined) {
                if (value !== null && value !== '') {
                    this.$router.replace({
                        path: this.$route.path,
                        query: {...this.$route.query, [name]: value}
                    });
                } else {
                    let query = {...this.$route.query};
                    delete query[name];
                    this.$router.replace({
                        path: this.$route.path,
                        query: query
                    });
                }
            }
        },
        initialData() {
            if (this.$route.query.city_id) {
                this.weathers.city_id = parseInt(this.$route.query.city_id);
            }
        },
        rowsCancel(id) {
            ElMessageBox.confirm('Вы уверены, что хотите отменить актировку?', 'Отмена актировки', {
                type: 'warning',
                cancelButtonText: 'Нет',
                confirmButtonText: 'Да',
            }).then(() => {
                this.loadingTable = true;
                this.$axios.post(this.linkAPIActirovki + 'widget/actirovki/rows/' + id + '/cancel')
                    .then((response) => {
                        console.log('Ответ на отмену актировки:', response);
                        ElMessage({
                            type: 'success',
                            message: 'Актировка отменена'
                        });
                        this.setCity();
                    })
                    .catch((error) => {
                        console.log(error);
                    })
                    .finally(() => {
                        this.loadingTable = false;
                    });
            });
        },
        getWeathers() {
            this.loadingWeather = true;
            this.$axios.get(this.linkAPIActirovki + 'widget/actirovki/cities/' + this.weathers.city_id + '/latest-weather')
                .then((response) => {
                    console.log('Погода для города:', response);
                    this.cityWeather = response.data.data;
                    this.weathers.temperature = this.cityWeather !== null ? this.cityWeather.temperature : null;
                    this.weathers.wind = this.cityWeather !== null ? this.cityWeather.wind : null;
                    this.calculateActirovka();
                })
                .catch((error) => {
                    console.log(error);
                    this.cityWeather = null;
                    this.weathers.temperature = null;
                    this.weathers.wind = null;
                })
                .finally(() => {
                    this.loadingWeather = false;
                })
            ;
        },
        getActirovkiToday() {
            this.$axios.get(this.linkAPIActirovki + 'widget/actirovki/cities/' + this.weathers.city_id + '/actirovki/today')
                .then((response) => {
                    console.log('Актировки для города: ', response.data);
                    this.actirovkiCity = response.data.data;
                    this.activeRange = [];
                    this.actirovkiCity.forEach((item) => {
                        if (item.row !== null) {
                            this.activeRange.push(item.row.weather_range_id);
                        }
                    });
                })
                .catch((error) => {
                    console.error('Ошибка при получении актировок: ', error);
                });
        },
        getWeatherRanges() {
            this.loadWeatherRanges = true;
            this.weatherRanges = [];
            this.$axios.get(this.linkAPIActirovki + 'widget/actirovki/cities/' + this.weathers.city_id + '/weather-ranges')
                .then((response) => {
                    console.log('Правила для города', response);
                    this.weatherRanges = response.data.data;
                    this.calculateActirovka();
                })
                .catch((error) => {
                    console.error('Ошибка при получении правил: ', error);
                })
                .finally(() => {
                    this.loadWeatherRanges = false;
                });
        },
        setCity() {
            this.getWeathers();
            this.getActirovkiToday();
            this.getWeatherRanges();
            //this.getAllToday();
        },
        getDateTime(date_time) {
            if (date_time) {
                return moment(date_time).format('DD.MM.YYYY HH:mm');
            } else {
                return '—';
            }
        },
        isActiveRange(id) {
            return this.activeRange.includes(id);
        },
        setWeather() {
            this.$refs['city-weather-form'].validate((valid) => {
                if (valid) {
                    ElMessageBox.confirm('Если введенные данные удовлетворяют условиям объявления актировки, актировка будет объявлена автоматически! <br/> <br/> <b>Вы уверены, что хотите добавить данные о погоде?</b>', 'Данные о погоде', {
                        type: 'warning',
                        cancelButtonText: 'Нет',
                        confirmButtonText: 'Да',
                        dangerouslyUseHTMLString: true,
                        center: true,
                    }).then(() => {
                        this.saveLoad = true;
                        this.$axios.post(this.linkAPIActirovki + 'widget/actirovki/weathers', this.weathers)
                            .then((response) => {
                                console.log('Добавление погоды:', response);
                                ElMessage({
                                    type: 'success',
                                    message: 'Погода добавлена'
                                });
                                this.setCity();
                            })
                            .catch((error) => {
                                console.log(error);
                            })
                            .finally(() => {
                                this.saveLoad = false;
                            });
                    });
                } else {
                    return false;
                }
            });
        },
        goToDetail() {
            this.$router.push({
                name: 'cold-history',
                query: {
                    'date[]': [moment().format('DD.MM.YYYY'), moment().format('DD.MM.YYYY')],
                }
            });
        },
        getAllToday() {
            this.loadStatistic = true;
            this.$axios.get(this.linkAPIActirovki + 'widget/actirovki/statistic/all-today')
                .then((response) => {
                    console.log('Статистика за сегодня: ', response.data);
                    let result = [];
                    let shifts = response.data.data.shifts;
                    for (let shiftKey in shifts) {
                        let shiftClasses = shifts[shiftKey];
                        let classArray = Object.entries(shiftClasses).map(([name, value]) => ({
                            name: Number(name),
                            value: value
                        }));
                        result.push({
                            shifts: Number(shiftKey),
                            class: classArray
                        });
                    }
                    ;
                    this.statistic = result;
                })
                .catch((error) => {
                    console.error('Ошибка при получении статистики: ', error);
                })
                .finally(() => {
                    this.loadStatistic = false;
                })
            ;
        },
        calculateActirovka() {
            if (this.weathers.temperature !== null && this.weathers.wind !== null) {
                if (this.weathers.temperature >= -23) {
                    this.actirovkaId = null;
                } else {
                    this.weatherRanges.forEach((range,index) => {
                        if (range.temperature >= this.weathers.temperature && range.wind <= this.weathers.wind) {
                            this.actirovkaId = range.id;
                        }else if (index===0){
                            this.actirovkaId = null;
                        }
                    });
                }
            } else {
                this.actirovkaId = null;
            }
        },
    }
};
</script>

<style scoped>

.ico {
    width: 22px;
    height: 22px;
    mask-position: center;
    mask-repeat: no-repeat;
    mask-size: 22px;
}

.ico.ico-edit {
    background-color: var(--el-color-white);
    mask-image: url("../../../assets/icons/Pencil.svg");
}

.ico.ico-weather {
    background-color: var(--el-color-white);
    mask-image: url("../../../assets/icons/Cloud-Sun.svg");
}

.ico.ico-delete {
    background-color: var(--el-color-white);
    mask-image: url("../../../assets/icons/Trash 3.svg");
}

.ico.ico-close {
    background-color: var(--el-color-black);
    mask-image: url("../../../assets/icons/Cross.svg");
}

.ico.ico-login {
    background-color: var(--el-color-white);

    mask-image: url("../../../assets/icons/Sign_in.svg");
}

.weather-box-top {
    margin-bottom: 20px;
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.weather {
    min-width: 360px;
    max-width: 400px;
    height: fit-content;
}

.weather .title {
    font-size: 18px;
    font-weight: 500;
    margin-bottom: 20px;
}


.weather-box {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 20px 0;
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

.item-actirovka {
    background: #f2f4fb;
    padding: 10px 20px;
    margin-top: 20px;
    border-radius: 12px;
    display: flex;
    gap: 20px;
    align-items: center;
    justify-content: space-between;
}


.item-actirovka.not_announced {
    background: var(--el-color-success-light-9);
}

.item-actirovka.announced {
    background: var(--el-color-error-light-9);
}

.range-box {
    width: 370px;
    height: fit-content;
}

.range-box .title {
    font-size: 18px;
    margin-bottom: 20px;
    font-weight: 500;
}

.item-range {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 20px;
    margin-top: 5px;
}

.item-range.active {
    background: var(--el-color-error-light-7);
    border-radius: 16px;
    padding: 5px 10px;
    margin-left: -10px;
    width: 100%;
}

.item-range.active-border {
    border: 1px solid var(--el-color-error-light-3);
    border-radius: 16px;
    padding: 5px 10px;
    margin-left: -10px;
    width: 100%;
}


.value-range {
    display: flex;
    align-items: center;
    gap: 5px;
    flex-wrap: nowrap;
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

.value-range.temperature .ico {
    mask-image: url("../../../assets/icons/thermometer.svg");
}

.value-range.wind .ico {
    mask-image: url("../../../assets/icons/wind.svg");
}

.form {
    max-width: 360px;
    min-width: 300px;
    height: fit-content;
}


.form .title {
    font-size: 18px;
    margin-bottom: 20px;
    font-weight: 500;
}

.statistic {
    margin-bottom: 20px;
    width: fit-content;
}

.statistic .title {
    font-size: 18px;
    margin-bottom: 20px;
    font-weight: 500;
}

.statistic-box {
    display: flex;
    margin-bottom: 20px;
    gap: 20px;
    flex-wrap: wrap;
}

.item-shifts {
}

.item-shifts .name {
    margin-bottom: 10px;
    font-weight: 500;
}

.item-shifts .line-box {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 20px;
}

.item-shifts .item-class span {
    font-weight: 500;
}


@media (width <= 1920px) {

}

@media (width <= 1200px) {

}

@media (width <= 992px) {
    .weather {
        max-width: 100%;
    }

    .statistic {
        width: 100%;
    }

    .form {
        width: 100%;
        max-width: 100%;
    }

    .range-box {
        width: 100%;
    }
}

@media (width <= 768px) {
    .weather {
        max-width: 100%;
    }

    .statistic {
        width: 100%;
    }

    .form {
        width: 100%;
        max-width: 100%;
    }

    .range-box {
        width: 100%;
    }
}


</style>
