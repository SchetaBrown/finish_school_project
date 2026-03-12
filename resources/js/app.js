import "../css/app.css";
import { createApp, h } from "vue";
import { createInertiaApp, Link } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { YandexSmartCaptcha } from '@gladesinger/vue3-yandex-smartcaptcha'
import { ZiggyVue } from "ziggy-js";
import { InertiaProgress } from "@inertiajs/progress";
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
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component("Link", Link)
            .component("Flash", FlashMessage)
            .component('Captcha', YandexSmartCaptcha)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
