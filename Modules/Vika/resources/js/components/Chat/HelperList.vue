<template>
  <div
    v-if="helperShow"
    class="helper-list"
    :class="vikaTypeSelector==='telemed' ? 'telemed' : ''"
  >
    <div
      class="arrow close-hint-box"
      @click="helperShow=false;"
    />
    <div class="scroll-box">
      <li
        v-for="item in helpList"
        :key="'help'+item.id"
        @click="setMessage(item.value)"
      >
        {{ item.value }}
      </li>
    </div>
  </div>
</template>

<script>
import {mapState, mapWritableState} from 'pinia';
import {useAppStore} from '../../store/index.js';

export default {
  name: 'HelperList',
  data() {
    return {
      helpList: [],
      timer: null,
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI']),
    ...mapWritableState(useAppStore, {
      helperShow: 'helper',
      vikaTypeSelector: 'vikaType'
    }),
  },
  mounted() {
    this.$eventBus.on('getHelper', (event) => {
      if (event.length >= 3) {
        this.getHelpList(event);
      }
    });
  },
  unmounted() {
    this.$eventBus.off('getHelper', null);
  },

  methods: {
    setMessage(message) {
      this.$eventBus.emit('setMessage', message);
      this.helperShow = false;
    },
    getHelpList(query) {
      clearTimeout(this.timer);
      this.timer = setTimeout(async() => {
        try {
          let params = {
            query: query,
            vika_type: this.vikaTypeSelector
          };
          let response = await this.$axios.get(this.linkAPI + 'chat/get_chat_hints', {params});
          console.log('Подсказки: ', response.data);
          this.helpList = response.data;
          if (this.helpList.length !== 0) {
            this.helperShow = true;
          }else{
            this.helperShow = false;
          }
        } catch (error) {
          console.log(error);
        }
      }, 500);
    },
  }
};
</script>


<style scoped>
.helper-list {
  position: absolute;
  z-index: 32;
  bottom: 70px;

  width: 100%;

  font-family: Montserrat, sans-serif;

  background: #fff;
  box-shadow: 0 -70px 70px rgb(0 0 0 / 20%);
}

.helper-list .scroll-box {
  overflow: hidden scroll;

  box-sizing: border-box;
  width: 100%;
  height: 100%;
  max-height: 163px;
  margin: auto;
}

.helper-list .scroll-box::-webkit-scrollbar-button {
  width: 10px;
  height: 0;
  background-repeat: no-repeat;
}

.helper-list .scroll-box::-webkit-scrollbar-track {
  width: 10px;
  border-radius: 10px;
  background-color: #f3f5f6;
}

.helper-list .scroll-box::-webkit-scrollbar-thumb {
  border-radius: 10px;
  background: #c6cdde;
}

.helper-list .scroll-box::-webkit-resizer {
  width: 10px;
  height: 0;
}

.helper-list .scroll-box::-webkit-scrollbar {
  width: 6px;
  height: 6px;
}

.helper-list li {
  width: 100%;
  padding: 11px 20px 11px 30px;
  border-bottom: 1px solid rgb(0 0 0 / 10%);

  font-size: 15px;
  color: #000;
  list-style: none;

  transition: 0.3s ease;
}

.helper-list li:hover {
  cursor: pointer;
  color: #fff;
  background: #2554ca;
}

.helper-list li b {
  font-weight: 500
}

.helper-list li span {
  color: #969696;
}

.helper-list li:hover span {
  color: rgb(255 255 255 / 80%);
}

.helper-list .arrow {
  position: absolute;
  transform: rotate(-90deg);

  width: 14px;
  height: 14px;
  padding: 15px;
  border-radius: 50px;

  background: url("../../../assets/img/arrow.svg") center no-repeat;
  background-size: 14px;

  transition: 0.3s ease;
}

.helper-list .arrow:hover {
  cursor: pointer;
  background-color: #dadce4;
}

.helper-list .close-hint-box {
  top: -20px;
  right: 0;
  left: 0;
  transform: rotate(90deg);

  margin: auto;
  padding: 9px;

  background-color: #fff;
}


/* telemed start */

.helper-list.telemed {
  bottom: 70px;

  width: calc(100% - 40px);
  margin-left: 20px;
  border: 1px solid #d3d3d3;
  border-radius: 5px;

  box-shadow: initial !important;
}


.helper-list.telemed .arrow {
  border: 1px solid #d3d3d3;
}

/* telemed end */
</style>
