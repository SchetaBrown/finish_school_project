<script setup>
import { ref, computed, watch } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";
import ProximaPhone from "proxima-vue/field/phone";
import InputError from "@other/InputError.vue";
import BaseLabel from "@other/BaseLabel.vue";

const PAGE = usePage();
const PROPS = defineProps(["label", "name", "placeholder", "type", "icon", 'error']);
const emit = defineEmits(["change-value", "clear-error"]); // Добавляем clear-error

const value = ref("");

// Флаг для отслеживания, было ли изменение после ошибки
const wasModified = ref(false);

// Состояние ошибки с учетом модификации
const hasError = computed(() => {
    // Если поле было изменено после ошибки - не показываем ошибку
    if (wasModified.value) return false;
    return !!PROPS.error;
});

// Классы для обертки
const fieldState = computed(() => ({
    "has-error": hasError.value,
}));

// Следим за изменением значения
watch(value, (newValue) => {
    // Отмечаем, что поле было изменено
    wasModified.value = true;

    // Эмитим изменение
    emit('change-value', newValue);

    // Если была ошибка - эмитим запрос на очистку
    if (PROPS.error) {
        emit('clear-error', PROPS.name);
    }
});

// Сбрасываем флаг при появлении новой ошибки
watch(() => PROPS.error, (newError) => {
    if (newError) {
        wasModified.value = false; // Новая ошибка - сбрасываем флаг
    }
});

// Обработчик ввода напрямую (на случай, если ProximaPhone не обновляет v-model мгновенно)
const handleInput = (event) => {
    wasModified.value = true;
    // Обработка значения если нужно
};
</script>

<template>
    <div class="flex flex-col gap-1">
        <BaseLabel :label="label" :name="name" />

        <div class="phone-wrapper" :class="fieldState">
            <ProximaPhone v-model="value" :name="name" :format="'+7 (9**) ***-**-**'"
                :placeholder="placeholder ?? '+7 (___) ___-__-__'" @change-value="
                    (val) => {
                        wasModified.value = true;
                        emit('change-value', { name: PROPS.name, value: val });
                        if (PROPS.error) emit('clear-error', PROPS.name);
                    }
                " @input="handleInput" />
        </div>

        <!-- Показываем ошибку только если поле не было изменено -->
        <InputError :error="hasError ? PROPS.error : null" />
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

/* Стили для ошибки */
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

/* Стили для обычного состояния */
.phone-wrapper:not(.has-error) {
    --field-border-color: #e5e7eb;
    --field-background: #f9fafb;
}
</style>
