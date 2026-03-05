<script setup>
import { usePage } from "@inertiajs/inertia-vue3";
import { ref, watch, computed } from "vue";

const PROPS = defineProps(["label", "name", "placeholder", "type", "icon"]);
const emit = defineEmits(["change-value"]);
const PAGE = usePage();
const ERRORS = computed(() => PAGE.props.value.errors[PROPS.name]);

let value = ref("");

watch(value, (newValue) => {
  emit("change-value", {
    name: PROPS.name,
    value: newValue,
  });
});
</script>

<template>
  <div class="flex flex-col gap-1">
    <label :for="name" class="text-[#364153] font-medium text-[14px]">{{
      label
    }}</label>

    <div class="relative">
      <i v-if="icon" :class="icon"></i>
      <input
        :type="type ?? 'text'"
        :name="name"
        v-model="value"
        :placeholder="placeholder ?? 'Введите значение...'"
        class="w-full px-4 py-2.5 bg-gray-50 border rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition min-h-12.5"
        :class="[
          icon ? 'pl-10' : '',
          ERRORS
            ? 'border-red-300 bg-red-50 focus:ring-red-500 focus:border-red-500'
            : 'border-gray-200',
        ]"
      />
    </div>

    <transition
      enter-active-class="transition duration-200 ease-out"
      enter-from-class="transform -translate-y-2 opacity-0"
      enter-to-class="transform translate-y-0 opacity-100"
      leave-active-class="transition duration-150 ease-in"
      leave-from-class="transform translate-y-0 opacity-100"
      leave-to-class="transform -translate-y-2 opacity-0"
    >
      <div
        v-if="ERRORS"
        class="flex items-center gap-1.5 mt-1 text-sm text-red-600"
      >
        <svg
          class="w-4 h-4 text-red-500 shrink-0"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            fill-rule="evenodd"
            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
            clip-rule="evenodd"
          />
        </svg>
        <span>{{ ERRORS }}</span>
      </div>
    </transition>
  </div>
</template>
