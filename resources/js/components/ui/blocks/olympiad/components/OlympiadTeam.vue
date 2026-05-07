<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import Status from '@other/Status.vue';
import RejectParticipantOrderModal from '@modals/RejectParticipantOrderModal.vue';

const props = defineProps(['school', 'manager', 'orders', 'olympiad']);

const isOpen = ref(false);

const acceptOrder = (orderId) => {

}
</script>

<template>
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div @click="isOpen = !isOpen"
            class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50 transition">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-school text-indigo-600"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">{{ school?.short_name || 'Школа' }}</h3>
                    <p class="text-sm text-gray-500">Руководитель: {{ manager?.user_info?.full_name || '—' }}</p>
                </div>
            </div>
            <i :class="['fas fa-chevron-down text-gray-400 transition-transform', { 'rotate-180': isOpen }]"></i>
        </div>

        <div v-show="isOpen" class="border-t border-gray-100 p-4">
            <!-- Информация о руководителе -->
            <div class="mb-4 pb-3 border-b border-gray-100">
                <h4 class="text-sm font-semibold text-gray-700 mb-2">Информация о руководителе</h4>
                <div class="space-y-2 text-sm">
                    <p><i class="fas fa-building w-5 text-gray-400"></i> {{ manager?.school?.short_name || '—' }}</p>
                    <p><i class="fas fa-envelope w-5 text-gray-400"></i> {{ manager?.user_info?.email || '—' }}</p>
                    <p><i class="fas fa-phone w-5 text-gray-400"></i> {{ manager?.user_info.phone || '—' }}</p>
                </div>
            </div>

            <!-- Список заявок участников -->
            <div v-if="orders?.length" class="mt-2">
                <p class="text-sm font-medium text-gray-700 mb-3">Заявки участников ({{ orders.length }})</p>
                <div class="space-y-4">
                    <div v-for="order in orders" :key="order.data.id" class="border border-gray-100 rounded-lg p-4">
                        <!-- Информация об участнике -->
                        <div class="mb-3">
                            <div class="flex justify-between items-start mb-2">
                                <h5 class="font-medium text-gray-900">{{ order.data.user_info.full_name }}</h5>
                                <Status :status="order.data.status" font-size="12" />
                            </div>
                            <div class="grid grid-cols-2 gap-2 text-sm">
                                <p><i class="fas fa-calendar-alt w-4 text-gray-400"></i> {{
                                    order.data.participant_info?.birth_date || '—' }}</p>
                                <p><i class="fas fa-envelope w-4 text-gray-400"></i> {{ order.data.user_info?.email ||
                                    '—' }}</p>
                                <p><i class="fas fa-graduation-cap w-4 text-gray-400"></i>{{
                                    order.data.participant_info.direction?.code || '—' }} {{
                                        order.data.participant_info.direction?.title || '—' }}</p>
                            </div>
                        </div>

                        <!-- Документы -->
                        <div v-if="order.data.documents?.length" class="mb-3">
                            <p class="text-xs font-medium text-gray-500 mb-1">Документы:</p>
                            <div class="flex flex-wrap gap-2">
                                <a v-for="doc in order.data.documents" :key="doc.id"
                                    class="text-xs text-indigo-600 hover:text-indigo-800 flex items-center gap-1"
                                    download>
                                    <i class="fas fa-file-pdf"></i>
                                    {{ doc.type }}
                                </a>
                            </div>
                        </div>

                        <div v-if="order.data.status === 'На рассмотрении'"
                            class="flex gap-2 pt-2 border-t border-gray-100">
                            <button @click="acceptOrder(order.data.id)"
                                class="px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition">
                                Принять
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition shadow-sm h-full w-fit text-sm">
                                Отклонить
                            </button>
                        </div>
                        <div v-else-if="order.data.reject_message" class="pt-2 border-t border-gray-100">
                            <p class="text-xs text-red-600">
                                <i class="fas fa-times-circle"></i>
                                Причина отклонения: {{ order.data.reject_message }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div v-else class="text-center py-4 text-gray-400 text-sm">
                Нет заявок от данной школы
            </div>
        </div>
    </div>
</template>

<style scoped>
.rotate-180 {
    transform: rotate(180deg);
}
</style>
