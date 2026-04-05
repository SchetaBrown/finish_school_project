<script setup>
const props = defineProps(['schools']);
import { computed } from 'vue';
import { router } from '@inertiajs/vue3';
import AppAdminLayout from '@layouts/AppAdminLayout.vue'
import AdminEducationSchoolTable from '@tables/AdminEducationSchoolTable.vue';
import AdminEducationSchoolForm from '@forms/admin/filter/AdminEducationSchoolForm.vue';
import BaseButton from '@buttons/BaseButton.vue'

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
            <BaseButton text="Добавить" @click="router.get(route('admin.education.school.create'))"
                :icon="'fas fa-plus'" />
        </div>
        <AdminEducationSchoolForm />
        <AdminEducationSchoolTable :schools="schools" />
        <Pagination :links="links" />
    </AppAdminLayout>
</template>
