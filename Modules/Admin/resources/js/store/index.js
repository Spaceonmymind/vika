import {defineStore} from 'pinia';
import axios from 'axios';

export const useAppStore = defineStore('appStore', {
    state: () => ({
        linkAPI: '/api/admin/',
        linkAPIActirovki: '/api/',
        user: null,
        loader: false,
        isMobile: false,
    }),
    actions: {
        async fetchUser() {
            this.loader = true;
            try {
                const res = await axios.get(this.linkAPI+'user/me');
                console.log('Пользователь: ', res);
                this.user = res.data;
            } catch (e) {
                console.log(e);
                this.user = null;
            } finally {
                this.loader = false;
            }
        },
        hasRole(role) {
            return this.user && Array.isArray(this.user.roles) && this.user.roles.includes(role);
        }
    },
});
