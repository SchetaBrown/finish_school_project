<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import Label from '@other/Label.vue';

const props = defineProps(['label', 'name', 'baseTitle', 'options']);
const emit = defineEmits(['update-value']);

const isOpen = ref(false);
const searchQuery = ref('');
const selectedOption = ref(null);

const filteredOptions = computed(() => {
    if (!searchQuery.value.trim()) {
        return props.options;
    }

    return props.options.filter(option =>
        option.title.toLowerCase().includes(searchQuery.value.toLowerCase())
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
    const dropdown = document.querySelector('.dropdown-container');
    if (dropdown && !dropdown.contains(event.target)) {
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
</script>

<template>
    <div class="dropdown-container relative flex flex-col gap-1">
        <Label :label="label" :name="name" />

        <button @click="toggleDropdown"
            class="w-full px-4 py-2.5 bg-gray-50 border rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition min-h-12.5 max-h-12.5 flex justify-between items-center border-gray-200"
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

                <button v-for="option in filteredOptions" :key="option.id" @click="selectOption(option)"
                    class="w-full px-4 py-2 text-left hover:bg-gray-50 transition-colors focus:outline-none focus:bg-gray-50"
                    :class="{ 'bg-indigo-50 text-indigo-700': selectedOption?.id === option.id }" role="option"
                    :aria-selected="selectedOption?.id === option.id">
                    {{ option.title }}
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>
.dropdown-container {
    position: relative;
}

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
