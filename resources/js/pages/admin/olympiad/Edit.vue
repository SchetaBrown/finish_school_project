<script setup>
const props = defineProps(['directions', 'olympiad_managers', 'types', 'olympiad']);
import AppAdminLayout from '@layouts/AppAdminLayout.vue'
import AdminEditOlympiadForm from '@forms/admin/edit/AdminEditOlympiadForm.vue';
import PageTitle from '@titles/PageTitle.vue'
</script>
<template>
    <AppAdminLayout>
        <PageTitle title="Редактирование олимпиады" subtitle="Заполните информацию о новой олимпиаде" />
        <AdminEditOlympiadForm :directions="directions" :managers="olympiad_managers" :types="types"
            :olympiad="olympiad.data" />
    </AppAdminLayout>
</template>
