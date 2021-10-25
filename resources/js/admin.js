require("./bootstrap");

// Import modules...
import Vue from "vue";
import {
    App as InertiaApp,
    plugin as InertiaPlugin
} from "@inertiajs/inertia-vue";
import PortalVue from "portal-vue";

import { InertiaProgress } from "@inertiajs/progress";

Vue.use(require("vue-moment"));

InertiaProgress.init({
    delay: 250,
    color: "#29d",
    includeCSS: true,
    showSpinner: false
});

import { Lang } from "laravel-vue-lang";

Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(PortalVue);

// Register the plugin
Vue.use(Lang, {
    locale: "en",
    fallback: "en",
    ignore: {
        fr: ["validation"]
    }
});

Vue.prototype.$route = route;

const app = document.getElementById("app");

new Vue({
    render: h =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: name =>
                    require(`./Pages/Admin/${name}`).default,
                resolveErrors: page => page.props.errors || {}
            }
        })
}).$mount(app);
