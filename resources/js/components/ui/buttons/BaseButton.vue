<script setup>
defineProps(["text", "icon"]);
</script>
<template>
  <button
    type="submit"
    class="flex items-center justify-center gap-2 py-3 px-4 font-medium rounded-lg bg-indigo-600 text-white w-full"
  >
    <i v-if="icon" :class="icon"></i>
    {{ text }}
  </button>
</template>
