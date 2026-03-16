<script setup>
import { ref, watch, computed, onMounted } from "vue";
import InputError from "@other/InputError.vue";
import { useForm } from "@inertiajs/vue3";

const PROPS = defineProps(['label', "placeholder", "type", "icon", 'name']);
const emit = defineEmits(["update-value"]);

const value = ref("");
const isDirty = ref(false);

const form = useForm();

watch(() => form?.errors[PROPS.name], (newError) => {
    if (newError) {
        isDirty.value = true;
    }
});

watch(value, (newValue) => {
    isDirty.value = true;

    if (form.errors[PROPS.name]) {
        form.clearErrors(PROPS.name);
    }

    emit("update-value", {
        name: PROPS.name,
        value: newValue,
    });
});

// Классы для инпута
const inputClasses = computed(() => {
    const baseClasses = [
        'w-full px-4 py-2.5 bg-gray-50 border rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition min-h-12.5',
        PROPS.icon ? 'pl-10' : '',
        PROPS.type === 'button' ? 'cursor-pointer' : '',
    ];

    if (form.errors[PROPS.name]) {
        return [...baseClasses, 'border-red-300 bg-red-50 focus:ring-red-500 focus:border-red-500'].join(' ');
    }

    return [...baseClasses, 'border-gray-200'].join(' ');
});

onMounted(() => {
    if (form.errors[PROPS.name]) {
        isDirty.value = true;
    }
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

            <InputError :error="PROPS.form?.errors[PROPS.name]" :name="name" />
        </div>
    </div>
</template>
