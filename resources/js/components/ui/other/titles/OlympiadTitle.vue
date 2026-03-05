<script setup>
const PROPS = defineProps(["title"]);
</script>
<template>
  <h3 class="font-semibold text-gray-900 mb-2 line-clamp-1">{{ title }}</h3>
</template>
