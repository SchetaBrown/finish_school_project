<script setup>
import TheHeader from "@components/partials/TheHeader.vue";
import TheFooter from "@components/partials/TheFooter.vue";
import MainLayout from "./MainLayout.vue";
import { inject } from "vue";

</script>
<template>
    <MainLayout>
        <div class="min-h-screen flex flex-col">
            <TheHeader class="sticky top-0 z-50" />
            <main class="flex-1 mx-auto max-w-360 w-full px-4 sm:px-6 lg:px-8">
                <slot></slot>
            </main>
            <TheFooter />
        </div>
    </MainLayout>
</template>
