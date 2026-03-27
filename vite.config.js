import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";
import vue from "@vitejs/plugin-vue";

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
            "@components": "/resources/js/components/ui", // Общие компоненты
            "@inputs": "/resources/js/components/ui/inputs", // Поля ввода
            "@sections": "/resources/js/components/ui/sections", // Секции
            "@forms": "/resources/js/components/ui/forms", // Формы
            "@selects": "/resources/js/components/ui/selects", // Списки
            "@buttons": "/resources/js/components/ui/buttons", // Кнопки
            "@titles": "/resources/js/components/ui/other/titles", // Заголовки
            "@blocks": "/resources/js/components/ui/blocks", // Блоки
            "@tables": "/resources/js/components/ui/tables", // Таблицы
            "@links": "/resources/js/components/ui/links", // Ссылки
            "@modals": "/resources/js/components/ui/modals/custom", // Модальные окна
            "@lists": "/resources/js/components/ui/lists", // Списки
            "@other": "/resources/js/components/ui/other", // Другое
            "@layouts": "/resources/js/layouts", // Шаблоны
            "@constants": "/resources/js/constants", // Константы
            "@composables": "/resources/js/composables", // Composable
        },
    },
});
