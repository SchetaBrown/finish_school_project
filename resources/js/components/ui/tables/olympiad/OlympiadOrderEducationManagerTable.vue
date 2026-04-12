<script setup>
const props = defineProps(['data', 'olympiad']);
import { computed } from 'vue';
import RejectParticipantOrderModal from '@modals/RejectParticipantOrderModal.vue';
import TableContainer from '@other/TableContainer.vue';
import Status from '@other/Status.vue';
import NoData from '@other/NoData.vue'
const ths = computed(() => ['Участник', 'Контакты', 'Учебное заведение', 'Курс', 'Дата заявки', 'Статус', 'Документы', 'Действия']);

const orders = computed(() => {
    return props.data.data ? props.data.data : [];
});
</script>
<template>
    <TableContainer :ths="ths" v-if="orders.length > 0">
        <tr class="hover:bg-gray-50 transition" v-for="order in orders" :key="order.id">
            <td class="px-6 py-4">
                <div>
                    <p class="font-medium text-gray-900">{{ order.full_name }}</p>
                    <p class="text-xs text-gray-400">{{ order.email }}</p>
                </div>
            </td>
            <td class="px-6 py-4">{{ order.phone }}</td>
            <td class="px-6 py-4">{{ order.school }}</td>
            <td class="px-6 py-4">{{ order.cours_number }} курс</td>
            <td class="px-6 py-4">Без данных</td>
            <td class="px-6 py-4">
                <Status :status="order.status" />
            </td>
            <td class="px-6 py-4">
                <div v-for="document in order.documents">
                    <button
                        @click="$inertia.get(route('olympiad.student-orders.download', { olympiad, id: document.id }))">Скачать
                        {{ document.type }}</button>
                </div>
            </td>
            <td class="px-6 py-4">
                <RejectParticipantOrderModal icon="fa-times" :olympiad="olympiad" :id="order.id" />
            </td>
        </tr>
    </TableContainer>
    <Pagination v-if="orders.length > 0" :links="data.links" />
    <NoData v-else />
</template>
