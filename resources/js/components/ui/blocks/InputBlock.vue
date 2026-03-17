<script setup>
import { ref, watch, computed } from "vue";
import InputError from "@other/InputError.vue";

const props = defineProps(['label', "placeholder", "type", "icon", 'name', 'form']);
const emit = defineEmits(["update-value"]);

const value = ref("");
const isDirty = ref(false);
const form = props?.form;

const error = computed(() => {
    return form?.errors[props.name];
});

watch(value, (newValue) => {
    isDirty.value = false;

    if (error.value) {
        form.clearErrors(props.name);
    }

    emit("update-value", {
        name: props.name,
        value: newValue,
    });
});

watch(error, () => {
    isDirty.value = true;
});

const inputClasses = computed(() => {
    const baseClasses = [
        'w-full px-4 py-2.5 bg-gray-50 border rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition min-h-12.5 max-h-12.5',
        props.icon ? 'pl-10' : '',
        props.type === 'button' ? 'cursor-pointer' : '',
    ];

    if (error.value) {
        return [...baseClasses, 'border-red-300 bg-red-50 focus:ring-red-500 focus:border-red-500'].join(' ');
    }

    return [...baseClasses, 'border-gray-200'].join(' ');
});
</script>

<template>
    <div class="flex flex-col gap-1">
        <label v-if="label" :for="name" class="text-[#364153] font-medium text-[14px]">
            {{ label }}
        </label>
        <div class="flex flex-col gap-1">
            <div class="relative">
                <i v-if="icon" :class="icon"></i>
                <input :type="type ?? 'text'" :name="name" v-model="value"
                    :placeholder="placeholder ?? 'Введите значение...'" :class="inputClasses" />
            </div>

            <InputError :error="error" :is-dirty="isDirty" />
        </div>
    </div>
</template>
