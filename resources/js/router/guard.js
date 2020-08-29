import { router } from "./index";
import { store } from "../store";

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiredAuth) && !store.getters.isAuth) {
        next({ path: '/login'})
    }
    if(to.matched.some(record => record.meta.authenticated) && store.getters.isAuth) {
        next({path: '/'})
    }
    next()
})

