<script setup>
import { computed, inject } from 'vue';
import Container from '@other/Container.vue'
import DivideLine from '@other/DivideLine.vue'

const userData = inject('userData');

const userInitial = computed(() => {
    return `${userData?.user_info?.surname[0]}${userData?.user_info?.name[0]}`
});

const userFullName = computed(() => {
    return `${userData?.user_info?.name} ${userData?.user_info?.surname}`;
});

const userRoles = computed(() => {
    const roles = userData.roles;
    if (typeof roles === 'object') {
        const newRoles = roles.map((role) => {
            return `${role[0].toUpperCase()}${role.slice(1)}`;
        });

        return newRoles.join(', ');
    }

    return roles;
});

const userInfo = computed(() => {
    return [
        {
            icon: 'fa-envelope',
            title: userData.email,
        },
        {
            icon: 'fa-phone',
            title: userData.phone,
        },
    ];
});
</script>
<template>
    <aside class="lg:col-span-1">
        <Container class="sticky">
            <div class="text-center mb-6">
                <div class="w-24 h-24 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-indigo-600 font-medium text-3xl">
                        {{ userData.initial }}
                    </span>
                </div>
                <h2 class="text-xl font-semibold text-gray-900">
                    {{ userData.fullName }}
                </h2>
                <p class="text-sm text-gray-500">{{ userRoles }}</p>
            </div>
            <DivideLine></DivideLine>
            <div class="flex flex-col gap-3 text-sm">
                <div class="flex items-center space-x-3" v-for="info in userInfo" :key="info.title">
                    <i v-if="info.icon" class="text-gray-400 w-4" :class="[
                        `fas ${info.icon}`
                    ]"></i>
                    <span class="text-gray-600">{{ info.title }}</span>
                </div>
            </div>
            <div class="w-full mt-6">
                <Link class="w-full bg-indigo-50 hover:bg-indigo-100 text-indigo-600 py-2 px-4 rounded-lg">
                <i class="fas fa-edit mr-2" />
                Редактировать профиль
                </Link>
            </div>
        </Container>
    </aside>
</template>
