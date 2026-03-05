<script setup>
const PROPS = defineProps(["label", "name", "options"]);
</script>
<template>
  <div>
    <label :for="name" class="block text-sm font-medium text-gray-700 mb-1">{{
      label
    }}</label>
    <select
      :name="name"
      class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 max-h-fit"
    >
      <option :value="option.slug" v-for="option in options" :key="option.slug">
        {{ option.title }}
      </option>
    </select>
  </div>
</template>
