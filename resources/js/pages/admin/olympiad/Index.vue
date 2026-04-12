<script setup>
import { router } from '@inertiajs/vue3';
const props = defineProps(['olympiads', 'directions', 'statuses']);

import AppAdminLayout from '@layouts/AppAdminLayout.vue'
import AdminOlympiadTable from '@tables/admin/AdminOlympiadTable.vue'
import AdminOlympiadFilterForm from '@forms/admin/filter/AdminOlympiadFilterForm.vue';
import BaseButton from '@buttons/BaseButton.vue'
</script>
<template>
    <AppAdminLayout>
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">Олимпиады</h1>
            <BaseButton type="button" @click="router.get(route('admin.olympiad.create'))" text="Добавить"
                icon="fas fa-plus" />
        </div>
        <AdminOlympiadFilterForm :directions="directions.data" :statuses="statuses.data" />
        <AdminOlympiadTable :olympiads="olympiads.data" />
        <Pagination :links="olympiads.links" />
    </AppAdminLayout>
</template>
