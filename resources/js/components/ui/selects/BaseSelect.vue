<script setup>
import InputError from '@other/InputError.vue'
import { ref } from "vue";

const PROPS = defineProps(["label", "options", "name"]);
const emit = defineEmits(["select-value"]);

let selectValue = ref('');

const handleChange = (event) => {
    selectValue.value = event.target.value;
    emit('select-value', selectValue.value);
};
</script>

<template>
    <select :name="name" @change="handleChange"
        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition flex flex-1 max-h-11">
        <option :value="null" disabled selected v-if="label">
            Выберите {{ label.toLowerCase() }}
        </option>
        <option :value="option.id" v-for="option in options" :key="option.id">
            {{ option.title }}
        </option>
    </select>
</template>
