<script setup>
import { computed } from 'vue';

const PROPS = defineProps(["title", 'font-size', 'full-text']);

const FONT_SIZE = computed(() => {
    return `text-[${PROPS['font-size']}]`
});

const FULL_TEXT = computed(() => {
    return PROPS['full-text'] ? 'line-clamp-1' : '';
});
</script>
<template>
    <h3 class="font-semibold text-gray-900 mb-2 text-[18px] h-fit" :class="[FONT_SIZE, FULL_TEXT]">{{ title }}</h3>
</template>
