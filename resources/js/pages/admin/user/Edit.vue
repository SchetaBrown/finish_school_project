<script setup>
const props = defineProps(['data']);

import AppAdminLayout from '@layouts/AppAdminLayout.vue'
</script>
<template>
    <AppAdminLayout>
        Пользователь
        {{ data.data }}
    </AppAdminLayout>
</template>
