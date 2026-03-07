<script setup>
import BaseLabel from '@other/BaseLabel.vue'
import { ref, watch } from 'vue';
const PROPS = defineProps(['type', 'title', 'label', 'name', 'baseTitle', 'selectTitle']);
const emit = defineEmits(['update-value']);

let choose = ref(false);

watch(choose, (newValue) => {
    emit('update-value', newValue);
});
</script>
<template>
    <div class="flex flex-col gap-1">
        <BaseLabel :label="label" :name="name" />
        <button :type="type ?? 'button'" @click="choose = !choose"
            class="w-full px-4 py-2.5 bg-gray-50 border rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition min-h-12.5 border-gray-200">{{
                baseTitle ?? selectTitle }}</button>
    </div>
</template>
