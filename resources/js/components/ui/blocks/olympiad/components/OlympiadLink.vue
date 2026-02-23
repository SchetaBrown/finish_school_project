<script setup>
const PROPS = defineProps(["slug", "status"]);

const OLYMPIAD_IS_FINISHED = PROPS.status.toLowerCase() === "завершено";
</script>
<template>
  <div class="flex items-center justify-end">
    <Link
      :href="
        OLYMPIAD_IS_FINISHED
          ? route('olympiad.result.index', { slug })
          : route('olympiad.show', { slug })
      "
      class="text-sm font-medium"
      :class="
        OLYMPIAD_IS_FINISHED
          ? 'text-gray-500 hover:text-gray-700'
          : 'text-indigo-600 hover:text-indigo-700'
      "
    >
      {{ OLYMPIAD_IS_FINISHED ? "Итоги" : "Подробнее" }} →</Link
    >
  </div>
</template>
