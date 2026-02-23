<script setup>
import { computed } from "vue";

const PROPS = defineProps(["status"]);
const STATUS = PROPS.status;

const STATUS_CLASSES = computed(() => {
  if (typeof STATUS === "string") {
    switch (STATUS.toLowerCase()) {
      case "открыта регистрация":
        return "bg-green-100 text-green-700";
      case "регистрация закрыта":
        return "bg-red-100 text-red-700";
      case "завершено":
        return "bg-gray-100 text-gray-600";
    }
  }
});
</script>
<template>
  <div
    class="flex items-start justify-between mb-4 max-w-fit rounded-full"
    :class="STATUS_CLASSES"
  >
    <span class="px-3 py-1 text-xs font-medium max-w-fit">
      {{ status }}
    </span>
  </div>
</template>
