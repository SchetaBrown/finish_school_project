<script setup>
const props = defineProps(['olympiad_orders', 'olympiad']);
import { router, usePage } from "@inertiajs/vue3";
import { computed, inject, ref, watch } from "vue";
import TableContainer from "@other/TableContainer.vue";
import BaseSelect from "@selects/BaseSelect.vue";
import Status from "@other/Status.vue";

const page = usePage();

const ths = computed(() => [
    "Место",
    "Баллы",
    "Полное имя участника",
    "Курс",
    "Статус заявки",
]);

const selectOptions = computed(() => [
    {
        id: '10',
        title: '10',
    },
    {
        id: '15',
        title: '15',
    },
    {
        id: '20',
        title: '20',
    },
]);

const sendSelectValue = (value) => {
    router.get(route('olympiad.show', {
        olympiad: props.olympiad,
        per_page: value
    }));
}

</script>
<template>
    <div class="flex justify-between items-center">
        <PageTitle title="Список участников" />
        <div class="flex items-center gap-2">
            <span class="text-[#6A7282] text-sm">Количество участников</span>
            <BaseSelect @select-value="sendSelectValue" :options="selectOptions" class="max-w-fit" />
        </div>
    </div>
    <TableContainer :ths="ths" v-if="page.props.auth.isAuthenticated">
        <tr class="hover:bg-gray-50 transition" v-for="(order, index) in olympiad_orders.data" :key="order.id"
            v-if="olympiad_orders.data && olympiad_orders.data.length > 0">
            <td class="px-6 py-4">
                {{ index }}
            </td>
            <td class="px-6 py-4">
                {{ order.score }}
            </td>
            <td class="px-6 py-4">
                {{ order.user_info.full_name }}
            </td>
            <td class="px-6 py-4">
                {{ order.participant_info.cours_number }}
            </td>
            <td class="px-6 py-4">
                <Status :status="order.status" font-size="12" />
            </td>
        </tr>
        <tr v-else class="flex justify-center text-gray-600 my-4">
            Данных нет
        </tr>
    </TableContainer>
    <Pagination v-if="page.props.auth.isAuthenticated" :links="olympiad_orders.links" />
    <div v-if="!page.props.auth.isAuthenticated" class="flex justify-center text-gray-600 my-4">
        Для просмотра информации об участниках олимпиады, войдите в систему
    </div>
</template>
