import Vue from 'vue'
import Vuex from 'vuex'
import { service } from "./services";
import { account } from "./accounts";

Vue.use(Vuex)
export const store = new Vuex.Store({
    state:{
        token: localStorage.getItem('access_token') || null,
        currentService: 'all',
        error: null,
        loading: false
    },
    getters:{
        currentService: state => state.currentService,
        getToken: state => state.token,
        isAuth: state => !!state.token,
        error: state => state.error,
        isLoading: state => !!state.loading
    },
    mutations:{
        setError (state, error) {
            state.error = error
        },
        clearError (state) {
            state.error = null
        },
        setCurrentService (state, service) {
            state.currentService = service
        },
        setToken (state, token) {
            state.token = token
            localStorage.setItem('access_token', token)
            axios.defaults.headers.common.Authorization = `Bearer ${token}`
        },
        logout (state) {
            localStorage.removeItem('access_token')
            state.token = null
        },
        startLoading (state) {
            state.loading = true
        },
        stopLoading (state) {
            state.loading = false
        }
    },
    actions:{
        async login({ commit }, credentials) {
            try {
                await axios.get('/sanctum/csrf-cookie')
                const response = await axios.post('/api/login', credentials)
                const data = await response.data
                localStorage.setItem('access_token', data.token)
                commit('setToken', data.token)
            }catch (e){
                commit('setError', e)
                throw e
            }
        },
        async register ({ commit }, credentials) {
            try {
                await axios.get('/sanctum/csrf-cookie')
                const response = await axios.post('/api/register', credentials)
                const data = await response.data
                commit('setToken', data.token)
            }catch (e) {
                commit('setError', e)
                throw e
            }
        },
        async logout ({ commit }) {
            try {
                await axios.post('/api/logout')
                commit('logout')
            } catch (e) {
                commit('setError', e)
                throw e
            }
        },
        parseError({ commit }, e) {
            try {
                return Object.values(e.response.data.errors).map(item => item.map(err => err)).join('<br>')
            }catch (err){
                if (e.response.status === 404) {
                    return 'Not Found! Reload page or try later or _('
                }
                if (e.response.status === 401){
                    return 'Unauthenticated! Token is invalid'
                }
                if (e.response.status === 500 || e.response.data.message === '') {
                    return 'Something is wrong! Reload page or try later or _('
                }
                return e.response.data.message
            }
        }
    },
    modules:{ service, account }
})
