require('./bootstrap');

import Vue from 'vue';
import { vuetify } from "./plagins/vuetify";
import { router } from "./router";
import { store } from "./store";
import App from './App'
import './router/guard'
import './plagins/toast'

const app = new Vue({
    vuetify,
    router,
    store,
    created () {
        const token = localStorage.getItem('access_token')
        if (token) {
            this.$store.commit('setToken', token)
        }
        axios.interceptors.response.use(
            response => response,
            error => {
                if (error.response.status === 401 || error.response.status === 403) {
                    this.$store.commit('logout')
                    this.$router.push('/login')
                }
                return Promise.reject(error)
            }
        )
    },
    render: h => h(App)
}).$mount('#app');
