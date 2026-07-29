<script>
import {useAppStore} from '../../store/index.js';

export default {
  name: 'ProxyWidget',
  data() {
    return {
      loading: false,
      url:null,
      button:false,
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI', 'chatId','telegram','max']),
  },
  created() {
    this.getWidgetByCode(this.$route.params.widgetName);
  },
  methods: {
    getWidgetByCode(code) {
      this.loading = true;
      this.$axios.get(this.linkAPI + 'chat/widget/' + code + '/get_by_code')
        .then((response) => {
          console.log('Виджет:', response);
          if (response.data.is_active) {
            this.safeWidgetHit(response.data.code_name);
            if (response.data.type.code === 'internal') {
              this.$router.push({path: '/widget/' + response.data.code_name, query: this.$route.query});
            } else if (response.data.type.code === 'link') {
              if(this.telegram){
                this.url = response.data.url;
                this.button = true;
              }else{
                window.open(response.data.url, '_blank');
                if(this.telegram || this.max){
                    this.$router.push('/widget/list');
                }else{
                    this.$router.push('/');
                }

              }
            }
          } else {
            ElMessage.error('Виджет временно недоступен');
            this.$router.push('/widget/list');
          }
        })
        .catch((error) => {
          console.log(error);
          this.$router.push('/');
        })
        .finally(() => {
          this.loading = false;
        })
      ;
    },
    safeWidgetHit(widget_name) {
      let params = {
        chat_id: this.chatId,
        widget_code_name: widget_name,
        from_tg: this.telegram ? 1 : 0,
        from_max: this.max ? 1 : 0,
      };
      this.$axios.post(this.linkAPI + 'chat/safe_widget_hit', params)
        .then((response) => {
          console.log('Ответ на фиксацию обращения к виджету: ', response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    setUrl() {
      Telegram.WebApp.openLink(this.url);
      this.$router.push('/widget/list');
    }
  }
}
;
</script>

<template>
  <div v-loading='loading' class="proxy">

    <el-button v-if="button" @click="setUrl()">Открыть</el-button>

  </div>
</template>

<style scoped>
.proxy {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
}
</style>
