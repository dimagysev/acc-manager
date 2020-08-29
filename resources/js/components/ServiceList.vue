<template>
    <v-card class="fill-height">
        <v-card-title class="d-flex justify-space-between">
            <span>Service List</span>
            <v-btn small color="primary" @click="setCurrentService('all')">All</v-btn>
        </v-card-title>
        <v-card-text>
            <div v-if="services.length > 0" class="pass-item-wrapper custom-scroll">
                <transition-group name="fade">
                    <service-item
                        v-for="service in services" :key="service.id"
                        :service="service"
                    />
                </transition-group>
            </div>
            <span v-else>Service list is empty</span>
        </v-card-text>
    </v-card>
</template>

<script>

import ServiceItem from "./ServiceItem";
import { mapGetters, mapMutations } from 'vuex';

export default {
    name: "ServiceList",
    components: { ServiceItem },
    computed: mapGetters(['services']),
    methods:mapMutations(['setCurrentService'])

}
</script>

<style scoped lang="scss">
    .pass-item-wrapper{
        overflow-y: auto;
        height:60vh;
        padding: 5px;
    }
</style>
