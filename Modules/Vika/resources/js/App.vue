<script>
import {useAppStore} from './store/index.js';
import ru from 'element-plus/es/locale/lang/ru';
import {mapState} from 'pinia';

export default {
  name: 'App',
  data() {
    return {
      locale: ru,
    };
  },
  computed: {
    ...mapState(useAppStore, ['linkAPI']),
    ...mapWritableState(useAppStore, {
      vikaType: 'vikaType',
      telegram: 'telegram',
      max: 'max',
      chatId: 'chatId',
    }),
  },
  watch: {
    '$route.query.from_tg': {
      immediate: true,
      handler(newVal) {
        if (newVal) {
          this.telegram = newVal;
        }
      }
    },
    '$route.query.setVikaType': {
      immediate: true,
      handler(newVal) {
        if (newVal) {
          this.vikaType = newVal;
        }
      }
    },
    '$route.query.chat_id': {
      immediate: true,
      handler(newVal) {
        if (newVal) {
          this.chatId = newVal;
        }
      }
    }
  },
  beforeCreate() {
    window.addEventListener('message', async (event) => {
      if (event.data.type === 'whoami') {
        console.log('loaded from', event.data.origin);
        await this.getVikaTypeByResource(event.data.origin);
        console.log('VikaType',this.vikaType);
      }
    });
  },
  methods: {
    async getVikaTypeByResource(url) {
      try {
        let response = await this.$axios.get(this.linkAPI + 'chat/get_vika_type_by_resource', {params: {resource_url: url}});
        console.log('Тип Vika: ', response.data);
        this.vikaType = response.data.name;
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>

<template>
  <el-config-provider :locale="locale">
    <router-view/>
  </el-config-provider>
</template>

<style scoped>

</style>
