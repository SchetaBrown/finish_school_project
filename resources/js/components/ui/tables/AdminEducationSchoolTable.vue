<script setup>
const props = defineProps(['schools']);
import { computed } from 'vue';
import TableContainer from '@other/TableContainer.vue';
const ths = computed(() => ['Название', 'ИНН', 'Телефон', 'Директор', 'Город', 'Действия']);
</script>
<template>
    <TableContainer :ths="ths">
        <tr class="hover:bg-gray-50 transition" v-for="school in schools" :key="school.short_name">
            <td class="px-6 py-4">{{ school.short_name }}</td>
            <td class="px-6 py-4">{{ school.inn }}</td>
            <td class="px-6 py-4">{{ school.phone }}</td>
            <td class="px-6 py-4">{{ school.director }}</td>
            <td class="px-6 py-4">{{ school.city }}</td>
            <td class="px-6 py-4">
                <Link class="text-indigo-600 mr-3">
                <i class="fas fa-edit"></i>
                </Link>
            </td>
        </tr>
    </TableContainer>
</template>
