<template>
    <v-app id="inspire" >
        <v-navigation-drawer v-model="drawer" disable-resize-watcher app>
            <div>
                <add-account style="margin-bottom: 3rem"/>
                <hr>
                <add-service style="margin-top: 3rem"/>
            </div>
        </v-navigation-drawer>

        <v-app-bar app color="indigo">
            <v-app-bar-nav-icon class="white--text" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title class="white--text text-uppercase">Account Manager</v-toolbar-title>
            <v-spacer></v-spacer>
            <span class="white--text text-uppercase">Logout</span>
            <v-btn icon @click="logout" class="white--text text-uppercase">
                <v-icon>mdi-exit-to-app</v-icon>
            </v-btn>

        </v-app-bar>

        <v-main>
            <v-container class="fill-height indigo lighten-5" fluid>
                <transition name="fade" mode="out-in">
                    <router-view/>
                </transition>
            </v-container>
        </v-main>
        <v-footer color="indigo" app>
            <span class="white--text">&copy; {{ new Date().getFullYear() }}</span>
        </v-footer>
    </v-app>
</template>

<script>

import AddAccount from "../components/AddAccount";
import AddService from "../components/AddService";

export default {
    name: "MainLayout",
    components: { AddAccount, AddService },
    data: () => ({
        drawer: false,
    }),
    methods:{
        logout(){
            this.$store.dispatch('logout').then(()=>this.$router.push('/login'))
        }
    }
}
</script>

<style scoped>

</style>
