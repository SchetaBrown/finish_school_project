<script setup>
import TheHeader from "../components/ui/partials/TheHeader.vue";
import TheFooter from "../components/ui/partials/TheFooter.vue";
</script>
<template>
  <TheHeader></TheHeader>
  <main class="">
    <slot></slot>
  </main>
  <TheFooter></TheFooter>
</template>
