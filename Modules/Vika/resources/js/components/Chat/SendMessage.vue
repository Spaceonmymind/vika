<template>
  <div :class="['send-message',vikaTypeSelector==='telemed' ? 'telemed' : '']">
    <div :class="['text-box', allServiceShow ? 'non-shadow' : '', helperShow ? 'non-shadow' : '',]">
      <div class="box">
        <input
          v-model="message"
          type="text"
          placeholder="Введите сообщение"
          class="text"
          @input="getHelper()"
          @keyup.enter="sendMessage()"
        >

        <div
          v-if="message.length!==0"
          class="button-read button-send"
          @click="sendMessage()"
        >
          <div
            title="Отправить сообщение"
            class="send-ico"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapState, mapWritableState} from 'pinia';
import {useAppStore} from '../../store/index.js';

export default {
  name: 'SendMessage',
  data() {
    return {
      loadSendMessage: false,
      message: '',
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI']),
    ...mapWritableState(useAppStore, {
      chatId: 'chatId',
      messages: 'messages',
      allServiceShow: 'allService',
      helperShow: 'helper',
      vikaTypeSelector: 'vikaType'
    }),
  },
  mounted() {
    this.$eventBus.on('setMessage', (event) => {
      this.message = event;
    });
  },
  unmounted() {
    this.$eventBus.off('setMessage', null);
  },
  methods: {
    sendMessage() {
      if (!this.loadSendMessage) {
        if (this.message.trim().length !== 0) {
          this.helperShow = false;
          this.loadSendMessage = true;
          this.$axios.post(this.linkAPI + 'chat/send_message', {
            message: this.message,
            vika_type: this.vikaTypeSelector
          }).then((response) => {
            console.log('Ответ на отправку сообщения: ', response.data);
            this.messages.push({
              message: this.message,
              id: response.data.message_id,
              answer: null,
            });
            this.message = '';
            this.$eventBus.emit('scrollToBottom', null);
            this.loadSendMessage = false;
          }).catch((error) => {
            this.loadSendMessage = false;
            console.log(error);
          });
        }
      }
    },
    getHelper() {
      if (this.message.trim().length >= 3) {
        this.$eventBus.emit('getHelper', this.message);
      } else {
        this.helperShow = false;
      }
    }
  }
};
</script>


<style scoped>

.send-message{
  position: relative;
  height: 100%;
}

.send-message .text-box {
  box-sizing: border-box;
  width: 100%;
  height: 100%;
  padding: 0 25px;
  border-top: 1px solid #E8ECF4;

  background: #fff;
  box-shadow: 0 -4px 156px rgb(82 109 198 / 20%);

  transition: 0.3s ease;
}

.send-message .text-box .box {
  display: flex;
  gap: 20px;
  align-items: center;
  justify-content: space-between;

  width: 100%;
  height: 100%;
}

.send-message .text-box.non-shadow {
  box-shadow: initial !important;
}

.send-message .text-box .text {
  box-sizing: border-box;
  width: inherit;
  height: 100%;
  border: 0;

  font-family: Montserrat, sans-serif;
  font-size: 15px;
  font-weight: 500;
  line-height: 150%;
  color: #000;

  background: #fff;
  outline: 0;
}


.send-message .text-box .button-read {
  width: 40px;
  height: 40px;
  border-radius: 50px;

  transition: 0.3s ease;
  animation-name: bounceIn;
  animation-duration: 0.75s;
}


.send-message .text-box .button-read:hover {
  cursor: pointer;
  background: #2554ca;
}

.send-message .text-box .button-read .send-ico {
  width: 40px;
  height: 40px;

  background-color: #2554ca;

  mask-image: url("../../../assets/img/send.svg");
  mask-position: center;
  mask-repeat: no-repeat;
  mask-size: 20px;
}

.send-message .text-box .button-read:hover .send-ico {
  background-color: #fff;
}

/* telemed start */

.send-message.telemed {
  display: flex;
  justify-content: center;
}

.send-message.telemed .text-box {
  overflow: hidden;

  width: calc(100% - 40px);
  height: 48px;
  margin-bottom: 20px;
  border: 1px solid #d3d3d3;
  border-radius: 5px;

  box-shadow: initial !important;
}

/* telemed end */


</style>
