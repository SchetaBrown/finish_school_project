<script setup>
const props = defineProps(['orders', 'olympiad', 'statuses']);
import AppBaseLayout from '@layouts/AppBaseLayout.vue'
import OlympiadOrderEducationManagerTable from '@tables/olympiad/OlympiadOrderEducationManagerTable.vue';
import EducationManagerFilterForm from '@forms/olympiad/EducationManagerFilterForm.vue';
</script>
<template>
    <AppBaseLayout>
        <PageTitle title="Заявки участников" subtitle="Участники, которые выбрали вас руководителем" />
        <EducationManagerFilterForm :statuses="statuses.data" :slug="olympiad" />
        <OlympiadOrderEducationManagerTable :data="orders" :olympiad="olympiad" />
    </AppBaseLayout>
</template>
