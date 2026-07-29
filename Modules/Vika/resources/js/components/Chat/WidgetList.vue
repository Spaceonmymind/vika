<template>
  <div class="widget-list">
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
              <div v-for="itemWidget in item.attached_to_vika_type_widgets" :key="'widget'+itemWidget.id" class="widget" @click="setWidget(itemWidget.widget.code_name)">
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

</template>


<script>
import {useAppStore} from '../../store/index.js';

export default {
  name: 'WidgetList',
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
  }
};
</script>

<style scoped>

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

.item-position .title .description {
  font-size: 13px;
  font-weight: 400;
  letter-spacing: -0.3px;
  transition: 0.2s ease;
}

.scroll-box{
  overflow-y: auto;
}

.widget-list{
  font-family: Montserrat, sans-serif;
}

.widget-list .scroll-box-area {
  position: relative;
  height: 100%;
  margin: 0;
}

.widget-list .scroll-box-area::after {
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

.widget-list .scroll-box-area:hover::after {
  right: 0;
  visibility: hidden;
  background: transparent;
}

.widget-list .scroll-box {
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

.widget-list .scroll-box::-webkit-scrollbar-button {
  width: 6px;
  height: 0;
  background-repeat: no-repeat;
}

.widget-list .scroll-box::-webkit-scrollbar-track {
  width: 6px;
  border-radius: 10px;
  background-color: #f3f5f6;
}

.widget-list .scroll-box::-webkit-scrollbar-thumb {
  border-radius: 10px;
  background: #c6cdde;
}

.widget-list .scroll-box::-webkit-resizer {
  width: 6px;
  height: 0;
}

.widget-list .scroll-box::-webkit-scrollbar {
  width: 6px;
  height: 6px;
}
</style>
