<template>
    <div class="wrap">
        <span class="text-center">Add Service</span>
        <div class="wrap-content">
            <v-form
                ref="form"
                v-model="valid"
                @submit.prevent="add"
                lazy-validation
            >
                <v-text-field
                    v-model="service"
                    :rules="[v => !!v || 'Name is required']"
                    label="Service"
                    required
                ></v-text-field>

                <v-btn
                    :disabled="!valid"
                    color="success"
                    class="mr-4"
                    x-small
                    @click="add"
                >
                    Add
                </v-btn>

                <v-btn
                    color="error"
                    class="mr-4"
                    @click="reset"
                    x-small
                >
                    Reset Form
                </v-btn>

            </v-form>
        </div>
    </div>
</template>

<script>

import { mapActions } from 'vuex'

export default {
    name: "AddService",
    data(){
        return{
            valid: true,
            service: ''
        }
    },
    methods: {
        ...mapActions(['createService']),
        add () {
            if (this.$refs.form.validate()){
                this.createService({ name: this.service })
                this.reset()
            }
        },
        reset () {
            this.$refs.form.reset()
        },
    },
}
</script>

<style scoped lang="scss">
.wrap {
    margin-top:25px;

    & span{
        display: block;
        font-size: 1.5rem;
        width: 100%;
        padding: 5px;
        border-bottom: 1px solid #cccccc;
    }
    & .wrap-content{
        padding: 5px;
    }
}
</style>
