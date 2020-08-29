<template>
    <div>
        <component :is="layout">
        </component>
    </div>
</template>

<script>

import LoginLayout from "./layouts/LoginLayout";
import MainLayout from "./layouts/MainLayout";

export default {
    name: "App",
    components: {LoginLayout, MainLayout},
    computed:{
        error () {
            return this.$store.getters.error
        },
        layout(){
            return (this.$route.meta.layout || 'login') + '-layout'
        }
    },
    watch: {
        async error(error) {
            if (error){
                this.$toast.error(await this.$store.dispatch('parseError', error), {
                    position:'top-right',
                })
            }
            this.$store.commit('clearError')
        }
    }
}
</script>

<style>
    .slide-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-fade-leave-active {
        transition: all .3s ease-in-out;
    }
    .slide-fade-leave-to {
        transform: translateX(50vw);
        opacity: 0;
    }
    .slide-fade-enter{
        transform: translateX(-50vw);
        opacity: 0;
    }

</style>
