<template>
    <div class="content-box">
        <div
            v-if="medOrgs===null"
            class="hello-box"
        >
            Чтобы определить медицинский участок,<br>
            укажите город, улицу и номер дома
        </div>
        <div
            v-else
            class="scroll-box"
        >
            <div
                v-if="medOrgs.length===0"
                class="hello-box"
            >
                По вашему запросу ничего не найдено
            </div>
            <div
                v-for="item in (filtersMedOgrs.length ? filtersMedOgrs : medOrgs)"
                :key="item.id"
                class="item-med"
            >
                <div class="plot">
                    <div class="plot-name">{{ item.short_name }}</div>
                    <div class="address">
                        {{ item.address ?? 'Адрес не известен' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="filter-box">
        <div :class="['filter', filterWatch === false ? 'filter-none' : '']">
            <el-button
                v-if="filterWatch === false"
                class="filter-button"
                style="width: 100%"
                type="primary"
                @click="filterWatch = true"
            >
                Изменить
                выбор
            </el-button>

            <div v-if="filterWatch === true">
                <div class="title-filter">
                    Укажите параметры
                </div>

                <div class="item-form">
                    <div class="title-form">
                        Город
                    </div>

                    <el-select
                        v-model.number="filter.city_id"
                        class="filter-select"
                        placeholder="Выберите город"
                        filterable
                        clearable
                        @change="filteredOrganisations"
                    >
                        <el-option
                            v-for="item in cities"
                            :key="'city'+item.id"
                            :label="item.name"
                            :value="item.id"
                        />
                    </el-select>
                </div>

                <div class="item-form">
                    <div class="title-form">
                        Поиск по названию или адресу
                    </div>
                    <el-input
                        v-model.number="filter.search"
                        class="filter-select"
                        placeholder="Введите название организации или адрес"
                        clearable
                        @change="filteredOrganisations()"
                    >
                    </el-input>
                </div>

                <el-button
                    class="filter-button"
                    style="width: 100%"
                    type="primary"
                    @click="filteredOrganisations(); filterWatch = false"
                >
                    Искать
                </el-button>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: 'ViMedOrgSearch',
    data() {
        return {
            loader: false,
            medOrgs: [],
            filtersMedOgrs: [],
            cities: [],
            filterWatch: false,
            filter: {
                city_id: null,
                search: null,
            },
        };
    },

    created() {
        this.getMedOrg();
        this.getCities();
    },

    methods: {
        getMedOrg() {
            this.loader = true;
            this.$axios.get('http://127.0.0.1:5173/Modules/Vika/resources/assets/temp/medorg.json')
                .then((response) => {
                    console.log('Медицинские организации: ', response.data);
                    this.medOrgs = response.data;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loader = false;
                });
        },

        getCities() {
            this.loadFilterData = true;
            this.$axios.get('http://127.0.0.1:5173/Modules/Vika/resources/assets/temp/localities.json')
                .then((response) => {
                    console.log('Список городов: ', response.data);
                    this.cities = response.data;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loadFilterData = false;
                });
        },
        filteredOrganisations() {

            let result = this.medOrgs;

            // 1. Фильтр по городу
            if (this.filter.city_id) {
                result = result.filter(
                    item => item.locality_id === Number(this.filter.city_id)
                );
            }

            // 2. Живой поиск по названию ИЛИ адресу
            if (this.filter.search && this.filter.search.trim() !== '') {
                const search = this.filter.search.toLowerCase();
                result = result.filter(item =>
                    (item.short_name && item.short_name.toLowerCase().includes(search)) ||
                    (item.address && item.address.toLowerCase().includes(search))
                );
            }

            this.filtersMedOgrs = result;
        }
    },
};
</script>

<style scoped>
.vi-med {
    display: grid;
    grid-template-rows: calc(100% - 100px) 100px;
}

.hello-box {
    font-family: Montserrat, sans-serif;
    font-size: 15px;
    font-weight: 500;
    line-height: 160%;
    color: #000;
    text-align: center;
}

.content-box{
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

.filter.filter-none {
    padding: 0;
}


.title-filter {
    margin-bottom: 17px;
    font-family: Montserrat, sans-serif;
    font-size: 17px;
    font-weight: 600;
}

.item-form {
    margin-bottom: 10px;
}

.title-form {
    margin-bottom: 8px;

    font-family: Montserrat, sans-serif;
    font-size: 13px;
    font-weight: 400;
    color: #272727;
    text-shadow: 0.1px 0.1px 0.1px rgb(0 0 0 / 30%);
    letter-spacing: 0.2px;
}

.filter-button {
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


.item-med {
    position: relative;

    padding: 25px;
    border-bottom: 1px solid #d6dae4;

    font-family: Montserrat, sans-serif;
    color: #000;

    transition: 0.3s ease;
}

.item-med:last-child {
    border-bottom: none;
}

.item-med:hover {
    background: #f2f4fb;
}

.item-med.active {
    cursor: initial;
    box-shadow: 0 0 20px rgb(0 0 0 / 30%);
}

.item-med.active:hover {
    background: #fff;
}

.item-med .address {
    display: flex;
    gap: 5px;
    align-items: center;
    justify-content: flex-start;

    margin-top: 8px;

    font-size: 13px;
    font-weight: 500;
    line-height: 160%;
    color: #5D616D;
}

.item-med .address i {
    width: 9px;
    height: 13px;

    background-color: #BCBFCA;

    mask-image: url("../../../assets/img/location.svg");
    mask-position: center;
    mask-repeat: no-repeat;
    mask-size: 9px;
}

.item-med .plot-name {
    margin-bottom: 3px;
    padding-right: 25px;
    font-size: 16px;
    font-weight: 600;
}

.item-med .phone {
    display: flex;
    gap: 5px;
    align-items: center;
    justify-content: flex-start;

    width: max-content;
    margin-top: 15px;

    font-size: 16px;
    font-weight: 500;
    color: #264abf;
    text-decoration: none;
}

.item-med .phone i {
    width: 16px;
    height: 16px;

    background-color: #a2a8bd;

    mask-image: url("../../../assets/img/phone.svg");
    mask-position: center;
    mask-repeat: no-repeat;
    mask-size: 12px;
}


.item-med .link {
    display: table;

    margin-top: 10px;
    padding-bottom: 1px;
    border-bottom: 1px solid rgb(33 106 205 / 30%);

    font-size: 15px;
    font-weight: 500;
    color: #264abf;
    text-decoration: none;
}

.link:hover {
    padding-bottom: 2px;
    border: 0;
}

.item-med .med-org-box {
    margin-top: 15px;
}

.item-med .med-org-name {
    display: table;

    width: 100%;
    margin-bottom: 13px;
    padding-bottom: 9px;
    border-bottom: 1px solid #dbdde4;

    font-size: 15px;
    font-weight: 600;
    color: #000;
}

.item-med .timetable {
    cursor: pointer;

    display: inline-block;

    margin: 10px 5px;
    padding: 7px 12px;
    border: 1px solid #f2f4fb;
    border-radius: 5px;

    font-size: 15px;
    font-weight: 500;
    color: #216acd;

    background: #f2f4fb;

    transition: 0.3s ease;
}

.item-med .timetable:hover {
    color: #fff;
    background: #8194d4;
}

.item-med .timetable.active {
    color: #fff;
    background: #264ABF;
}

.doc-item {
    margin-bottom: 10px;
    padding-bottom: 10px;
    border-bottom: 1px solid #dbdde4;
}

.doc-name {
    margin-bottom: 3px;
    font-size: 16px;
    font-weight: 600;
}

.timetable-box .doc-item:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.timetable-box {
    margin-top: 20px;
}

.timetable-tabs {
    display: flex;
    gap: 10px;
    justify-content: flex-start;

    margin-top: 20px;
    margin-bottom: 20px;
}

.timetable-tab-item {
    cursor: pointer;

    padding: 5px 10px;
    border-radius: 5px;

    font-family: Montserrat, sans-serif;
    font-size: 14px;

    background: #e0e6ee;
}

.timetable-tab-item.active {
    border-radius: 5px;
    color: #fff;
    background: #264abf;
}

.doctor-timetable-item {
    display: flex;
    flex-wrap: wrap;
    column-gap: 10px;
    margin-bottom: 3px;
}

.doctor-timetable-item .day-week {
    width: 125px;
    font-size: 15px;
    font-weight: 500;
}

.doctor-timetable-item .day-time, .doctor-timetable-item .break-time {
    width: 120px;
    font-size: 15px;
    font-weight: 500;
}

.doctor-timetable-item .break-time {
    display: flex;
    flex-wrap: nowrap;
    gap: 2px;
    align-items: center;
    justify-content: flex-start;
}

.doctor-timetable-item .break-time i {
    width: 20px;
    height: 17px;
    background: url("../../../assets/img/dinner.png") no-repeat center;
    background-size: 80%;
}

.close {
    cursor: pointer;

    position: absolute;
    top: 25px;
    right: 25px;

    width: 20px;
    height: 20px;

    background-color: #8d8d8d;

    mask-image: url("../../../assets/img/close.svg");
    mask-position: center;
    mask-repeat: no-repeat;
    mask-size: 12px;
}

.el-input__inner {
    appearance: none;
    background-color: transparent;
    border: none;
    color: var(--el-select-multiple-input-color);
    font-family: inherit;
    font-size: inherit;
    height: 24px;
    outline: none;
    padding: 0;
    width: 100%;
}
</style>
