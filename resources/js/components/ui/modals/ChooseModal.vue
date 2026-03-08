<script setup>
import AddButton from '@buttons/AddButton.vue';
import CloseButton from '@buttons/CloseButton.vue';
import BlockTitle from '@other/titles/BlockTitle.vue';
import BaseInput from '@inputs/BaseInput.vue';
import InputError from "@other/InputError.vue";
import NoData from '@other/NoData.vue';

const PROPS = defineProps(['title', 'show', 'options', 'baseTitle', 'selectTitle', 'name']);

import { ref, computed, watch, onMounted, onUnmounted } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

const emit = defineEmits(['close', 'select']);

// Состояния
const searchQuery = ref('');
const universities = ref(PROPS.options?.data || []);
const isLoading = ref(false);

watch(() => PROPS.options, (newOptions) => {
    if (newOptions?.data) {
        universities.value = newOptions.data;
    }
}, { immediate: true });

const filteredOptions = computed(() => {
    if (!searchQuery.value.trim()) {
        return universities.value;
    }

    const query = searchQuery.value.toLowerCase().trim();
    return universities.value.filter(option =>
        option.title.toLowerCase().includes(query)
    );
});

const modalClasses = computed(() => [
    'fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50 transition-opacity duration-200',
    PROPS.show ? 'opacity-100' : 'opacity-0 pointer-events-none'
]);

const contentClasses = computed(() => [
    'bg-white rounded-xl shadow-xl w-full max-w-2xl max-h-[90vh] flex flex-col transform transition-all duration-200',
    PROPS.show ? 'scale-100 opacity-100' : 'scale-95 opacity-0'
]);

watch(() => PROPS.show, (newVal) => {
    if (newVal) {
        document.body.style.overflow = 'hidden';
        if (PROPS.options?.data) {
            universities.value = PROPS.options.data;
        }
    } else {
        document.body.style.overflow = '';
        searchQuery.value = '';
    }
});

// Закрытие по Escape
const handleEscape = (e) => {
    if (e.key === 'Escape' && PROPS.show) {
        closeModal();
    }
};

const PAGE = usePage();
const ERRORS = computed(() => PAGE.props.value.errors[PROPS.name]);

onMounted(() => {
    document.addEventListener('keydown', handleEscape);
});

onUnmounted(() => {
    document.removeEventListener('keydown', handleEscape);
    document.body.style.overflow = '';
});

// Методы
const closeModal = () => {
    emit('close');
};

const selectOption = (option) => {
    emit('select', {
        name: PROPS.name,
        value: option[PROPS.selectTitle]
    });
    closeModal();
};

const handleOverlayClick = (e) => {
    if (e.target === e.currentTarget) {
        closeModal();
    }
};

const handleSearch = (event) => {
    searchQuery.value = event.value;
};
</script>

<template>
    <Teleport to="body">
        <div :class="modalClasses" @click="handleOverlayClick">
            <div :class="contentClasses">
                <!-- Заголовок -->
                <div class="flex items-center justify-between p-6 border-b border-gray-200">
                    <BlockTitle :title="title" />
                    <CloseButton @click="closeModal" />
                </div>

                <!-- Поиск -->
                <div class="p-6 border-b border-gray-200">
                    <div class="relative">
                        <BaseInput @change-value="handleSearch" :placeholder="'Поиск...'" :name="'search'" />
                        <!-- Иконка поиска (опционально) -->
                        <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Список -->
                <div class="flex-1 overflow-y-auto p-6">
                    <!-- Состояние загрузки -->
                    <div v-if="isLoading" class="flex justify-center items-center py-8">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600"></div>
                    </div>

                    <!-- Нет результатов -->
                    <NoData v-else-if="filteredOptions.length === 0" message="Ничего не найдено" />

                    <!-- Список результатов -->
                    <div v-else class="space-y-2">
                        <button @click="selectOption(option)" v-for="option in filteredOptions"
                            :key="option.id || option.title"
                            class="flex text-left p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors w-full">
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-900">{{ option.title }}</h3>
                                <p v-if="option.subtitle" class="text-sm text-gray-500 mt-1">
                                    {{ option.subtitle }}
                                </p>
                            </div>
                        </button>

                        <div class="text-sm text-gray-500 mt-2 text-center">
                            Найдено: {{ filteredOptions.length }}
                        </div>
                    </div>
                </div>

                <!-- Футер -->
                <div class="p-6 border-t border-gray-200 flex justify-end">
                    <button @click="closeModal" class="px-4 py-2 text-gray-700 hover:text-gray-900 transition-colors">
                        Закрыть
                    </button>
                </div>
            </div>
        </div>
        <InputError :error="ERRORS" />
    </Teleport>
</template>
