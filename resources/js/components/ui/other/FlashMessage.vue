<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed, onUnmounted, ref } from 'vue';

const isClosing = ref(false);
const page = usePage();
const flash = computed(() => {
    const messageObj = page?.props?.flash;
    const availableFlashMessage = {
        error: {
            div: 'div-ошибки',
            span: 'span-ошибки',
            message: messageObj.error,
        },
        success: {
            div: 'div-успеха',
            span: 'span-успеха',
            message: messageObj.success,
        },
        info: {
            div: 'div-информации',
            span: 'span-информации',
            message: messageObj.info,
        },
        warning: {
            div: 'div-предупреждения',
            span: 'span-предупреждения',
            message: messageObj.warning,
        },
    };

    for (let value in availableFlashMessage) {
        if (messageObj[value] !== null) {
            return availableFlashMessage[value];
        }
    }
});

const closeMessage = () => {
    isClosing.value = !isClosing.value
}

const clearMessage = () => {
    setTimeout(() => {

    }, 2000);
}

onUnmounted(() => {
    closeMessage()
});
</script>
<template>
    <div>

    </div>
</template>
