<script setup>
import { computed } from 'vue';

const props = defineProps(["text", "icon", 'type', 'class']);
const btnIcon = computed(() => {
    return props.icon ? `${props.icon} mr-2` : '';
});

const btnClass = computed(() => {
    const customClass = props.class;
    return customClass && customClass.length !== 0 ? customClass : 'flex items-center justify-center gap-2 py-3 px-4 font-medium rounded-lg bg-indigo-600 text-sm text-white'
});
</script>
<template>
    <button :type="type || 'submit'" :class="btnClass">
        <i v-if="btnIcon && btnIcon.length !== 0" :class="btnIcon"></i>
        {{ text }}
    </button>
</template>
