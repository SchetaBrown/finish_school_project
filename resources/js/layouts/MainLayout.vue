<script setup>
import { usePage } from "@inertiajs/vue3";
import { computed, provide } from "vue";
const page = usePage();

const userData = computed(() => {
    const authData = page.props.auth;
    const authStatus = authData?.isAuthenticated;
    const userData = authData?.user?.data;

    return authStatus ? userData : {};
});

const userInfo = computed(() => {
    const user = userData?.value;

    if (user?.user_info) {
        const info = user;
        return {
            initial: `${info.user_info.surname?.[0] || ''}${info.user_info.name?.[0] || ''}`,
            fullName: `${info.user_info.surname || ''} ${info.user_info.name || ''}`.trim(),
            surname: info.user_info.surname || '',
            name: info.user_info.name || '',
            patronymic: info.user_info.patronymic || '',
            email: info.user_info.email || '',
            phone: info.user_info.phone || '',
            birthDate: info.birth_date || '',
            school: info.school.short_name || '',
            role: info.user_info.role || '',
        };
    }

    if (user) {
        return {
            initial: `${user.surname?.[0] || ''}${user.name?.[0] || ''}`,
            fullName: `${user.surname || ''} ${user.name || ''}`.trim(),
            surname: user.surname || '',
            name: user.name || '',
            patronymic: user.patronymic || '',
            email: user.email || '',
            phone: user.phone || '',
            role: user.role || '',
        };
    }
});

provide('userData', userInfo.value)
</script>
<template>
    <slot></slot>
</template>
