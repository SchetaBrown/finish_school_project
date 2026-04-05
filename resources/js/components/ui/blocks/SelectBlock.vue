<script setup>
import { computed, ref, watch } from 'vue';
import InputError from "@other/InputError.vue";

const props = defineProps(["label", "options", "name", 'optionTitle', 'selectTitle', 'form']);
const emit = defineEmits(["update-value"]);

let selectValue = ref('');

const handleChange = (e) => {
    isDirty.value = false;

    if (error.value) {
        form.clearErrors(props.name);
    }

    selectValue.value = e.target.value;
    emit('update-value', {
        name: props.name,
        value: e.target.value
    });
};

const form = props?.form;
const isDirty = ref(false);
const error = computed(() => {
    return form?.errors[props.name];
});

const inputClasses = computed(() => {
    const baseClasses = [
        'w-full px-4 py-2.5 bg-gray-50 border rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition min-h-11 max-h-11',
        props.icon ? 'pl-10' : '',
        props.type === 'button' ? 'cursor-pointer' : '',
    ];

    if (error.value) {
        return [...baseClasses, 'border-red-300 bg-red-50 focus:ring-red-500 focus:border-red-500'].join(' ');
    }

    return [...baseClasses, 'border-gray-200'].join(' ');
});

watch(error, () => {
    isDirty.value = true;
});
</script>
<template>
    <div class="flex flex-col gap-1">
        <label v-if="label" :for="name" class="text-[#364153] font-medium text-[14px]">
            {{ label }}
        </label>
        <select :name="name" @change="handleChange"
            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition flex flex-1 max-h-11"
            :class="inputClasses">
            <option :value="null" disabled selected v-if="label">
                Выберите {{ label.toLowerCase() }}
            </option>
            <option :value="option.id ?? option[selectTitle]" v-for="option in options"
                :key="option.id ?? option[selectTitle]">
                {{ option.title ?? option[selectTitle] }}
            </option>
        </select>
        <InputError :error="error" :is-dirty="isDirty" />
    </div>
</template>
