<script setup>
const props = defineProps(['cities', 'directions']);
import AppAdminLayout from '@layouts/AppAdminLayout.vue'
import AdminCreateEducationSchoolForm from '@forms/admin/create/AdminCreateEducationSchoolForm.vue';
import PageTitle from '@titles/PageTitle.vue'
</script>
<template>
    <AppAdminLayout>
        <PageTitle title="Создание учебного заведения" subtitle="Заполните информацию о новом учебном заведении" />
        <AdminCreateEducationSchoolForm :cities="cities.data" :directions="directions.data" />
    </AppAdminLayout>
</template>
