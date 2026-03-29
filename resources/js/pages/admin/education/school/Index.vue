<script setup>
const props = defineProps(['schools']);
import AppAdminLayout from '@layouts/AppAdminLayout.vue'
import AdminEducationSchoolTable from '@tables/AdminEducationSchoolTable.vue';
import BaseButton from '@buttons/BaseButton.vue'
import { computed } from 'vue';

const schools = computed(() => {
    return props.schools?.data;
});

const links = computed(() => {
    return props.schools?.links;
});
</script>
<template>
    <AppAdminLayout>
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">Учебные заведения</h1>
            <BaseButton :text="'Добавить'" :icon="'fas fa-plus'" class="max-w-fit px-4 py-2 text-sm" />
        </div>
        <AdminEducationSchoolTable :schools="schools" />
        <Pagination :links="links" />
    </AppAdminLayout>
</template>
