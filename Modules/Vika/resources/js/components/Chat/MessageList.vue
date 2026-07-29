<template>
  <div
    ref="messagesBox"
    v-loading="loader"
    class="messages"
    @scroll="handleScroll"
  >
    <div
      v-for="item in messages"
      :key="'message'+item.id"
      ref="itemBoxQuestionAnswer"
      class="item-box-question-answer"
    >
      <div
        v-if="item.message!==undefined && item.message!==null"
        class="message-box question-box"
      >
        {{ item.message }}
      </div>
      <div
        v-if="item.answer!==null"
        class="message-box answer-box"
      >
        <div v-html="item.answer.text" />
        <div
          v-if="item.answer.buttons.length!==0"
          class="button-box"
        >
          <el-button
            v-for="(itemButton, index) in item.answer.buttons"
            :key="'button'+item.id+'-'+index"
            color="#375EDE"
            class="chat-button"
            @click="activeButton(itemButton)"
          >
            {{ itemButton.text }}
          </el-button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import {mapState, mapWritableState} from 'pinia';
import {useAppStore} from '../../store/index.js';

window.Pusher = Pusher;

window.Echo = new Echo({
  broadcaster: 'reverb',
  key: import.meta.env.VITE_REVERB_APP_KEY,
  wsHost: import.meta.env.VITE_REVERB_HOST,
  wsPort: import.meta.env.VITE_REVERB_PORT,
  wssPort: import.meta.env.VITE_REVERB_PORT,
  forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
  enabledTransports: ['ws', 'wss'],
});


export default {
  name: 'MessageList',
  data() {
    return {
      next_page_url: null,
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI']),
    ...mapWritableState(useAppStore, {
      loader: 'loader',
      chatId: 'chatId',
      messages: 'messages',
      messageNew: 'messageNew',
      buttonScroll: 'buttonScroll',
      vikaTypeSelector: 'vikaType'
    }),
  },
  watch: {
    chatId: {
      handler: function (val) {
        if (val !== null) {
          this.listenSocket(val);
        }
      },
      deep: true
    },

  },
  created() {
    this.getHistory();
    if (this.chatId !== null) {
      this.listenSocket(this.chatId);
    }
  },
  mounted() {
    this.$eventBus.on('scrollToBottom', this.scrollToBottom);
  },
  unmounted() {
    window.Echo.channel('chat.' + this.chatId).stopListening('.chat.response-message-made');
    this.$eventBus.off('scrollToBottom', null); // Отписка при удалении компонента
  },
  methods: {
    handleScroll() {
      const box = this.$refs.messagesBox;

      if (box.scrollTop === 0 && this.next_page_url !== null) {
        this.getPreHistory();
      }
      if (box.scrollHeight - parseInt(box.scrollTop) - box.clientHeight > 500) {
        this.buttonScroll = true;
      } else {
        this.buttonScroll = false;
        this.messageNew = 0;
      }
    },
    getHistory() {
      this.loader = true;
      this.$axios.get(this.linkAPI + 'chat/get_history',{params:{vika_type:this.vikaTypeSelector}}).then((response) => {
        console.log('История: ', response.data);
        this.messages = response.data.data;
        this.next_page_url = response.data.next_page_url;
        this.scrollToBottom('auto');
        if (this.$cookies.isKey('chat_id')) {
          this.chatId = this.$cookies.get('chat_id');
        }
        this.loader = false;
      }).catch((error) => {
        this.loader = false;
        console.log(error);
      });
    },
    getPreHistory() {
      this.loader = true;
      this.$axios.get(this.next_page_url,{params:{vika_type:this.vikaTypeSelector}}).then((response) => {
        console.log('История: ', response.data);
        this.messages.unshift(...response.data.data);
        this.next_page_url = response.data.next_page_url;
        let heightHistory = response.data.data.length;
        let heightScroll = 0;

        for (let i = 0; i < heightHistory; i++) {
          heightScroll += this.$refs.itemBoxQuestionAnswer[i].scrollHeight;
        }
        console.log('Высота полученных сообщений', heightScroll);
        this.$nextTick(() => {
          this.$refs.messagesBox.scrollTop = heightScroll;
        });
        this.loader = false;

      }).catch((error) => {
        this.loader = false;
        console.log(error);
      });
    },
    scrollToBottom(behavior) {
      this.$nextTick(() => {
        if (this.$refs.messagesBox) {
          this.$refs.messagesBox.scrollTo({
            top: this.$refs.messagesBox.scrollHeight,
            behavior: !behavior ? 'smooth' : behavior, // Плавная анимация если не задан параметр
          });
        }
      });
    },
    listenSocket(chatId) {
      console.log('Начинаю слушать сокет');
      window.Echo.channel('chat.' + chatId).listen('.chat.response-message-made', (e) => {
        console.log('Пришло сообщение в сокет', e);
        if(this.messages.find(item => item.id === e.message_id)!==undefined){
          this.messages.find(item => item.id === e.message_id).answer = e.answer;
        }else{
          this.messages.push({answer:e.answer});
        }
        this.messageNew++;
        const box = this.$refs.messagesBox;
        if (box.scrollHeight - parseInt(box.scrollTop) - box.clientHeight <= 500) {
          this.scrollToBottom();
          this.buttonScroll = false;
          this.messageNew = 0;
        }
      });
    },
    activeButton(buttonInfo) {
      switch (buttonInfo.type) {
        case 'link':
          window.open(buttonInfo.url, '_blank');
          break;
        case 'widget':
          let params = {};
          for (let key in buttonInfo.params) {
            if (Array.isArray(buttonInfo.params[key])) {
              params[`${key}[]`] = buttonInfo.params[key];
            } else {
              params[key] = buttonInfo.params[key];
            }
          }
          this.$router.push({path: '/widget/proxy/' + buttonInfo.widget, query:params});
          break;
      }
    },
  }
};
</script>

<style scoped>
.messages {
  scrollbar-color: #c6cdde #f3f5f6;
  scrollbar-width: thin;

  position: relative;

  overflow: hidden scroll;

  box-sizing: border-box;
  width: 100%;
  height: 100%;
  margin: auto;
  padding: 0 25px
}

.messages::-webkit-scrollbar-button {
  width: 10px;
  height: 0;
  background-repeat: no-repeat
}

.messages::-webkit-scrollbar-track {
  width: 10px;
  border-radius: 10px;
  background-color: #f3f5f6
}

.messages::-webkit-scrollbar-thumb {
  border-radius: 10px;
  background: #c6cdde
}

.messages::-webkit-resizer {
  width: 10px;
  height: 0
}

.messages::-webkit-scrollbar {
  width: 10px;
  height: 6px
}

.item-box-question-answer {
  display: flex;
  flex-direction: column;
  gap: 10px;
  margin-bottom: 10px;
}

.message-box {
  position: relative;

  width: fit-content;
  max-width: 80%;
  padding: 18px 23px;
  border-radius: 15px;

  font-size: 15px;
  font-weight: 400;
  line-height: 160%;
}

.message-box.question-box {
  margin-left: auto;
  border-bottom-right-radius: 0;
  color: #fff;
  background: #375EDE;
}

.message-box.answer-box {
  margin-right: auto;
  border-bottom-left-radius: 0;
  color: #353535;
  background: #F0F1F5;
}

.button-box {
  display: flex;
  flex-wrap: wrap;
  gap: 15px;
  justify-content: flex-start;

  margin-top: 20px;
}

.button-box .el-button + .el-button {
  margin-left: 0;
}

.button-box .chat-button{
  height: max-content;
  border-radius: 15px;

  font-family: Roboto, sans-serif;
  line-height: 150%;
  white-space: normal;
}
</style>
