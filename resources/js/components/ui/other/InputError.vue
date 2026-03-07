<script setup>
import { ref, watch } from 'vue';

const PROPS = defineProps(["error"]);
const errorState = ref({
    show: false,
    message: '',
    key: 0
});

watch(() => PROPS.error, (newError) => {
    if (newError && newError !== undefined) {
        // Новая ошибка
        errorState.value = {
            show: true,
            message: newError,
            key: errorState.value.key + 1
        };
    } else {
        // Ошибка исчезла
        errorState.value.show = false;
    }
}, { immediate: true });
</script>

<template>
    <transition enter-active-class="transition duration-200 ease-out"
        enter-from-class="transform -translate-y-2 opacity-0" enter-to-class="transform translate-y-0 opacity-100"
        leave-active-class="transition duration-150 ease-in" leave-from-class="transform translate-y-0 opacity-100"
        leave-to-class="transform -translate-y-2 opacity-0">
        <div v-if="errorState.show" :key="errorState.key" class="flex items-center gap-1.5 mt-1 text-sm text-red-600">
            <svg class="w-4 h-4 text-red-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
            <span>{{ errorState.message }}</span>
        </div>
    </transition>
</template>
