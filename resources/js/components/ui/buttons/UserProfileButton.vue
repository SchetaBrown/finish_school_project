<script setup>
const PROPS = defineProps(["userData"]);
import { computed, ref, onMounted, onBeforeUnmount } from "vue";
import { useBaseForm } from "@composables/useBaseForm.js";

const form = useBaseForm();
let isVisibleList = ref(false);
const dropdownRef = ref(null);

const logout = () => {
    form.submit("post", route("profile.destroy"));
};

const links = computed(() => {
    return [
        {
            icon: "fas fa-user",
            title: "Мой профиль",
            href: "profile.index",
        },
    ];
});

const handleClickOutside = (event) => {
    if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
        isVisibleList.value = false;
    }
};

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
                <span class="text-indigo-600 font-medium text-sm">{{ userData.name[0] }}{{ userData.surname[0] }}</span>
            </div>
            <span class="font-medium text-gray-700">
                {{ userData.name }} {{ userData.surname[0] }}.
            </span>
            <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform"
                :class="{ 'rotate-180': isVisibleList }"></i>
        </button>

        <div v-if="isVisibleList"
            class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-50">
            <div class="px-4 py-3 border-b border-gray-100">
                <p class="text-sm font-medium text-gray-900">
                    {{ userData.name }} {{ userData.surname }}
                </p>
                <p class="text-xs text-gray-400">{{ userData.email }}</p>
            </div>

            <div class="py-2">
                <Link :href="route(link.href)" v-for="link in links" :key="link.title"
                    class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">
                <i class="fas w-4 text-gray-400" :class="link.icon"></i>
                <span>{{ link.title }}</span>
                </Link>
            </div>

            <div class="border-t border-gray-100"></div>

            <form @submit.prevent="logout" class="w-full mt-2">
                <button
                    class="flex items-center space-x-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition w-full">
                    <i class="fas fa-sign-out-alt w-4"></i>
                    <span>Выйти</span>
                </button>
            </form>
        </div>
    </div>
</template>
