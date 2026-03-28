<script setup>
import { computed } from 'vue';
const ths = computed(() => ['Название', 'ИНН', 'Телефон', 'Директор', 'Город']);
import TableContainer from '../other/TableContainer.vue';
</script>
<template>
    <TableContainer :ths="ths">

    </TableContainer>
</template>
