<script setup>
import { ref, watch } from "vue";

const PROPS = defineProps(["label", "options", "name"]);

const emit = defineEmits(["select"]);
let value = ref("");

watch(value, (newValue) => {
    emit('select', newValue)
});
</script>
<template>
    <select :name="name" v-model="value"
        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition flex flex-1">
        <option value="" disabled selected>
            Выберите {{ label.toLowerCase() }}
        </option>
        <option :value="option.id" v-for="option in options" :key="option.id">
            {{ option.title }}
        </option>
    </select>
</template>
