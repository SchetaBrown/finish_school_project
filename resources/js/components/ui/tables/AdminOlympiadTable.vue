<script setup>
import { computed } from 'vue';
import Status from '@other/Status.vue'
import TableContainer from '@other/TableContainer.vue';

const props = defineProps(['olympiads', 'olympiads_count']);
const ths = computed(() => ['Название', 'Статус', 'Направление', 'Действия']);
</script>
<template>
    <TableContainer :ths="ths">
        <tr class="hover:bg-gray-50 transition" v-for="olympiad in olympiads" :key="olympiad.title">
            <td class="px-6 py-4">{{ olympiad.title }}</td>
            <td class="px-6 py-4">
                <Status :status="olympiad.status" font-size="12" />
            </td>
            <td class="px-6 py-4">{{ olympiad.direction }}</td>
            <td class="px-6 py-4">
                <Link class="text-indigo-600 mr-3">
                <i class="fas fa-edit"></i>
                </Link>
            </td>
        </tr>
    </TableContainer>
</template>
