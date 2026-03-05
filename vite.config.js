import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";
import vue from "@vitejs/plugin-vue";
import { fileURLToPath } from "url";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/js/app.js", "resources/css/app.css"],
            refresh: true,
        }),
        tailwindcss(),
        vue(),
    ],
    server: {
        watch: {
            ignored: ["**/storage/framework/views/**"],
        },
    },
    resolve: {
        alias: {
            "@components": "/resources/js/components/ui",
            "@inputs": "/resources/js/components/ui/inputs",
            "@sections": "/resources/js/components/ui/sections",
            "@forms": "/resources/js/components/ui/forms",
            "@selects": "/resources/js/components/ui/selects",
            "@buttons": "/resources/js/components/ui/buttons",
            "@titles": "/resources/js/components/ui/other/titles",
            "@blocks": "/resources/js/components/ui/blocks",
            "@links": "/resources/js/components/ui/links",
            "@layouts": "/resources/js/layouts",
            "@constants": "/resources/js/constants",
        },
    },
});
