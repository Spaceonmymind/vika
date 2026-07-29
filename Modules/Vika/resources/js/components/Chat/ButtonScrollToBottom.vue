<template>
  <div class="button-scroll-to-bottom">
    <div
      v-if="buttonScroll"
      class="buttonScroll"
      title="В конец чата"
      @click="scrollToBottom()"
    >
      <div
        v-if="messageNew!==0"
        class="new-message"
      >
        {{ messageNew }}
      </div>
    </div>
  </div>
</template>

<script>
import {mapWritableState} from 'pinia';
import {useAppStore} from '../../store/index.js';

export default {
    name: 'ButtonScrollToBottom',
    data() {
        return {};
    },
    computed: {
        ...mapWritableState(useAppStore, {
            messageNew: 'messageNew',
            buttonScroll: 'buttonScroll',
        }),
    },
    methods: {
        scrollToBottom() {
            this.$eventBus.emit('scrollToBottom', null);
        }
    }
};
</script>

<style scoped>
.button-scroll-to-bottom .buttonScroll {
    cursor: pointer;

    position: fixed;
    z-index: 10;
    right: 20px;
    bottom: 175px;
    transform: rotate(90deg);

    width: 14px;
    height: 14px;
    padding: 15px;
    border-radius: 50px;

    background: url("../../../assets/img/arrow.svg") center no-repeat;
    background-color: #dadce4b5;
    background-size: 14px;

    transition: 0.3s ease;
}

.button-scroll-to-bottom .buttonScroll:hover {
    background-color: #dadce4;
}


.button-scroll-to-bottom .buttonScroll .new-message {
    position: absolute;
    top: 2px;
    left: -10px;
    transform: rotate(-90deg);

    display: flex;
    align-items: center;
    justify-content: center;

    width: 20px;
    height: 20px;
    border-radius: 50px;

    font-family: Roboto, sans-serif;
    font-size: 12px;
    color: #fff;

    background: #2554ca;
}
</style>
