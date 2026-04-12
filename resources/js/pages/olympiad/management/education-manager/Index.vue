<script setup>
const props = defineProps(['orders', 'olympiad']);
import AppBaseLayout from '@layouts/AppBaseLayout.vue'
import OlympiadOrderEducationManagerTable from '@tables/olympiad/OlympiadOrderEducationManagerTable.vue';
</script>
<template>
    <AppBaseLayout>
        <PageTitle title="Заявки участников" subtitle="Участники, которые выбрали вас руководителем" />
        <OlympiadOrderEducationManagerTable :data="orders" :olympiad="olympiad" />
    </AppBaseLayout>
</template>
