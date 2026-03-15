<script setup>
import AppBaseLayout from '@layouts/AppBaseLayout.vue';
import TheProfileAside from '@components/partials/TheProfileAside.vue';
import Container from '@other/Container.vue'
</script>
<template>
    <AppBaseLayout>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <TheProfileAside></TheProfileAside>
            <div class="lg:col-span-3 space-y-6">
                <Container></Container>
            </div>
        </div>
    </AppBaseLayout>
</template>
