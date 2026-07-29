import '../assets/css/app.css';
import App from './App.vue';
import VueCookies from 'vue3-cookies';
import {eventBus} from './EventBus';
import router from './router/index.js';

const rootContainer = document.getElementById('module-admin');

if (rootContainer) {
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
    axios.interceptors.response.use(
        response => response,
        error => {
            if (error.response.status === 401) {
                if(window.location.pathname!=='/admin/login'){
                    window.location.href = '/admin/login';
                }
            }
            if (error.response.status === 403) {
                if(window.location.pathname!=='/admin/no-access'){
                    window.location.href = '/admin/no-access';
                }
            }
            return Promise.reject(error);
        });
    const DEBUG_MODE = import.meta.env.VITE_DEBUG_MODE === 'true'; // Проверяем переменную
    if (!DEBUG_MODE) {
        console.log = () => {
        }; // Отключаем console.log
    } else {
        console.log('Включен режим отладки для модуля админ');
    }
    app.use(router);
    app.mount('#module-admin');
}
