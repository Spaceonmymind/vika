<template>
  <div class="vika-chat">
    <TopPanel />
    <Message />
    <WidgetPanel />
    <SendMessage />
    <ButtonScrollToBottom />
    <HelperList />
  </div>
</template>

<script>
import {mapState, mapWritableState} from 'pinia';
import {useAppStore} from '../store/index.js';

import Message from '../components/Chat/MessageList.vue';
import SendMessage from '../components/Chat/SendMessage.vue';
import TopPanel from '../components/Chat/TopPanel.vue';
import WidgetPanel from '../components/Chat/WidgetPanel.vue';
import ButtonScrollToBottom from '../components/Chat/ButtonScrollToBottom.vue';
import HelperList from '../components/Chat/HelperList.vue';

export default {
  name: 'ChatWindows',
  components: {
    Message,
    SendMessage,
    TopPanel,
    WidgetPanel,
    ButtonScrollToBottom,
    HelperList,
  },
  data() {
    return {};
  },
  computed: {
    ...mapWritableState(useAppStore, {
      loader: 'loader'
    }),
    ...mapState(useAppStore, ['linkAPI'])
  },
  created() {

  },
  methods: {}
};
</script>

<style scoped>

.vika-chat {
  display: grid;
  grid-template-rows: 70px 1fr 90px 70px;
  height: 100%;
}

</style>
