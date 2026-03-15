<script setup>
import { ref, watch, computed } from "vue";
import InputError from "@other/InputError.vue";

const PROPS = defineProps(["placeholder", "type", "icon", 'name', 'error']);
const emit = defineEmits(["change-value"]);

let value = ref("");

const isDirty = ref(false);

watch(value, (newValue) => {
    isDirty.value = true;

    emit("change-value", {
        name: PROPS.name,
        value: newValue,
    });
});

const inputClasses = computed(() => {
    const baseClasses = [
        'w-full px-4 py-2.5 bg-gray-50 border rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition min-h-12.5',
        PROPS.icon ? 'pl-10' : '',
        PROPS.type === 'button' ? 'cursor-pointer' : '',
    ];

    if (isDirty.value) {
        return [...baseClasses, 'border-gray-200'].join(' ');
    }

    if (PROPS.error) {
        return [...baseClasses, 'border-red-300 bg-red-50 focus:ring-red-500 focus:border-red-500'].join(' ');
    }

    return [...baseClasses, 'border-gray-200'].join(' ');
});

watch(() => PROPS.error, (newError) => {
    if (newError) {
        isDirty.value = false;
    }
});
</script>

<template>
    <div class="flex flex-col gap-1">
        <div class="relative">
            <i v-if="icon" :class="icon"></i>
            <input :type="type ?? 'text'" :name="name" v-model="value"
                :placeholder="placeholder ?? 'Введите значение...'" :class="inputClasses" @input="isDirty = true" />
        </div>

        <InputError :error="!isDirty ? PROPS.error : null" :name="name" />
    </div>
</template>
