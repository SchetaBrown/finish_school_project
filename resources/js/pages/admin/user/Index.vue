<script setup>
const PROPS = defineProps(['users', 'users_count']);
import AppAdminLayout from '@layouts/AppAdminLayout.vue'
import BaseButton from '@buttons/BaseButton.vue'
import Container from '@other/Container.vue'
import AdminUserFilterForm from '@forms/admin/AdminUserFilterForm.vue';
</script>
<template>
    <AppAdminLayout>
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">Пользователи</h1>
            <BaseButton :text="'Добавить'" :icon="'fas fa-plus'" class="max-w-fit px-4 py-2 text-sm" />
        </div>
        <div class="grid grid-cols-4 gap-4 mb-8">
            <Container />
            <Container />
            <Container />
        </div>
        <AdminUserFilterForm />
    </AppAdminLayout>
</template>
