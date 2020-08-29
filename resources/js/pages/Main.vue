<template>
    <v-row class="fill-height">
        <loader v-if="loading"></loader>
        <v-col cols="12" sm="6" md="5" offset-md="1">
            <accounts-list/>
        </v-col>
        <v-col cols="12" sm="6" md="5">
            <service-list/>
        </v-col>
    </v-row>
</template>

<script>

import ServiceList from "../components/ServiceList";
import AccountsList from "../components/AccountsList";
import { mapActions } from 'vuex';
import Loader from "../components/loaders/Loader";

export default {
    name: "Main",
    data: ()=>({
        loading: true
    }),
    components: { ServiceList, AccountsList, Loader},
    methods: mapActions(['getServices', 'getAccounts']),
    mounted() {
        this.getServices()
            .then(()=>this.getAccounts())
            .then(()=> this.loading = false)
    }
}
</script>

