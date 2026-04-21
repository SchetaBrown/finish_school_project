<script setup>
import { ref, computed, onMounted, onUnmounted, watch } from 'vue';
import Label from '@other/Label.vue';
import InputError from "@other/InputError.vue"

const props = defineProps(['label', 'name', 'baseTitle', 'options', 'form', 'value']);
const emit = defineEmits(['update-value']);

const dropdownId = ref(`dropdown-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`);
const dropdownRef = ref(null);

const isOpen = ref(false);
const isDirty = ref(false);
const searchQuery = ref('');
const form = props?.form;

const selectedOption = ref(null);

const findSelectedOption = (val) => {
    if (!val) return null;

    if (typeof val === 'object' && val.id) {
        return val;
    }

    if (props.options) {
        const searchId = String(val);
        return props.options.find(option => String(option.id) === searchId) || null;
    }

    return null;
};

watch(() => props.value, (newValue) => {
    const option = findSelectedOption(newValue);
    if (option) {
        selectedOption.value = option;
    } else {
        selectedOption.value = null;
    }
}, { immediate: true });

watch(() => props.options, (newOptions) => {
    if (newOptions && props.value && typeof props.value !== 'object') {
        const option = findSelectedOption(props.value);
        if (option && selectedOption.value?.id !== option.id) {
            selectedOption.value = option;
        }
    }
}, { deep: true });

const error = computed(() => {
    return form?.errors[props.name];
});

const filteredOptions = computed(() => {
    if (!props.options) return [];

    if (!searchQuery.value.trim()) {
        return props.options;
    }

    return props.options.filter(option =>
        option.title?.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

const buttonText = computed(() => {
    if (selectedOption.value) {
        return selectedOption.value.title;
    }
    return props.baseTitle ?? 'Выберите опцию';
});

const selectOption = (option) => {
    selectedOption.value = option;

    emit('update-value', {
        name: props.name,
        value: option.id
    });

    closeDropdown();
};


const closeDropdown = () => {
    isOpen.value = false;
    searchQuery.value = '';
};

const toggleDropdown = () => {
    isOpen.value = !isOpen.value;
    if (!isOpen.value) {
        searchQuery.value = '';
    }
};

const handleClickOutside = (event) => {
    if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
        closeDropdown();
    }
};

const handleEscape = (event) => {
    if (event.key === 'Escape' && isOpen.value) {
        closeDropdown();
    }
};

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
    document.addEventListener('keydown', handleEscape);
});

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside);
    document.removeEventListener('keydown', handleEscape);
});

watch(() => selectedOption.value, () => {
    isDirty.value = false;
});

watch(error, () => {
    isDirty.value = true;
});
</script>

<template>
    <div ref="dropdownRef" :data-dropdown-id="dropdownId" class="relative flex flex-col gap-1">
        <Label :label="label" :name="name" />

        <button @click="toggleDropdown"
            class="w-full px-4 py-2.5 bg-gray-50 border rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition min-h-11 max-h-11 flex justify-between items-center border-gray-200"
            type="button" :aria-expanded="isOpen" aria-haspopup="listbox">
            <span class="truncate mr-3">{{ buttonText }}</span>
            <svg class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': isOpen }" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div v-if="isOpen"
            class="absolute top-full left-0 right-0 mt-1 bg-white border rounded-lg shadow-lg z-50 border-gray-200"
            role="listbox">
            <div class="p-2 border-b border-gray-200">
                <input v-model="searchQuery" type="text" placeholder="Поиск..."
                    class="w-full px-3 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    @click.stop />
            </div>

            <div class="max-h-60 overflow-y-auto">
                <div v-if="filteredOptions.length === 0" class="px-4 py-3 text-gray-500 text-center">
                    Ничего не найдено
                </div>

                <button v-for="option in filteredOptions" :key="option.id" @click="selectOption(option)" type="button"
                    class="w-full px-4 py-2 text-left hover:bg-gray-50 transition-colors focus:outline-none focus:bg-gray-50"
                    :class="{ 'bg-indigo-50 text-indigo-700': selectedOption?.id === option.id }" role="option"
                    :aria-selected="selectedOption?.id === option.id">
                    {{ option.title }}
                </button>
            </div>
        </div>
        <InputError :error="error" :is-dirty="isDirty" />
    </div>
</template>

<style scoped>
.absolute {
    animation: dropdownFadeIn 0.2s ease;
}

@keyframes dropdownFadeIn {
    from {
        opacity: 0;
        transform: translateY(-8px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
