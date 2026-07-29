<template>
  <div class="widget-panel">
    <div
      v-if="!allService"
      class="vi-panel-bott"
    >
      <div class="hidden-box-scroll">
        <div v-for="item in favorite" :key="'favorite'+item.id" class="favorite">
          <div v-if="item.is_widget" :class="['icon', item.widget.icon!==null ? item.widget.icon.code : '']" :title="item.widget.name" @click="setWidget(item.widget.code_name)">
            <div class="grad" :style="item.widget.bg_colour!==null ? 'background:'+item.widget.bg_colour : ''"></div>
          </div>
          <div v-if="!item.is_widget" :class="['icon', item.icon!==null ? item.icon.code : '']" :title="item.name" @click="setCategory(item.id)">
            <div class="grad" :style="item.bg_colour!==null ? 'background:'+item.bg_colour : ''"></div>
          </div>
        </div>
      </div>

      <div
        v-if="vikaTypeSelector!=='archive'"
        class="arrow open-list"
        @click="allService=true;"
      />
    </div>
    <div
      v-if="allService"
      class="modal-box all-services"
    >
      <div class="modal-title">
        Все сервисы
      </div>
      <div
        class="modal-close"
        @click="closeAllService()"
      />
      <div class="scroll-box-area">
        <div class="scroll-box">
          <div class="modal-content">
            <div class="services-list">
              <div v-for="item in structure" :key="'structure'+item.id" class="item-position" >
                <div v-if="!item.is_widget" :ref="'category'+item.id" :class="['category', item.active ? 'active' : '']" @click="setCategory(item.id)">
                  <div class="line-box">
                    <div :class="['icon',item.icon!==null ? item.icon.code : '' ]" >
                      <div class="grad" :style="item.bg_colour!==null ? 'background:'+item.bg_colour : ''"></div>
                    </div>
                    <div class="title">
                      <div class="name">{{ item.name }}</div>
                      <div class="description">{{ item.description }}</div>
                    </div>
                  </div>
                </div>
                <div v-if="item.active" class="widgets-box">
                  <div v-for="itemWidget in item.attached_to_vika_type_widgets" :key="'widget'+itemWidget.id" class="widget" @click=" setWidget(itemWidget.widget.code_name)">
                    <div :class="['icon', itemWidget.widget.icon!==null ? itemWidget.widget.icon.code : '']">
                      <div
                        class="grad"
                        :style="itemWidget.widget.bg_colour!==null ? 'background:'+itemWidget.widget.bg_colour : ''"></div>
                    </div>
                    <div class="title">
                      <div class="name">{{ itemWidget.widget.name }}</div>
                      <div class="description">{{ itemWidget.widget.description }}</div>
                    </div>
                  </div>
                </div>
                <div v-if="item.is_widget" class="widget" @click="setWidget(item.widget.code_name)">
                  <div :class="['icon', item.widget.icon!==null ? item.widget.icon.code : '']">
                    <div class="grad" :style="item.widget.bg_colour!==null ? 'background:'+item.widget.bg_colour : ''"></div>
                  </div>
                  <div class="title">
                    <div class="name">{{ item.widget.name }}</div>
                    <div class="description">{{ item.widget.description }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {useAppStore} from '../../store/index.js';

export default {
  name: 'WidgetPanel',
  data() {
    return {
      structure: [],
      favorite: [],
      loadingStructure: false,
    };
  },
  computed: {
    ...mapWritableState(useAppStore, {
      vikaTypeSelector: 'vikaType',
      allService: 'allService',
    }),
    ...mapState(useAppStore, ['linkAPI']),
  },
  watch:{
    vikaTypeSelector: function (newVal) {
      if (newVal) {
        this.getStructure();
      }
    }
  },
  created() {
    this.getStructure();
  },
  methods: {
    setWidget(name) {
      let link = '/widget/proxy/' + name;
      this.$router.push(link);
      this.allService = false;
    },
    getStructure() {
      this.loadingStructure = true;
      this.$axios.get(this.linkAPI + 'chat/get_widgets', {params: {vika_type: this.vikaTypeSelector}})
        .then((response) => {
          console.log('Структура:', response);
          this.favorite = response.data.favorite;
          this.structure = response.data.widgets_and_categories.map(item => {
            return {...item, active: false};
          });
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingStructure = false;
        })
      ;
    },
    setCategory(id){
      this.structure.forEach(item => {
        if (item.id === id) {
          item.active = !item.active;
        } else {
          item.active = false;
        }
      });
      this.allService = true;
      this.$nextTick(() => {
        let category = this.$refs['category' + id];
        if (category && category.length > 0) {
          category[0].scrollIntoView({behavior: 'smooth', block: 'start'});
        }
      });
    },
    closeAllService() {
      this.allService = false;
      this.structure.forEach(item => {
        item.active = false;
      });
    }
  }
};
</script>

<style scoped>
.widget-panel {
  position: relative;
  height: 100%;
}

.vi-panel-bott {
  position: relative;
  box-sizing: border-box;
  width: 100%;
  padding: 20px 25px 25px;
}

.favorite {
  position: relative;
  display: inline-block;
  width: 40px;
  height: 43px;
  margin: 0 6px 0 0;
  transition: 0.3s ease;
  cursor: pointer;
}

.item-position {
  cursor: pointer;
}

.widget:hover, .category:hover{
  background: #f3f4f7;
}

.category.active{
  background: #f3f4f7;
}

.widget {
  display: flex;
  align-items: center;
  gap: 10px;
  justify-content: flex-start;
  padding: 10px 30px;
}

.category{
  padding: 10px 30px;
}

.category .line-box {
  display: flex;
  align-items: center;
  gap: 10px;
  justify-content: flex-start;
}

.widgets-box {
  padding: 15px 30px;
}

.widgets-box .widget {
  padding: 10px;
  border-radius: 10px;
}

.item-position .title .name {
  font-size: 16px;
  font-weight: 600;
  letter-spacing: 0.3px;
}

.name.favorite{
  color: #236bd8;
}

.item-position .title .description {
  font-size: 13px;
  font-weight: 400;
  letter-spacing: -0.3px;
  transition: 0.2s ease;
}

.hidden-box-scroll {
  overflow-x: auto;
  width: calc(100% - 50px);
  white-space: pre;
}

.hidden-box-scroll::-webkit-scrollbar {
  width: 0;
  height: 0
}

.arrow {
  position: absolute;
  width: 10px;
  height: 10px;
  padding: 20px;
  border-radius: 50px;
  background: url("../../../assets/img/spanel_arrow.svg") center no-repeat;
  background-size: 13px;
  transition: 0.3s ease;
}

.arrow:hover {
  cursor: pointer;
  background-color: #dadce4;
}

.open-list {
  position: absolute;
  top: 0;
  right: 25px;
  bottom: 0;
  margin: auto;
}

.modal-box {
  position: absolute;
  z-index: 110;
  bottom: 0;
  box-sizing: border-box;
  width: 100%;
  height: calc(100dvh - 50px);
  max-height: 630px;
  font-family: Montserrat, sans-serif;
  background: #fff;
  box-shadow: 0 -70px 70px rgb(0 0 0 / 20%);
  animation-duration: 0s;
  animation-delay: 0s;
  animation-iteration-count: 1;
}

.modal-title {
  padding: 30px 0 15px 30px;
  font-family: Montserrat, sans-serif;
  font-size: 18px;
  font-weight: 500;
  color: #282828;
}

.modal-content {
  padding-top: 10px;
}

.modal-close {
  position: absolute;
  top: 15px;
  right: 20px;
  width: 10px;
  height: 10px;
  padding: 20px;
  background: url("../../../assets/img/close.svg") center no-repeat;
  background-size: 16px;
}

.modal-close:hover {
  cursor: pointer;
  border-radius: 50px;
  background-color: #eff0f4;
}

.all-services {
  font-family: Montserrat, sans-serif;
}

.services-list .serv-item.serv-cat {
  padding: 10px 30px;
  border-radius: 0 !important;
}

.services-list .serv-item.serv-cat:hover {
  background: #F3F4F7;
}

.services-list .serv-item.serv-cat.active {
  background: #F3F4F7;
}

.services-list .serv-item {
  display: table;
  width: 100%;
  padding: 10px;
  border-radius: 10px;
  color: #000;
  transition: 0.3s ease;
}

.services-list .serv-item:hover {
  cursor: pointer;
  background: #f5f7fa;
}

.services-list .serv-item:last-child {
  margin-bottom: 0;
}

.services-list .serv-item .vi-serv {
  vertical-align: middle;
}

.services-list .serv-item .vi-serv-info {
  position: relative;
  display: inline-block;
  width: calc(100% - 61px);
  margin-left: 11px;
  vertical-align: middle;
}

.services-list .serv-item .vi-serv-info-name {
  font-size: 16px;
  font-weight: 600;
  letter-spacing: 0.3px;
  transition: 0.2s ease;
}

.services-list .serv-item .vi-serv-info-desc {
  font-family: Montserrat, sans-serif;
  font-size: 13px;
  font-weight: 400;
  letter-spacing: -0.3px;
  transition: 0.2s ease;
}

.widget-panel .scroll-box-area {
  position: relative;
  height: calc(100% - 37px);
  margin: 0;
}

.widget-panel .scroll-box-area::after {
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  display: block;
  width: 10px;
  height: 100%;
  background: #fff;
  transition: .5s;
}

.widget-panel .scroll-box-area:hover::after {
  right: 0;
  visibility: hidden;
  background: transparent;
}

.widget-panel .scroll-box {
  scrollbar-color: #c6cdde #f3f5f6;
  scrollbar-width: thin;
  position: relative;
  overflow: hidden scroll;
  box-sizing: border-box;
  width: 100%;
  height: calc(100% - 50px);
  margin: auto;
  padding-right: 2px;
}

.widget-panel .scroll-box::-webkit-scrollbar-button {
  width: 6px;
  height: 0;
  background-repeat: no-repeat;
}

.widget-panel .scroll-box::-webkit-scrollbar-track {
  width: 6px;
  border-radius: 10px;
  background-color: #f3f5f6;
}

.widget-panel .scroll-box::-webkit-scrollbar-thumb {
  border-radius: 10px;
  background: #c6cdde;
}

.widget-panel .scroll-box::-webkit-resizer {
  width: 6px;
  height: 0;
}

.widget-panel .scroll-box::-webkit-scrollbar {
  width: 6px;
  height: 6px;
}
</style>


