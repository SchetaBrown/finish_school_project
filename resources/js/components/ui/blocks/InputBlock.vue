<script setup>
import { ref, watch, computed } from "vue";
import InputError from "@other/InputError.vue";
import ProximaPhone from "proxima-vue/field/phone";
import Label from '@other/Label.vue'

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

    // if (error.value) {
    //     form.clearErrors(props.name);
    // }

    emit("update-value", {
        name: props.name,
        value: newValue,
    });
});

watch(error, () => {
    isDirty.value = true;
});
</script>

<template>
    <div class="flex flex-col gap-1">
        <Label :label="label" :name="name" />
        <div class="flex flex-col gap-1">
            <div class="phone-wrapper" v-if="name === 'phone'">
                <ProximaPhone v-model="value" name="phone" :format="'+7 (9**) ***-**-**'"
                    :placeholder="placeholder ?? '+7 (___) ___-__-__'" />
            </div>
            <div class="relative" v-else>
                <i v-if="icon" :class="icon"></i>
                <input :type="type ?? 'text'" :name="name" v-model="value"
                    :placeholder="placeholder ?? 'Введите значение...'"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition min-h-12.5 max-h-12.5" />
            </div>

            <InputError :error="error" :is-dirty="isDirty" />
        </div>
    </div>
</template>
<style scoped>
.phone-wrapper {
    --field-padding-y: 0.625rem;
    --field-padding-x-start: 1rem;
    --field-padding-x-end: 1rem;
    --field-background: #f9fafb;

    --field-border-width: 1px;
    --field-border-style: solid;
    --field-border-color: #e5e7eb;
    --field-border-radius: 0.5rem;

    --field-color: #111827;
    --field-font-family: inherit;
    --field-font-weight: 400;
    --field-font-size: 1rem;
    --field-line-height: 1.5;

    --field-placeholder-color: #9ca3af;
    --field-placeholder-font-family: inherit;
    --field-placeholder-font-size: 1rem;
    --field-placeholder-font-weight: 400;
    --field-placeholder-opacity: 1;

    --field-focus-border-color: none;
    --field-focus-ring: none;
    --field-focus-background: none;

    --field-transition: all 0.2s;

    --field-size: 3.125rem;

    --field-mask-color: #9ca3af;

    --field-focus-background: none;
    --field-focus-border-color: none;
    --field-focus-placeholder-color: none;

    --field-hover-border-color: 0;
    --field-action-hover-color: 0;

    --field-action-color: #787a7d;
    --field-box-shadow-soft-color: none;
}

.phone-wrapper.has-error {
    --field-border-color: #fca5a5;
    --field-background: #fef2f2;
    --field-mask-color: #ef4444;
    --field-invalid-color: #dc2626;
    --field-invalid-mask-color: #fecaca;
    --field-focus-border-color: #ef4444;
    --field-focus-ring: 0 0 0 2px rgba(239, 68, 68, 0.2);
}

.has-error :deep(.proxima-icon) {
    color: #ef4444;
}

.phone-wrapper:not(.has-error) {
    --field-border-color: #e5e7eb;
    --field-background: #f9fafb;
}
</style>
