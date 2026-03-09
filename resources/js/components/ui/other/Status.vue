<script setup>
import { computed } from 'vue';

const PROPS = defineProps(['status', 'fontSize']);
const STATUS_CLASSES = computed(() => {
    const STATUS = PROPS.status;

    switch (STATUS.toLowerCase()) {
        case "открыта регистрация":
            return "bg-green-100 text-green-700";
        case "регистрация закрыта":
            return "bg-red-100 text-red-700";
        case "завершено":
            return "bg-gray-100 text-gray-600";
    }
});

const FONT_SIZE = computed(() => {
    const SIZE = PROPS.fontSize;
    return SIZE ? `text-[${SIZE}px]` : 'text-sm';
});
</script>
<template>
    <div class="flex items-start justify-between max-w-fit rounded-full h-fit" :class="STATUS_CLASSES">
        <span class="px-3 py-1 font-medium max-w-fit text-center" :class="FONT_SIZE">
            {{ status }}
        </span>
    </div>
</template>
