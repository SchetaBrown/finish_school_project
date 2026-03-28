<script setup>
const props = defineProps(['olympiads', 'directions', 'statuses']);
import { router } from '@inertiajs/vue3';

import AppAdminLayout from '@layouts/AppAdminLayout.vue'
import BaseButton from '@buttons/BaseButton.vue'
import AdminOlympiadTable from '@tables/AdminOlympiadTable.vue'
import AdminOlympiadFilterForm from '@forms/admin/AdminOlympiadFilterForm.vue';

const createOlympiad = () => {
    router.get(route('admin.olympiad.create'));
}
</script>
<template>
    <AppAdminLayout>
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">Управление олимпиадами</h1>
            <BaseButton @click="createOlympiad" :text="'Добавить'" :icon="'fas fa-plus'"
                class="max-w-fit px-4 py-2 text-sm" />
        </div>
        <AdminOlympiadFilterForm :directions="directions.data" :statuses="statuses.data" />
        <AdminOlympiadTable :olympiads="olympiads.data" />
    </AppAdminLayout>
</template>
