<script setup>
import { ref } from 'vue';
import Status from '@other/Status.vue';

const props = defineProps(['school', 'manager', 'orders']);

const isOpen = ref(false);


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
                    <p class="text-sm text-gray-500">Руководитель: {{ manager?.user_info?.initial_name || '—' }}</p>
                </div>
            </div>
            <i :class="['fas fa-chevron-down text-gray-400 transition-transform', { 'rotate-180': isOpen }]"></i>
        </div>

        <div v-show="isOpen" class="border-t border-gray-100 p-4">
            <div class="space-y-3 text-sm">
                <p><i class="fas fa-phone w-5 text-gray-400"></i> {{ school?.phone || '—' }}</p>
                <p><i class="fas fa-envelope w-5 text-gray-400"></i> {{ school?.email || '—' }}</p>
            </div>

            <div v-if="orders?.length" class="mt-4 pt-3 border-t border-gray-100">
                <p class="text-sm font-medium text-gray-700 mb-2">Заявки ({{ orders.length }})</p>
                <div class="space-y-3">
                    <div v-for="order in orders" :key="order.data.id" class="border border-gray-100 rounded-lg p-3">
                        <div class="flex justify-between items-start mb-2">
                            <div class="font-medium text-gray-900">
                                {{ order.data.full_name }}
                            </div>
                            <Status :status="order.data.status" font-size="12" />
                        </div>
                        <div class="text-sm text-gray-600 space-y-1">
                            <p><i class="fas fa-envelope w-4 text-gray-400"></i> {{ order.data.email ||
                                '—' }}</p>
                            <p><i class="fas fa-phone w-4 text-gray-400"></i> {{ order.data.phone || '—'
                                }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.rotate-180 {
    transform: rotate(180deg);
}
</style>
