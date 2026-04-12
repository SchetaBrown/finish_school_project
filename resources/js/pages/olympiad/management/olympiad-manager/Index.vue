<script setup>
const props = defineProps(['orders', 'olympiad']);
import AppBaseLayout from '@layouts/AppBaseLayout.vue'
import { computed } from 'vue';
const orders = computed(() => {
    const propsOrders = props.orders.data;
    return propsOrders ? propsOrders : [];
});

const subtitle = computed(() => {
    return `Олимпиада: ${props.olympiad}`;
});
</script>
<template>
    <AppBaseLayout>
        <PageTitle title="Управление участниками олимпиады" :subtitle="subtitle" />
    </AppBaseLayout>
</template>
