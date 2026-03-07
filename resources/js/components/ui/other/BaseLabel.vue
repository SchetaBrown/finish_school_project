<script setup>
defineProps(["label", "name"]);
</script>
<template>
  <label
    v-if="label"
    :for="name"
    class="text-[#364153] font-medium text-[14px]"
  >
    {{ label }}
  </label>
</template>
