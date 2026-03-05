<script setup>
const PROPS = defineProps(["id", "activeTab"]);
import { computed } from "vue";

const IS_ACTIVE = computed(() => {
  const ID = PROPS.id;
  const ACTIVE_TAB = PROPS.activeTab;
  return ID === ACTIVE_TAB;
});
</script>
<template>
  <button
    class="flex items-center justify-center py-3.5 px-6 rounded-lg gap-2"
    :id="id"
    :class="
      IS_ACTIVE
        ? 'text-white bg-indigo-600'
        : 'text-gray-900 border border-gray-200'
    "
  >
    <slot></slot>
  </button>
</template>
