<script setup>
const props = defineProps(['directions']);
import { computed } from 'vue';
import AppAdminLayout from '@layouts/AppAdminLayout.vue'
import AdminEducationDirectionTable from '@tables/admin/AdminEducationDirectionTable.vue';
import AdminEducationDirectionFilterForm from '@forms/admin/filter/AdminEducationDirectionFilterForm.vue';
import CreateEducationDirectionModal from '@modals/create/CreateEducationDirectionModal.vue'

const links = computed(() => {
    return props.directions?.links;
});
</script>
<template>
    <AppAdminLayout>
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">Учебные направления</h1>
            <CreateEducationDirectionModal />
        </div>
        <AdminEducationDirectionFilterForm />
        <AdminEducationDirectionTable :directions="directions.data" />
        <Pagination :links="links" />
    </AppAdminLayout>
</template>
