<template>
    <v-card class="elevation-12">
        <v-toolbar
            color="primary"
            flat
        >
            <v-toolbar-title class="white--text text-uppercase">Login form</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text>
            <v-form ref="form">
                <v-text-field
                    label="Email"
                    name="email"
                    prepend-icon="mdi-account"
                    type="email"
                    v-model="email"
                ></v-text-field>

                <v-text-field
                    id="password"
                    label="Password"
                    name="password"
                    prepend-icon="mdi-lock"
                    type="password"
                    v-model="password"
                ></v-text-field>
            </v-form>
        </v-card-text>
        <v-card-actions class="justify-center">
            <v-btn color="primary" @click="login">Login</v-btn>
            <v-spacer></v-spacer>
            <v-btn color="secondary" @click="$router.push('/register')">SingUp</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>

export default {
    name: "Login",
    data () {
        return {
            email: '',
            password: ''
        }
    },
    methods: {
        login () {
            this.$store.dispatch('login',{
                email: this.email,
                password: this.password
            }).then(() => {
                this.$router.push('/')
            })
        }
    }
}
</script>

