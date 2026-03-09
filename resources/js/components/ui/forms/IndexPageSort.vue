<script setup>
const PROPS = defineProps(["count"]);
</script>
<template>
  <div class="flex items-center justify-between mb-4">
    <span class="text-sm text-gray-500"
      >Найдено олимпиад
      <span class="font-medium text-indigo-600">{{ count }}</span>
    </span>
    <!-- <div class="flex items-center space-x-2">
      <span class="text-sm text-gray-500">Сортировать по:</span>
      <select
        name=""
        id=""
        class="text-sm border border-gray-200 rounded-lg px-3 py-1.5 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
      ></select>
    </div> -->
  </div>
</template>
