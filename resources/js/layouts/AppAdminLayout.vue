<script setup>
import AdminNavigationBar from '@components/partials/AdminNavigationBar.vue';
import MainLayout from './MainLayout.vue';
</script>
<template>
    <MainLayout>
        <main class="flex min-h-screen">
            <AdminNavigationBar></AdminNavigationBar>
            <section class="flex-1 p-4 sm:p-6 lg:p-8 overflow-x-hidden">
                <slot></slot>
            </section>
        </main>
    </MainLayout>
</template>
