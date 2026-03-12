<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const emit = defineEmits(['update-token']);

function submit(token) {
    emit('update-token', token);
}

const page = usePage();
const siteKey = computed(() => {
    return page.props.recaptcha_site_key;
});

</script>
<template>
    <Captcha @onSuccess="submit" :siteKey="siteKey"></Captcha>
</template>
<style scoped>
.smart-captcha {
    width: 100% !important;
}
</style>
