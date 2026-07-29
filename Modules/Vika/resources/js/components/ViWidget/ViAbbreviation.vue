<template>
  <div
    v-loading="loader"
    class="vi-abbreviation"
  >
    <el-dialog
      v-if="detailAbbreviation.active"
      v-model="detailAbbreviation.active"
      class="detail-dialog-box"
      :close-on-click-modal="false"
      top="20px"
      width="calc(100% - 40px)"
      :title="detailAbbreviation.data.abbreviation"
    >
      <div
        class="scroll-box"
      >
        <div
          v-if="detailAbbreviation.data.decoding!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Расшифровка аббревиатуры
          </div>
          {{ detailAbbreviation.data.decoding }}
        </div>

        <div
          v-if="detailAbbreviation.data.description!==null"
          class="item-form"
        >
          <div class="item-title-form">
            Описание аббревиатуры
          </div>
          {{ detailAbbreviation.data.description }}
        </div>
      </div>
    </el-dialog>

    <div class="content-box">
      <div
        v-if="abbreviationList===null"
        class="hello-box"
      >
        Можно найти расшифровку аббревиатуры
      </div>
      <div
        v-else
        class="scroll-box"
      >
        <div
          v-if="abbreviationList.length===0"
          class="hello-box"
        >
          По вашему запросу ничего не найдено
        </div>

        <div
          v-for="item in abbreviationList"
          :key="'abbreviationList'+item.id"
          class="item-it-info"
          @click="setDetail(item)"
        >
          <div><span>{{ item.abbreviation }}</span></div>
        </div>
      </div>
    </div>
    <div class="filter-box">
      <div
        class="filter"
      >
        <div class="title-filter">
          Поиск аббревиатуры
        </div>
        <div class="filter-input-box">
          <el-input
            v-model="filter.name"
            placeholder="Поиск"
            clearable
            class="filter-input filter-input-button"
            @keyup.enter="getAbbreviations()"
          />
          <div
            class="search-button"
            title="Искать"
            @click="getAbbreviations()"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {useAppStore} from '../../store/index.js';

export default{
  name: 'ViAbbreviation',
  data(){
    return{
      loader: false,
      abbreviationList: null,
      filter: {
        name: null,
      },
      detailAbbreviation: {
        active: false,
        data: null,
      }
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI']),
  },
  created() {
    this.startParams();
    this.getAbbreviations();
  },
  methods:{
    getAbbreviations() {
      this.loader = true;
      this.$axios.get(this.linkAPI + 'widget/abbreviation_help/get_abbreviations', {params: this.filter})
        .then((response) => {
          console.log('Список аббревиатур: ', response.data);
          this.abbreviationList = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loader = false;
        });
    },
    startParams() {
      if (this.$route.query.name) {
        this.filter.name = this.$route.query.name;
      }
    },
    setDetail(abbreviation) {
      this.detailAbbreviation.data = abbreviation;
      this.detailAbbreviation.active = true;
    },
  }
};
</script>

<style scoped>
.vi-abbreviation {
  display: grid;
  grid-template-rows: calc(100% - 175px) 175px;
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

.title-filter {
  margin-bottom: 17px;
  font-family: Montserrat, sans-serif;
  font-size: 17px;
  font-weight: 600;
}

.item-form {
  margin-bottom: 10px;
}

.filter-input-box{
  position: relative;
}

.search-button {
  cursor: pointer;

  position: absolute;
  top: 0;
  right: 0;

  width: 50px;
  height: 50px;

  background: url("../../../assets/img/search.png") center no-repeat;
}

.item-it-info {
  display: flex;
  gap: 10px;
  align-items: baseline;

  margin-bottom: 15px;
  padding: 0 25px;

  font-family: Montserrat, sans-serif;
  font-size: 16px;
  font-weight: 400;
  line-height: 170%;
}

.item-it-info:hover {
  cursor: pointer;
  color: #005ae1;
}

.item-it-info::before {
  content: '';

  width: 7px;
  min-width: 7px;
  height: 7px;
  border-radius: 10px;

  background: #005ae1;

}

.item-it-info div {
  width: fit-content;
}

.item-it-info div span {
  display: inline;
  padding-bottom: 2px;
  border-bottom: 1px solid rgb(0 0 0 / 10%);
}

.item-title-form {
  margin-bottom: 5px;
  font-size: 16px;
  font-weight: 600;
}


</style>

<style>
.filter-input-button  .el-input__wrapper {
  padding: 0 50px 0 20px;
}

.el-dialog.detail-dialog-box {
  display: grid;
  grid-template-rows: auto 1fr;
  max-height: calc(100dvh - 40px);
  border-radius: 15px
}

.el-dialog.detail-dialog-box .el-dialog__body {
  display: contents;

  font-family: Montserrat, sans-serif;
  font-size: 16px;
  font-weight: 400;
  line-height: 135%;
  color: #000;
}

.el-dialog.detail-dialog-box .el-dialog__title {
  font-family: Montserrat, sans-serif;
  font-size: 18px;
  font-weight: 500;
  line-height: 140%;
  color: #000;
}

.el-dialog.detail-dialog-box ul, .el-dialog.detail-dialog-box ol {
  padding-left: 0;
}

.el-dialog.detail-dialog-box ul li, .el-dialog.detail-dialog-box ol li {
  position: relative;

  display: inline-block;

  margin-bottom: 5px;
  padding-left: 15px;

  list-style: none;
}

.el-dialog.detail-dialog-box li::before {
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
