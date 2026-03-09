import "../css/app.css";
import { createApp, h } from "vue";
import { createInertiaApp, Link } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "ziggy-js";
import { InertiaProgress } from "@inertiajs/progress";
import { createPinia } from "pinia";
import piniaPluginPersistedstate from "pinia-plugin-persistedstate";
import FlashMessage from "@other/FlashMessage.vue";

const appName = import.meta.env.VITE_APP_NAME || "EventHub";
InertiaProgress.init();

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./pages/${name}.vue`,
            import.meta.glob("./pages/**/*.vue"),
        ),
    setup({ el, App, props, plugin }) {
        const pinia = createPinia();
        pinia.use(piniaPluginPersistedstate);
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(pinia)
            .use(ZiggyVue)
            .component("Link", Link)
            .component("Flash", FlashMessage)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
