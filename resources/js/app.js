import "../css/app.css";
import { createApp, h } from "vue";
import { createInertiaApp, Link } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "ziggy-js";
import { InertiaProgress } from "@inertiajs/progress";
import FlashMessage from "@other/FlashMessage.vue";
import DivideLine from '@other/DivideLine.vue'
import PageTitle from '@titles/PageTitle.vue'
import Container from '@other/Container.vue'
import Pagination from '@other/Pagination.vue'
import InputBlock from '@blocks/InputBlock.vue'
import SelectBlock from '@blocks/SelectBlock.vue'

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
            .component("FlashMessage", FlashMessage)
            .component('DivideLine', DivideLine)
            .component('PageTitle', PageTitle)
            .component('Container', Container)
            .component('Pagination', Pagination)
            .component('SelectBlock', SelectBlock)
            .component('InputBlock', InputBlock)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
