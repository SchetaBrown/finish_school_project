<script setup>
const props = defineProps(['orders', 'links']);
import { computed, ref } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import SelectTabSectionV2 from '../SelectTabSectionV2.vue';
import ShowOlympiadOrderModal from '@modals/show/ShowOlympiadOrderModal.vue';
import RejectParticipantOrderModal from '@modals/RejectParticipantOrderModal.vue';
import Status from '@other/Status.vue'

const buttons = computed(() => [
    {
        id: 1,
        text: 'Заявки студентов',
        icon: '',
    },
]);

const activeTab = ref(buttons.value[0].id);

const form = useForm({
    reject_message: null,
});

const updateSuccessOrder = (olympiad, id) => {
    router.patch(route('olympiad.student-orders.update', { olympiad, id }));
}
</script>
<template>
    <section class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <SelectTabSectionV2 :buttons="buttons" @select-tab="(id) => {
            activeTab = id
        }" />
        <div class="p-6">
            <div class="p-5 hover:bg-gray-50 transition" v-for="order in orders">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <Status :status="order.olympiad.status" font-size="12" />
                            <Status :status="order.status" font-size="12" />
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-1">{{ order.olympiad.title }}</h3>
                        <div class="flex items-start space-x-2 text-sm text-gray-600 mt-2">
                            <i class="fas fa-user text-gray-400 mt-0.5"></i>
                            <span>{{ order.full_name }}</span>
                        </div>
                        <div class="flex items-start space-x-2 text-sm text-gray-600 mt-2">
                            <i class="fas fa-envelope text-gray-400 mt-0.5"></i>
                            <span>{{ order.email }}</span>
                        </div>
                        <div class="flex items-start space-x-2 text-sm text-gray-600 mt-2">
                            <i class="fas fa-phone text-gray-400 mt-0.5"></i>
                            <span>{{ order.phone }}</span>
                        </div>
                        <div class="flex items-start space-x-2 text-sm text-gray-600 mt-2">
                            <i class="fas fa-graduation-cap text-gray-400 mt-0.5"></i>
                            <span>{{ order.school }}</span>
                        </div>
                        <div class="flex items-start space-x-2 text-sm text-gray-600 mt-2">
                            <i class="far fa-calendar text-gray-400 mt-0.5"></i>
                            <span>Дата заявки: Нет данных</span>
                        </div>
                        <div class="mt-2 p-2 bg-red-50 rounded-lg w-full" v-if="order.reject_message">
                            <div class="flex items-start space-x-2 w-full">
                                <i class="fas fa-info-circle text-red-400 text-xs mt-0.5"></i>
                                <p class="text-xs text-red-600">Причина отклонения: {{ order.reject_message }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button type="button" @click="updateSuccessOrder(order?.olympiad?.slug, order.id)"
                            class="accept-btn px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition">
                            <i class="fas fa-check mr-1"></i>
                            Принять
                        </button>
                        <RejectParticipantOrderModal :reject="true" :olympiad="order?.olympiad?.slug" :id="order.id" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <Pagination v-if="activeTab === buttons[0].id && links" :links="links" />
</template>
