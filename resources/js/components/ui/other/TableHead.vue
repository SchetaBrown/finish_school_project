<script setup>
const props = defineProps(['ths']);
</script>
<template>
    <thead class="bg-gray-50 border-b border-gray-200">
        <tr>
            <th class="px-6 py-4 text-xs font-medium text-gray-400 uppercase tracking-wider" v-for="th in ths"
                :key="th">{{ th }}</th>
        </tr>
    </thead>
</template>
