<script setup>
import { computed } from 'vue';


const LINKS = computed(() => {
    return [
        {
            id: 1,
            icon: '',
            title: 'Пользователи',
            href: 'admin.user.index',
        },
        {
            id: 2,
            icon: '',
            title: 'Олимпиады',
            href: 'admin.olympiad.index',
        },
        {
            id: 3,
            icon: '',
            title: 'Учебные заведения',
            href: 'admin.school.index',
        },
    ];
});

</script>
<template>
    <aside class="p-6 h-full flex flex-col">
        <Link :href="route(link.href)"
            class="flex items-center space-x-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl transition"
            v-for="link in LINKS" :key="link.id">
        {{ link.title }}
        </Link>
    </aside>
</template>
