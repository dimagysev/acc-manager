<template>
    <v-card class="fill-height">
        <v-card-title class="d-flex justify-space-between">
            <span class="text-uppercase">Accounts List</span>
            <span>
                Service: {{ current | toUpperCase }}
            </span>
        </v-card-title>
        <v-card-text>
            <div v-if="accountsByService.length > 0" class="pass-item-wrapper custom-scroll">
                <account-item
                    v-for="account in accountsByService" :key="account.id"
                    :account="account"
                />
            </div>
            <span v-else>Password list is empty</span>
        </v-card-text>
    </v-card>
</template>

<script>

import AccountItem from "./AccountItem";
import { mapGetters } from 'vuex'

export default {
    name: "AccountsList",
    components: { AccountItem },
    filters: {
        toUpperCase(value) {
            return value.toUpperCase(value)
        }
    },
    computed: {
        ...mapGetters(['accountsByService', 'currentService']),
        current () {
            if (this.currentService === 'all'){
                return this.currentService
            }
            return this.currentService.name
        }
    }
}
</script>

<style scoped lang="scss">
    .pass-item-wrapper{
        overflow-y: auto;
        height:60vh;
        padding: 5px;
    }
</style>
