<script setup>
import { computed } from 'vue';
import Logotype from './Logotype.vue'


const LINKS = computed(() => {
    return [
        {
            id: 0,
            icon: '',
            title: 'Главная',
            href: 'admin.index',
        },
        {
            id: 1,
            icon: 'fa-users',
            title: 'Пользователи',
            href: 'admin.user.index',
        },
        {
            id: 2,
            icon: 'fa-trophy',
            title: 'Олимпиады',
            href: 'admin.olympiad.index',
        },
        {
            id: 3,
            icon: 'fa-university',
            title: 'Учебные заведения',
            href: 'admin.school.index',
        },
    ];
});

</script>
<template>
    <aside
        class="bg-white border-r border-gray-200 w-80 shrink-0 fixed lg:static inset-y-0 left-0 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-50 lg:z-0 overflow-y-auto custom-scroll min-h-full">
        <div class="p-6 h-full flex flex-col">
            <div class="hidden lg:flex items-center space-x-2 mb-8">
                <Logotype></Logotype>
            </div>
            <div class="flex-1 space-y-1">
                <Link :href="route(link.href)"
                    class="flex items-center space-x-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl transition"
                    v-for="link in LINKS" :key="link.id">
                <i class="w-5 text-center" :class="[
                    `fas ${link.icon}`
                ]"></i>
                <span>{{ link.title }}</span>
                </Link>
            </div>
            <div class="mt-auto pt-4 border-t border-gray-100">
                1
            </div>
        </div>
    </aside>
</template>
