<script setup>
import AdminNavigationBar from '@components/partials/AdminNavigationBar.vue';
</script>
<template>
    <main class="flex min-h-screen">
        <AdminNavigationBar></AdminNavigationBar>
        <section class="flex-1 p-4 sm:p-6 lg:p-8 overflow-x-hidden">
            <slot></slot>
        </section>
    </main>
</template>
