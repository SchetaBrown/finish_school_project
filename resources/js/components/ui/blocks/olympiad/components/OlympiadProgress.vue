<script setup>
import { computed } from "vue";

const PROPS = defineProps([
  "player_count",
  "player_limit",
  "direction",
  "status",
]);

const PLAYER_COUNT = PROPS.player_count;
const PLAYER_LIMIT = PROPS.player_limit;

const PROGRESS_BAR_WIDTH = computed(() => {
  return `width:${((PLAYER_COUNT / PLAYER_LIMIT) * 100).toFixed(0)}%`;
});
</script>
<template>
  <div class="flex items-center justify-between text-sm mb-3">
    <span class="text-gray-600">
      <i class="fas fa-tag mr-1 text-indigo-400"></i>
      {{ direction }}
    </span>
    <span class="font-medium text-gray-900"
      >{{ player_count }}/{{ player_limit }}</span
    >
  </div>
  <div class="w-full bg-gray-100 h-1.5 rounded-full mb-4">
    <div
      :class="
        status === 'Завершено'
          ? 'bg-gray-400 h-1.5 rounded-full'
          : 'bg-indigo-600 h-1.5 rounded-full'
      "
      :style="PROGRESS_BAR_WIDTH"
    ></div>
  </div>
</template>
