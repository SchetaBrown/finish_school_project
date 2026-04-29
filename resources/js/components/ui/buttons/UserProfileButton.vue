<script setup>
import { computed, ref, onMounted, onBeforeUnmount, inject } from "vue";
import { useCustomForm } from "@composables/useCustomForm.js";

const { submit } = useCustomForm();
let isVisibleList = ref(false);
const dropdownRef = ref(null);

const userData = inject('userData');

const handleClickOutside = (event) => {
    if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
        isVisibleList.value = false;
    }
};

const isAvailableProfile = computed(() => {
    return userData.role === 'Руководитель' || userData.role === 'Участник';
});

onMounted(() => {
    document.addEventListener("click", handleClickOutside);
});

onBeforeUnmount(() => {
    document.removeEventListener("click", handleClickOutside);
});
</script>

<template>
    <div class="relative" ref="dropdownRef">
        <button @click="isVisibleList = !isVisibleList"
            class="flex items-center space-x-3 pl-3 pr-2 py-2 rounded-lg hover:bg-gray-50 transition"
            :class="{ 'bg-gray-50': isVisibleList }">
            <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                <span class="text-indigo-600 font-medium text-sm">{{ userData.initial }}</span>
            </div>
            <span class="font-medium text-gray-700 max-lg:hidden">
                {{ userData.fullName }}
            </span>
            <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform"
                :class="{ 'rotate-180': isVisibleList }"></i>
        </button>

        <div v-if="isVisibleList"
            class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-50">
            <div class="px-4 py-3 border-b border-gray-100">
                <p class="text-sm font-medium text-gray-900">
                    {{ userData.fullName }}
                </p>
                <p class="text-xs text-gray-400">{{ userData.email }}</p>
            </div>

            <div class="py-1" v-if="isAvailableProfile">
                <Link :href="route('profile.index')"
                    class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">
                <i class="fas fa-user w-4 text-gray-400"></i>
                <span>Профиль</span>
                </Link>
            </div>

            <div class="py-1" v-if="userData.role === 'Администратор'">
                <Link :href="route('admin.index')"
                    class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">
                <i class="fas w-4 text-gray-400"></i>
                <span>Админ-панель</span>
                </Link>
            </div>

            <div class="border-t border-gray-100"></div>

            <form @submit.prevent="submit(route('profile.destroy'))" class="w-full mt-2">
                <button
                    class="flex items-center space-x-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition w-full">
                    <i class="fas fa-sign-out-alt w-4"></i>
                    <span>Выйти</span>
                </button>
            </form>
        </div>
    </div>
</template>
