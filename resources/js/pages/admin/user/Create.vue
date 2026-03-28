<script setup>
const props = defineProps(['roles']);
import AppAdminLayout from '@layouts/AppAdminLayout.vue'
import AdminCreateUserForm from '@forms/admin/create/AdminCreateUserForm.vue';
</script>
<template>
    <AppAdminLayout>
        <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-6">Создание нового пользователя</h1>
        <AdminCreateUserForm :roles="roles.data" />
    </AppAdminLayout>
</template>
