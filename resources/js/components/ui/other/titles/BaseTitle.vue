<script setup>
const PROPS = defineProps(["title", "subtitle"]);
</script>

<template>
  <div class="mb-6">
    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
      {{ title ?? "Нет заголовка" }}
    </h1>
    <p class="text-sm text-gray-500 mt-1">
      {{ subtitle ?? "Нет подзаголовка" }}
    </p>
  </div>
</template>
