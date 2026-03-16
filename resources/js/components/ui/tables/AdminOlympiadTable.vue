<script setup>
import { computed } from 'vue';
import Status from '@other/Status.vue'

const props = defineProps(['olympiads', 'olympiads_count']);
const ths = computed(() => ['Название', 'Статус', 'Направление']);
</script>
<template>
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-xs font-medium text-gray-400 uppercase tracking-wider"
                            v-for="th in ths" :key="th">{{ th }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50 transition" v-for="olympiad in olympiads" :key="olympiad.title">
                        <td class="px-6 py-4">{{ olympiad.title }}</td>
                        <td class="px-6 py-4">
                            <Status :status="olympiad.status" :font-size="12" />
                        </td>
                        <td class="px-6 py-4">{{ olympiad.direction }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
