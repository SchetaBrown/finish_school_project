<script setup>
const props = defineProps(['orders', 'olympiad']);
import { computed } from 'vue';
import AppBaseLayout from '@layouts/AppBaseLayout.vue'
import OlympiadTeam from '@blocks/olympiad/components/OlympiadTeam.vue';

const subtitle = computed(() => {
    return `Олимпиада: ${props.olympiad}`;
});
</script>
<template>
    <AppBaseLayout>
        <PageTitle title="Управление участниками олимпиады" :subtitle="subtitle" />
        <div class="flex flex-col gap-2">
            <OlympiadTeam v-for="order in orders" :school="order.school.data" :manager="order.manager.data"
                :orders="order.orders" />
        </div>
    </AppBaseLayout>
</template>
