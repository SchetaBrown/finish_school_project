<script setup>
const PROPS = defineProps(["description"]);
</script>
<template>
  <p class="text-sm text-gray-500 mb-4 line-clamp-2">
    {{ description ?? "Нет направления" }}
  </p>
</template>
