<script setup>
defineProps(["href", "textSm", "linkText"]);
</script>
<template>
  <div class="flex justify-center mt-4">
    <Link :href="route(href)" class="text-sm text-[#6A7282] text-center">
      {{ textSm }}
      <span class="font-medium text-indigo-600">{{ linkText }}</span>
    </Link>
  </div>
</template>
