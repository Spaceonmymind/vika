<template>
  <div v-loading='loading' class="proxy">
  </div>
</template>
<script>
import {useAppStore} from '../../store/index.js';

export default {
  name: 'ProxyMax',
  data(){
    return{
      loading: false,
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI']),
    ...mapWritableState(useAppStore, {
      chatId: 'chatId',
      max: 'max',
    }),
  },
  created() {
    this.max = true;
    if(this.$route.query.WebAppStartParam){
        this.getWidgetByMax(this.$route.query.WebAppStartParam);
    }else{
        this.$router.push('/widget/list');
    }
  },
  methods:{
    getWidgetByMax(id) {
      this.loading = true;
      this.$axios.get(this.linkAPI + 'max/'+id+'/get_widget')
        .then((response) => {
          console.log('Виджет:', response);
          this.chatId = response.data.params.chat_id;
          if (response.data.widget_id!==null) {
            this.$router.push( {path:'/widget/proxy/'+response.data.chat_widget.code_name, query:response.data.params});
          } else {
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
  }
};
</script>


<style scoped>
.proxy {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
}
</style>
