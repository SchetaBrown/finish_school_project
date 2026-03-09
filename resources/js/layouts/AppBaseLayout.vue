<script setup>
import TheHeader from "../components/ui/partials/TheHeader.vue";
import TheFooter from "../components/ui/partials/TheFooter.vue";
import FlashMessage from "@other/FlashMessage.vue";
</script>
<template>
    <FlashMessage></FlashMessage>
  <div class="min-h-screen flex flex-col">
    <TheHeader class="sticky top-0 z-50" />
    <main class="flex-1 mx-auto max-w-360 w-full px-4 sm:px-6 lg:px-8">
      <slot></slot>
    </main>
    <TheFooter />
  </div>
</template>
