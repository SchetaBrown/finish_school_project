<script setup>
import { computed } from 'vue';

const PROPS = defineProps(['status', 'fontSize']);

const STATUS_CLASSES = computed(() => {
    const status = PROPS?.status?.toLowerCase().trim();

    switch (status) {
        case 'открыта регистрация':
        case 'принято':
            return 'bg-green-100 text-green-700';
        case 'регистрация закрыта':
        case 'отклонено':
            return 'bg-red-100 text-red-700';
        case 'завершено':
            return 'bg-gray-100 text-gray-600';
        case 'на рассмотрении':
            return 'bg-yellow-100 text-yellow-700';
        default:
            return 'bg-gray-100 text-gray-600';
    }
});

const FONT_SIZE = computed(() => {
    const size = PROPS.fontSize;

    if (!size) return 'text-sm';

    return '';
});

const fontSizeStyle = computed(() => {
    if (!PROPS.fontSize) return {};
    return { fontSize: `${PROPS.fontSize}px` };
});

const FONT_SIZE_CLASS = computed(() => {
    const size = PROPS.fontSize;
    const sizeMap = {
        12: 'text-xs',
        14: 'text-sm',
        16: 'text-base',
        18: 'text-lg',
        20: 'text-xl',
        24: 'text-2xl'
    };

    return sizeMap[size] || 'text-sm';
});
</script>

<template>
    <div class="flex items-start justify-between max-w-fit rounded-full h-fit" :class="STATUS_CLASSES">
        <span class="px-3 py-1 font-medium max-w-fit text-center" :class="FONT_SIZE_CLASS" :style="fontSizeStyle">
            {{ status }}
        </span>
    </div>
</template>
