require("./bootstrap");
require("./script");

// Import modules...
import Vue from "vue";
import {
    App as InertiaApp,
    plugin as InertiaPlugin
} from "@inertiajs/inertia-vue";
import PortalVue from "portal-vue";

import { InertiaProgress } from "@inertiajs/progress";

InertiaProgress.init({
    delay: 250,
    color: "#29d",
    includeCSS: true,
    showSpinner: false
});

Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(PortalVue);

import { Lang } from "laravel-vue-lang";
Vue.use(Lang, {
    locale: lang,
    fallback: "en"
});

import VueMoment from "vue-moment";
import moment from "moment-timezone";
Vue.use(VueMoment, {
    moment
});

moment.tz.setDefault("Asia/Dhaka");

Vue.prototype.$route = route;

const app = document.getElementById("app");

new Vue({
    render: h =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: name =>
                    require(`./Pages/App/${name}`).default,
                resolveErrors: page => page.props.errors || {}
            }
        })
}).$mount(app);
