import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

export const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'main',
            component:() => import('../pages/Main.vue'),
            meta: {
                requiredAuth: true,
                layout: 'main'
            }
        },
        {
            path: '/login',
            name: 'login',
            component:() => import('../pages/Login.vue'),
            meta: {
                layout: 'login',
                authenticated: true
            }
        },
        {
            path: '/register',
            name: 'register',
            component:() => import('../pages/Register.vue'),
            meta: {
                layout: 'login',
                authenticated: true
            }
        }
    ],
})
