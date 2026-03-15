<script setup>
import BaseLabel from '@other/BaseLabel.vue'
import InputError from '@other/InputError.vue'
import { ref, computed } from 'vue';

const PROPS = defineProps(['type', 'title', 'label', 'name', 'baseTitle', 'selectTitle', 'error']);
const emit = defineEmits(['update-value', 'clear-error']);

const isProcessing = ref(false);

const handleClick = () => {
    if (isProcessing.value) return;

    isProcessing.value = true;

    if (PROPS.error) {
        emit('clear-error', PROPS.name);
    }

    emit('update-value', true);

    setTimeout(() => {
        isProcessing.value = false;
    }, 300);
};

const buttonText = computed(() => {
    return PROPS.baseTitle || 'Выберите значение';
});

const buttonClasses = computed(() => {
    const baseClasses = 'w-full px-4 py-2.5 border rounded-lg text-gray-900 focus:outline-none focus:ring-2 transition min-h-12.5';

    if (PROPS.error) {
        return `${baseClasses} bg-red-50 border-red-300 text-red-700 hover:bg-red-100 focus:ring-red-500`;
    }

    if (PROPS.selectTitle && PROPS.selectTitle !== '') {
        return `${baseClasses} bg-indigo-50 border-indigo-300 text-indigo-700 hover:bg-indigo-100 focus:ring-indigo-500`;
    }

    return `${baseClasses} bg-gray-50 border-gray-200 text-gray-500 hover:bg-gray-100 focus:ring-indigo-500`;
});

const selectedValueClasses = computed(() => {
    if (PROPS.error) {
        return 'text-xs text-red-500 mt-1 ml-1 flex items-center gap-1';
    }
    return 'text-xs text-indigo-600 mt-1 ml-1 flex items-center gap-1';
});
</script>

<template>
    <div class="flex flex-col gap-1">
        <BaseLabel :label="label" :name="name" />

        <button :type="type ?? 'button'" @click="handleClick" :class="buttonClasses" :disabled="isProcessing">
            {{ buttonText }}
        </button>

        <div v-if="selectTitle && selectTitle !== ''" :class="selectedValueClasses">
            Выбрано: {{ selectTitle }}
        </div>

        <InputError :error="error" />
    </div>
</template>
