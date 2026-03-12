<script setup>
import AdminNavigationPanel from '@components/partials/AdminNavigationPanel.vue';
</script>
<template>
    <main class="flex">
        <AdminNavigationPanel></AdminNavigationPanel>
        <section class="p-4">
            <slot></slot>
        </section>
    </main>
</template>
