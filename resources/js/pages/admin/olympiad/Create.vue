<script setup>
const props = defineProps(['directions', 'olympiad_managers', 'types']);
import AppAdminLayout from '@layouts/AppAdminLayout.vue'
import AdminCreateOlympiadForm from '@forms/admin/create/AdminCreateOlympiadForm.vue';
import AdminCreateOlympiadDirectionForm from '@forms/admin/create/AdminCreateOlympiadDirectionForm.vue';
import PageTitle from '@titles/PageTitle.vue'
import SelectTabSectionV1 from '@sections/SelectTabSectionV1.vue';
import { computed, ref } from 'vue';
const buttons = computed(() => [
    {
        id: 1,
        text: 'Олимпиада',
        icon: 'fa-trophy',
    },
    {
        id: 2,
        text: 'Направление',
        icon: 'fa-tag',
    },
]);

const activeTab = ref(buttons.value[0].id);
</script>
<template>
    <AppAdminLayout>
        <PageTitle title="Создание олимпиады" subtitle="Заполните информацию о новой олимпиаде" />
        <SelectTabSectionV1 :buttons="buttons" @select-tab="(id) => {
            activeTab = id;
        }" />
        <AdminCreateOlympiadForm v-if="activeTab == 1" :directions="directions" :managers="olympiad_managers"
            :types="types" />
        <AdminCreateOlympiadDirectionForm v-if="activeTab == 2" />
    </AppAdminLayout>
</template>
