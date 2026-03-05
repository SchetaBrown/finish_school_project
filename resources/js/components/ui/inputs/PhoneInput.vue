<script setup>
import { ref, computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";
import ProximaPhone from "proxima-vue/field/phone";

const PAGE = usePage();
const PROPS = defineProps(["label", "name", "placeholder", "type", "icon"]);
const emit = defineEmits(["change-value"]);

const value = ref("");
const fieldError = computed(() => PAGE.props.errors?.[PROPS.name]);

// Класс для состояния ошибки
const fieldState = computed(() => ({
  "has-error": fieldError.value,
}));
</script>

<template>
  <div class="flex flex-col gap-1">
    <label
      v-if="label"
      :for="name"
      class="text-[#364153] font-medium text-[14px]"
    >
      {{ label }}
    </label>

    <!-- Оборачиваем ProximaPhone в div с кастомными переменными -->
    <div class="custom-phone-wrapper" :class="fieldState">
      <ProximaPhone
        v-model="value"
        :name="name"
        :format="'+7 (9**) ***-**-**'"
        :placeholder="placeholder ?? '+7 (___) ___-__-__'"
        @change-value="
          (val) => emit('change-value', { name: PROPS.name, value: val })
        "
      />
    </div>

    <!-- Блок с ошибкой -->
    <transition
      enter-active-class="transition duration-200 ease-out"
      enter-from-class="transform -translate-y-2 opacity-0"
      enter-to-class="transform translate-y-0 opacity-100"
      leave-active-class="transition duration-150 ease-in"
      leave-from-class="transform translate-y-0 opacity-100"
      leave-to-class="transform -translate-y-2 opacity-0"
    >
      <div
        v-if="fieldError"
        class="flex items-center gap-1.5 mt-1 text-sm text-red-600"
      >
        <svg
          class="w-4 h-4 text-red-500 shrink-0"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            fill-rule="evenodd"
            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
            clip-rule="evenodd"
          />
        </svg>
        <span>{{ fieldError }}</span>
      </div>
    </transition>
  </div>
</template>

<style scoped>
.custom-phone-wrapper {
  /* Базовые переменные - твои стили из Tailwind */

  /* Padding - соответствует py-2.5 px-4 */
  --field-padding-y: 0.625rem;
  --field-padding-x-start: 1rem;
  --field-padding-x-end: 1rem;

  /* Background - bg-gray-50 */
  --field-background: #f9fafb;

  /* Border - border border-gray-200 rounded-lg */
  --field-border-width: 1px;
  --field-border-style: solid;
  --field-border-color: #e5e7eb;
  --field-border-radius: 0.5rem;

  /* Text - text-gray-900 */
  --field-color: #111827;
  --field-font-family: inherit;
  --field-font-weight: 400;
  --field-font-size: 1rem;
  --field-line-height: 1.5;

  /* Placeholder */
  --field-placeholder-color: #9ca3af;
  --field-placeholder-font-family: inherit;
  --field-placeholder-font-size: 1rem;
  --field-placeholder-font-weight: 400;
  --field-placeholder-opacity: 1;

  /* Focus styles */
  --field-focus-border-color: #6366f1;
  --field-focus-ring: 0 0 0 2px rgba(99, 102, 241, 0.2);
  --field-focus-background: #f9fafb;

  /* Transition */
  --field-transition: all 0.2s;

  /* Size - min-h-12.5 */
  --field-size: 3.125rem;

  /* Mask/Placeholder цвет */
  --field-mask-color: #9ca3af;
}

/* Состояние ошибки */
.custom-phone-wrapper.has-error {
  --field-border-color: #fca5a5;
  --field-background: #fef2f2;
  --field-mask-color: #ef4444;
  --field-invalid-color: #dc2626;
  --field-invalid-mask-color: #fecaca;
  --field-focus-border-color: #ef4444;
  --field-focus-ring: 0 0 0 2px rgba(239, 68, 68, 0.2);
}

/* Дополнительные стили если нужно */
.custom-phone-wrapper :deep(input) {
  /* Если нужно что-то переопределить */
  outline: none !important;
}

.custom-phone-wrapper :deep(input:focus) {
  box-shadow: var(--field-focus-ring) !important;
}

/* Стилизация иконки если есть */
.custom-phone-wrapper :deep(.proxima-icon) {
  color: #9ca3af;
}

.has-error :deep(.proxima-icon) {
  color: #ef4444;
}
</style>
