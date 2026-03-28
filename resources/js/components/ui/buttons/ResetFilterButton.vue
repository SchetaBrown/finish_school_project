<script setup>
const props = defineProps(['callback']);
</script>
<template>
    <button @click="callback" class="px-6 py-2.5 text-gray-600 hover:text-gray-900 transition"
        type="button">Сбросить</button>
</template>
