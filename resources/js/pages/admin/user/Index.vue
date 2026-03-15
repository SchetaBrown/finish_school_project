<script setup>
import AppAdminLayout from '@layouts/AppAdminLayout.vue'
import PageTitle from '@titles/PageTitle.vue'
import BaseButton from '@buttons/BaseButton.vue'
import Container from '@other/Container.vue'
import AdminUserFilterSection from '@sections/filter/AdminUserFilterSection.vue';
</script>
<template>
    <AppAdminLayout>
        <div class="flex items-center justify-between mb-6">
            <PageTitle :title="'Пользователи'" />
            <BaseButton :text="'Добавить'" :icon="'fas fa-plus'" class="max-w-fit px-4 py-2 text-sm" />
        </div>
        <div class="grid grid-cols-4 gap-4 mb-8">
            <Container />
            <Container />
            <Container />
            <Container />   
        </div>
        <AdminUserFilterSection />
    </AppAdminLayout>
</template>
