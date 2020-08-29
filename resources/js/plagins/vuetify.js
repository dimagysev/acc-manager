import Vue from 'vue'
import Vuetify from 'vuetify'
import colors from 'vuetify/lib/util/colors'

Vue.use(Vuetify)

export const vuetify = new Vuetify({
    theme: {
        themes: {
            light: {
                primary: colors.blue.darken1, // #E53935
                secondary: colors.green.lighten1, // #FFCDD2
                accent: colors.indigo.base, // #3F51B5
            },

        },
        dark: false
    },
})
