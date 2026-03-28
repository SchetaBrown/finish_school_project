<script setup>
const props = defineProps(['ths']);
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
                    <slot></slot>
                </tbody>
            </table>
        </div>
    </div>
</template>
