import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import { aliases, mdi } from "vuetify/iconsets/mdi-svg";

const deftheme = {
    colors: {
        primary:"#673AB7",
        secondary:"#424242",
        accent:"#8281FF"
    }
}

const vuetify = createVuetify({
    components,
    directives,
    theme: {
        defaultTheme: 'deftheme',
        themes: {
            deftheme
        },
    },
    icons: {
        defaultSet: 'mdi',
        aliases,
        sets: {
            mdi
        }
    }
})

export default vuetify;