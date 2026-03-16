<script setup>
import { ref } from 'vue';

const PROPS = defineProps(["label", "options", "name"]);
const emit = defineEmits(["update-value"]);

let selectValue = ref('');

const handleChange = (e) => {
    selectValue.value = e.target.value;
    emit('update-value', {
        name: PROPS.name,
        value: e.target.value
    });
};
</script>
<template>
    <div class="flex flex-col gap-1">
        <label v-if="label" :for="name" class="text-[#364153] font-medium text-[14px]">
            {{ label }}
        </label>
        <select :name="name" @change="handleChange"
            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition flex flex-1">
            <option :value="null" disabled selected v-if="label">
                Выберите {{ label.toLowerCase() }}
            </option>
            <option :value="option.id" v-for="option in options" :key="option.id">
                {{ option.title }}
            </option>
        </select>
    </div>
</template>
