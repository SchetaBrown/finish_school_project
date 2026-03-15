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
    // Получаем данные пользователя
    const user = userData?.value;

    // Если есть user_info - используем его
    if (user?.user_info) {
        const info = user.user_info;
        return {
            initial: `${info.surname?.[0] || ''}${info.name?.[0] || ''}`,
            fullName: `${info.surname || ''} ${info.name || ''}`.trim(),
            surname: info.surname || '',
            name: info.name || '',
            patronymic: info.patronymic || '',
            email: info.email || '',
            phone: info.phone || '',
        };
    }

    // Если user_info нет, но есть данные в самом user
    if (user) {
        return {
            initial: `${user.surname?.[0] || ''}${user.name?.[0] || ''}`,
            fullName: `${user.surname || ''} ${user.name || ''}`.trim(),
            surname: user.surname || '',
            name: user.name || '',
            patronymic: user.patronymic || '',
            email: user.email || '',
            phone: user.phone || '',
        };
    }

    return {
        initial: '',
        fullName: '',
        surname: '',
        name: '',
        patronymic: '',
        email: '',
        phone: '',
    };
});

provide('userData', userInfo.value)
</script>
<template>
    <slot></slot>
</template>
