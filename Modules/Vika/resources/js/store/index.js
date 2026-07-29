import {defineStore} from 'pinia';

export const useAppStore = defineStore('appStore', {
    state: () => ({
        linkAPI: '/api/',
        loader: false,
        chatId: null,
        vikaType: null,
        messages: [],
        messageNew: 0,
        buttonScroll: false,
        allService:false,
        helper:false,
        telegram:false,
        max:false,
        dadata_api_key: import.meta.env.VITE_DADATA_TOKEN
    }),
    actions: {},
});
