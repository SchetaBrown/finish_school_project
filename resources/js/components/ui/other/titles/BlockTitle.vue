<script setup>
import { computed } from 'vue';

const PROPS = defineProps(["title", 'font-size']);

const FONT_SIZE = computed(() => {
    return `text-[${PROPS['font-size']}]`
});
</script>
<template>
    <h3 class="font-semibold text-gray-900 mb-2 line-clamp-1 text-[18px]" :class="FONT_SIZE">{{ title }}</h3>
</template>
