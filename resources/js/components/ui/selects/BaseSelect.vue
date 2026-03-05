<script setup>
import { ref, watch } from "vue";

defineProps(["label", "options", "name"]);

const emits = defineEmits(["value"]);
let value = ref("");
watch(value, (newValue) => {
  console.log(newValue);
});
</script>
<template>
  <div class="flex flex-col gap-1">
    <label :for="name" class="text-[#364153] font-medium text-[14px]">{{
      label
    }}</label>
    <select
      :name="name"
      v-model="value"
      class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition flex flex-1"
    >
      <option value="" disabled selected>
        Выберите {{ label.toLowerCase() }}
      </option>
      <option :value="option.id" v-for="option in options" :key="option.id">
        {{ option.title }}
      </option>
    </select>
  </div>
</template>
