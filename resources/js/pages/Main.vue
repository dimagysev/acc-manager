<template>
    <v-row class="fill-height">
        <loader v-if="isLoading"></loader>
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
import { mapActions, mapGetters, mapMutations } from 'vuex';
import Loader from "../components/loaders/Loader";

export default {
    name: "Main",
    components: { ServiceList, AccountsList, Loader},
    computed: mapGetters(['isLoading']),
    methods: {
        ...mapActions(['getServices', 'getAccounts']),
        ...mapMutations(['startLoading', 'stopLoading'])

    },
    mounted() {
        this.getServices()
            .then(()=>this.getAccounts())
            .then(()=> this.stopLoading())
            .catch(e=>{})
    }
}
</script>

