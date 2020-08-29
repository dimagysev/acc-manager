<template>
    <v-card class="elevation-12">
        <v-toolbar
            color="primary"
            flat
        >
            <v-toolbar-title class="white--text text-uppercase">Register form</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text>
            <v-form>
                <v-text-field
                    label="Name"
                    name="name"
                    prepend-icon="mdi-account"
                    type="text"
                    v-model="name"
                ></v-text-field>

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
        <v-card-actions>
            <v-btn color="primary" @click="register">SingUp</v-btn>
            <v-spacer></v-spacer>
            <v-btn color="secondary" @click="$router.push('/login')">LogIn</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>

export default {
    name: "Register",
    data () {
        return {
            name: '',
            email: '',
            password: ''
        }
    },
    methods: {
        register () {
            this.$store.dispatch('register',{
                name: this.name,
                email: this.email,
                password: this.password
            })
            .then(() => this.$router.push('/'))
        }
    }
}
</script>

