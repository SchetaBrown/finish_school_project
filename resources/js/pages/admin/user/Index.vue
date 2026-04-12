<script setup>
const props = defineProps(['users', 'users_count', 'participants', 'participants_count', 'managers', 'managers_count', 'employees', 'roles', 'roles_for_create', 'employees_count']);
import AppAdminLayout from '@layouts/AppAdminLayout.vue'
import Container from '@other/Container.vue'
import AdminUserTable from '@tables/admin/AdminUserTable.vue';
import AdminUserFilterForm from '@forms/admin/filter/AdminUserFilterForm.vue';
import CreateUserModal from '@modals/create/CreateUserModal.vue';
import { computed } from 'vue';

const containersData = computed(() => [
    {
        subtitle: 'Всего пользователей',
        title: props.users_count,
    },
    {
        subtitle: 'Рабочих',
        title: props.employees_count,
    },
    {
        subtitle: 'Участников',
        title: props.participants_count,
    },
    {
        subtitle: 'Руководителей',
        title: props.managers_count,
    },
]);
</script>
<template>
    <AppAdminLayout>
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">Пользователи</h1>
            <CreateUserModal :roles="roles_for_create.data" />
        </div>
        <div class="grid grid-cols-4 gap-4 mb-8">
            <Container v-for="data in containersData">
                <p class="text-sm text-gray-400">{{ data.subtitle }}</p>
                <p class="text-2xl font-bold text-gray-900">{{ data.title }}</p>
            </Container>
        </div>
        <AdminUserFilterForm :roles="roles" />
        <AdminUserTable :users="users.data" />
        <Pagination :links="users.links" />
    </AppAdminLayout>
</template>
