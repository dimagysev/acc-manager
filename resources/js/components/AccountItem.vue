<template>
    <v-card>
        <v-card-text class="item">
            <v-text-field
                label="Login"
                v-model="login"
            ></v-text-field>
            <v-text-field
                v-model="password"
                :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                :type="show ? 'text' : 'password'"
                label="Password"
                @click:append="show = !show"
            ></v-text-field>
            <v-btn x-small color="error" @click="deleteHandler">Delete</v-btn>
            <transition name="fade" mode="out-in">
                <v-btn x-small color="accent" v-if="isChange" @click="updateHandler" >Update</v-btn>
            </transition>
            <transition name="fade" mode="out-in">
                <v-btn x-small color="secondary" v-if="isChange" @click="reset" >Reset</v-btn>
            </transition>
        </v-card-text>
    </v-card>
</template>

<script>
import { mapActions, mapMutations } from 'vuex'

export default {
    name: "AccountItem",
    props:{
        account:{
            type: Object,
            required: true
        }
    },
    data() {
        return {
            login: this.account.login,
            password: this.account.password,
            show: false,
        }
    },
    computed: {
        isChange () {
            return !(this.login === this.account.login && this.password === this.account.password)
        }
    },
    methods: {
        ...mapActions(['deleteAccount', 'updateAccount']),
        ...mapMutations(['stopLoading']),
        reset () {
            this.login = this.account.login
            this.password = this.account.password
        },
        updateHandler () {
            if (this.login.trim() === '' || this.password.trim() === '') {
                this.reset()
                return
            }
            if (!this.isChange) {
                return
            }
            this.updateAccount({
                id: this.account.id,
                login: this.login,
                password: this.password
            });
        },
        deleteHandler () {
            this.deleteAccount(this.account.id)
                .then(() => this.stopLoading())
        }
    }
}
</script>

