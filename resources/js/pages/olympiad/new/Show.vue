<script setup>
const props = defineProps(['new']);
import AppBaseLayout from '@layouts/AppBaseLayout.vue'
import { computed } from 'vue';
const olympiadNew = computed(() => {
    return props.new.data;
})
</script>
<template>
    <AppBaseLayout>
        <Container>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 leading-tight">{{ olympiadNew.title }}</h1>
            <div class="px-6 pb-6 space-y-4 text-gray-600 leading-relaxed">
                <p>{{ olympiadNew.description }}</p>
            </div>
        </Container>
    </AppBaseLayout>
</template>
