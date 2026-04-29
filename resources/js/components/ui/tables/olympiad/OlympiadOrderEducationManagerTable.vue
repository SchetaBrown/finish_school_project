<script setup>
const props = defineProps(["data", "olympiad"]);
import { computed } from "vue";
import RejectParticipantOrderModal from "@modals/RejectParticipantOrderModal.vue";
import TableContainer from "@other/TableContainer.vue";
import Status from "@other/Status.vue";
import NoData from "@other/NoData.vue";
import Pagination from "@other/Pagination.vue";
import { router, useForm } from "@inertiajs/vue3";

const ths = computed(() => [
    "Участник",
    "Контакты",
    "Учебное заведение",
    "Курс",
    "Дата заявки",
    "Участие в олимпиаде",
    "Статус",
    "Причина отклонения",
    "Документы",
    "Действия",
]);

const orders = computed(() => {
    return props.data.data ? props.data.data : [];
});

const updateSuccessOrder = (olympiad, id) => {
    router.patch(route("olympiad.student-orders.update", { olympiad, id }));
};

const updateParticipantStatus = (value, olympiad, id) => {
    if (value === '#') {
        return;
    }

    const form = useForm({
        'is_education_manager_accept': value,
    });

    console.log('Отправляем данные')

    form.patch(route("olympiad.student-orders.update", { olympiad, id }), {
        onSuccess: (message) => {
            console.log(message)
        }
    });
}
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
            <td class="px-6 py-4">{{ order.cours_number }}</td>
            <td class="px-6 py-4">Без данных</td>
            <td class="px-6 py-4">
                <select :value="order.is_education_manager_accept"
                    @change="(event) => updateParticipantStatus(event.target.value, olympiad, order.id)"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition flex flex-1 max-h-11">
                    <option :value="1">Да</option>
                    <option :value="0">Нет</option>
                </select>
            </td>
            <td class="px-6 py-4">
                <Status :status="order.status" font-size="12" />
            </td>
            <td class="px-6 py-4">
                {{ order.reject_message ? order.reject_message : "-" }}
            </td>
            <td class="px-6 py-4">
                <div v-for="document in order.documents" :key="document.id">
                    <a :href="route('olympiad.student-orders.download', { olympiad, id: document.id, })" download>
                        Скачать {{ document.type }}
                    </a>
                </div>
            </td>
            <td class=" px-6 py-4 space-x-2">
                <button @click="updateSuccessOrder(olympiad, order.id)"
                    class="confirm-btn text-green-600 rounded-lg transition">
                    <i class="fas fa-check"></i>
                </button>
                <RejectParticipantOrderModal icon="fa-trash" :olympiad="olympiad" :id="order.id" />
            </td>
        </tr>
    </TableContainer>
    <Pagination v-if="orders.length > 0" :links="data.links" />
    <NoData v-else />
</template>
