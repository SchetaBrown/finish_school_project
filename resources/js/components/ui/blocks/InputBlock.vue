<script setup>
import { ref, watch, computed } from "vue";
import InputError from "@other/InputError.vue";
import ProximaPhone from "proxima-vue/field/phone";
import Label from '@other/Label.vue'

const props = defineProps(['label', "placeholder", "type", "icon", 'name', 'form', 'subtitle', 'checkboxOption', 'value']);
const emit = defineEmits(["update-value"]);

const formatDateForInput = (dateValue) => {
    if (!dateValue) return '';

    if (typeof dateValue === 'string') {
        if (props.type === 'date' && /^\d{4}-\d{2}-\d{2}$/.test(dateValue)) {
            return dateValue;
        }
        if (props.type === 'datetime-local' && /^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/.test(dateValue)) {
            return dateValue;
        }

        if (dateValue.match(/^\d{2}\.\d{2}\.\d{4}/)) {
            const [day, month, year] = dateValue.split('.');
            if (props.type === 'date') {
                return `${year}-${month}-${day}`;
            }
            if (props.type === 'datetime-local') {
                return `${year}-${month}-${day}T00:00`;
            }
        }
    }

    if (dateValue instanceof Date && !isNaN(dateValue)) {
        const year = dateValue.getFullYear();
        const month = String(dateValue.getMonth() + 1).padStart(2, '0');
        const day = String(dateValue.getDate()).padStart(2, '0');

        if (props.type === 'date') {
            return `${year}-${month}-${day}`;
        }

        if (props.type === 'datetime-local') {
            const hours = String(dateValue.getHours()).padStart(2, '0');
            const minutes = String(dateValue.getMinutes()).padStart(2, '0');
            return `${year}-${month}-${day}T${hours}:${minutes}`;
        }
    }

    return dateValue;
};

const formatDateForOutput = (dateValue) => {
    if (!dateValue) return '';

    if (props.type === 'date') {
        if (typeof dateValue === 'string' && /^\d{4}-\d{2}-\d{2}$/.test(dateValue)) {
            return dateValue;
        }
    }

    if (props.type === 'datetime-local') {
        if (typeof dateValue === 'string' && /^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/.test(dateValue)) {
            return dateValue;
        }
    }

    return dateValue;
};

const value = ref(formatDateForInput(props.value ?? ""));
const isDirty = ref(false);
const form = props?.form;
const checked = ref(false);

watch(() => props.value, (newValue) => {
    const formatted = formatDateForInput(newValue);
    if (formatted !== value.value) {
        value.value = formatted;
    }
});

watch(value, (newValue) => {
    isDirty.value = false;

    const outputValue = formatDateForOutput(newValue);

    emit("update-value", {
        name: props.name,
        value: outputValue,
    });
});

const error = computed(() => {
    return form?.errors[props.name];
});

watch(error, () => {
    isDirty.value = true;
});

watch(checked, (newValue) => {
    isDirty.value = false;

    emit("update-value", {
        name: props.name,
        value: newValue ? props.checkboxOption : null,
        clear: !newValue,
    });
});

watch(() => props.value, (newValue) => {
    if (props.type === 'checkbox') {
        checked.value = newValue === props.checkboxOption;
    }
}, { immediate: true });
</script>

<template>
    <div class="flex flex-col gap-1">
        <Label :label="label" :name="name" />
        <div class="flex flex-col gap-1">
            <div v-if="type === 'checkbox'">
                <label class="flex items-center space-x-2" :for="name">
                    <input type="checkbox" v-model="checked"
                        class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" />
                    <span class="text-sm text-gray-700">{{ placeholder }}</span>
                </label>
            </div>

            <div class="phone-wrapper" v-if="name === 'phone' && type !== 'checkbox'">
                <ProximaPhone v-model="value" name="phone" :format="'+7 (9**) ***-**-**'"
                    :placeholder="placeholder ?? '+7 (___) ___F-__-__'" />
                <span class="text-[12px] text-[#99A1AF]" v-if="subtitle">{{ subtitle }}</span>
            </div>

            <div v-else-if="name === 'description' && type !== 'checkbox'">
                <textarea name="description" v-model="value"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">{{ value }}</textarea>
                <span class="text-[12px] text-[#99A1AF]" v-if="subtitle">{{ subtitle }}</span>
            </div>

            <div class="relative" v-else-if="type !== 'checkbox'">
                <i v-if="icon" :class="icon"></i>
                <input :type="type ?? 'text'" :name="name" v-model="value"
                    :placeholder="placeholder ?? 'Введите значение...'"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition min-h-11 max-h-11" />
                <span class="text-[12px] text-[#99A1AF]" v-if="subtitle">{{ subtitle }}</span>
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
