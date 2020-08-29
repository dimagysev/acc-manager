<template>
    <v-card @dblclick="editing = !editing" @click.stop="setCurrentService(service)">
        <v-card-text class="item d-flex justify-space-between" :class="{active: currentService.id === service.id}">
            <span v-if="!editing">
                <v-badge
                    :value="service.accounts_count > 0"
                    color="green"
                    :content="service.accounts_count"
                >
                    {{ service.name }}
                </v-badge>
            </span>
            <span v-else>
                <v-text-field
                    autofocus
                    @blur="cancelEdit"
                    @keyup.enter="doneEdit"
                    @keyup.esc="cancelEdit"
                    v-model="name"
                    class="mt-0 pt-0" />
            </span>
            <v-btn x-small color="error" @click.stop="deleteService(service.id)">
                <v-icon>mdi-delete</v-icon>
            </v-btn>
        </v-card-text>
    </v-card>
</template>

<script>
import { mapActions, mapMutations, mapGetters } from 'vuex'
export default {
    name: "ServiceItem",
    props: {
        service: {
            required: true,
            type: Object
        }
    },
    data () {
        return {
            editing: false,
            name: this.service.name
        }
    },
    computed: mapGetters(['currentService']),
    methods: {
        ...mapActions(['deleteService', 'updateService']),
        ...mapMutations(['setCurrentService']),
        cancelEdit(){
            this.name = this.service.name
            this.editing = false
        },
        doneEdit(){
            if (this.name.trim() === '' || this.name === this.service.name) {
                this.cancelEdit()
                return
            }
            this.editing= false
            this.updateService({
                id: this.service.id,
                name: this.name
            })
        }
    }
}
</script>

<style scoped>
    .item {
        cursor: pointer;
    }
    .active {
        background: #90CAF9;
    }
</style>
