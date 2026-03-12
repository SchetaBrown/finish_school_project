<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed, onMounted, ref, watch } from 'vue';

const isClosing = ref(false);
const page = usePage();
const flash = computed(() => {
    const messageObj = page.props.flash;
    const availableFlashMessage = {
        error: {
            div: '',
            span: '',
        },
        success: {
            div: '',
            span: '',
        },
        info: {
            div: '',
            span: '',
        },
        warning: {
            div: '',
            span: '',
        },
    };

    for (let value in availableFlashMessage) {
        if (messageObj[value] !== null) {
            return availableFlashMessage[value];
        }
    }
});

function clearMessage() {
    setTimeout(() => {

    }, 2000);
}
</script>
<template>
    {{ flash }}
    <div v-if="isClosing">
    </div>
</template>
