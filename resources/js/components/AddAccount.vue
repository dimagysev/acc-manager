<template>
    <div class="wrap">
        <span class="text-center">Add Account</span>
        <div class="wrap-content">
            <v-form
                ref="form"
                v-model="valid"
                lazy-validation
            >
                <v-text-field
                    v-model="login"
                    :rules="[v => !!v || 'Login is required']"
                    label="Login"
                    required
                ></v-text-field>

                <v-text-field
                    type="password"
                    v-model="password"
                    :rules="[v => !!v || 'Password is required']"
                    label="Password"
                    required
                ></v-text-field>

                <v-select
                    v-model="serviceId"
                    :items="services"
                    :rules="[v => !!v || 'Service is required']"
                    label="Service"
                    item-text="name"
                    item-value="id"
                    required
                ></v-select>

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

import { mapGetters, mapActions } from 'vuex';

export default {
    name: "AddAccount",
    data(){
        return {
            valid: true,
            login: '',
            password: '',
            serviceId: '',
        }
    },
    computed: mapGetters(['services']),
    methods: {
        ...mapActions(['createAccount']),
        add () {
            if (this.$refs.form.validate()){
                this.createAccount({
                    login: this.login,
                    password: this.password,
                    service_id: this.serviceId
                })
                this.reset()
            }
        },
        reset () {
            this.$refs.form.reset()
        }
    },
}
</script>

<style scoped lang="scss">
    .wrap {
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
