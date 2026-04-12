<script setup>
const props = defineProps(['directions']);
import { computed } from 'vue';
import TableContainer from '@other/TableContainer.vue';
import DestroyEntityModal from '@modals/DestroyEntityModal.vue'
import EditEducationDirectionModal from '@modals/edit/EditEducationDirectionModal.vue';
const ths = computed(() => ['Код', 'Название', 'Действие']);
</script>
<template>
    <TableContainer :ths="ths">
        <tr class="hover:bg-gray-50 transition" v-for="direction in directions" :key="direction.id">
            <td class="px-6 py-4">{{ direction.code }}</td>
            <td class="px-6 py-4">{{ direction.title }}</td>
            <td class="px-6 py-4">
                <EditEducationDirectionModal :title="direction.title" :code="direction.code" :id="direction.id" />
                <DestroyEntityModal href="admin.education.direction.destroy" :params="{ id: direction.id }" />
            </td>
        </tr>
    </TableContainer>
</template>
