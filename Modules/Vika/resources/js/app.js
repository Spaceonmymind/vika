import '../css/app.css';
import App from './App.vue';
import router from './router/index.js';
import VueCookies from 'vue3-cookies';
import {eventBus} from './EventBus'; // Подключаем eventBus

window.Telegram.WebApp.ready();
Telegram.WebApp.expand();
Telegram.WebApp.setBackgroundColor('#ffffff');

import WebAppPlugin from './plugins/webapp.js';

const cookiesConfig = {
    expireTimes: '1d', // Время жизни (1 день)
    path: '/',
    domain: '', // Оставить пустым для текущего домена
};
const app = createApp(App);
app.config.globalProperties.$axios = axios;
app.use(createPinia());
app.use(VueCookies, cookiesConfig);

// Глобальная регистрация eventBus
app.config.globalProperties.$eventBus = eventBus;

const DEBUG_MODE = import.meta.env.VITE_DEBUG_MODE === 'true'; // Проверяем переменную

if (!DEBUG_MODE) {
    console.log = () => {
    }; // Отключаем console.log
} else {
    console.log('Vika: включен режим отладки');
}
app.use(WebAppPlugin);
app.use(router);
app.mount('#app');
