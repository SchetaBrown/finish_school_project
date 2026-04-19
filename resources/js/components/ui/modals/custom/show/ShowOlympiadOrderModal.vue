<script setup>
const props = defineProps(['olympiad']);
import { computed, ref } from 'vue';
import { router } from '@inertiajs/vue3';
import CloseButton from '@buttons/action/CloseButton.vue';
import Status from '@other/Status.vue'

const isOpen = ref(false);

const close = () => {
    isOpen.value = false;
}

const olympiadData = computed(() => {
    return props?.olympiad?.olympiad;
});

const olympiadDescription = computed(() => {
    return `${olympiadData.value.direction} • ${olympiadData.value.register_start_date} - ${olympiadData.value.register_end_date}`;
});

const modalData = computed(() => [
    {
        icon: 'fa-info-circle',
        label: 'Статус олимпиады',
        text: olympiadData.value.status,
    },
    {
        icon: 'fa-info-circle',
        label: 'Статус заявки',
        text: props.olympiad.status,
    },
]);
</script>
<template>
    <button class="olympiad-card flex items-center justify-between p-4 bg-gray-50 rounded-lg w-full"
        @click="isOpen = !isOpen">
        <div class="flex items-start space-x-3 flex-1">
            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-trophy text-indigo-600"></i>
            </div>
            <div class="flex-1">
                <h3 class="font-medium text-gray-900 text-left">{{ olympiadData.title }}</h3>
                <p class="text-xs text-gray-400 text-left">{{ olympiadDescription }}</p>
                <div class="flex flex-wrap items-center gap-2 mt-2">
                    <Status :status="olympiadData.status" font-size="12" />
                    <Status :status="olympiad.status" font-size="12" />
                </div>
            </div>
        </div>
    </button>
    <Teleport to="body">
        <div v-if="isOpen" class="fixed inset-0 z-50 flex items-center justify-center border border-gray-100">
            <div class="absolute inset-0 backdrop-blur-sm" @click="close"></div>
            <div
                class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 transform transition-all duration-300 scale-100 opacity-100">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">{{ olympiadData.title }}</h3>
                    <CloseButton @click="close" />
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-start space-x-3" v-for="input in modalData" :key="input.label">
                        <i class="text-indigo-400 w-5 mt-0.5" :class="`fas ${input.icon}`" v-if="input.icon"></i>
                        <div>
                            <p class="text-xs text-gray-400">{{ input.label }}</p>
                            <p class="text-sm text-gray-700">{{ input.text }}</p>
                        </div>
                    </div>
                </div>
                <div
                    class="flex items-center justify-end space-x-3 px-6 py-4 border-t border-gray-100 bg-gray-50 rounded-b-xl">
                    <button type="button" @click="close"
                        class="px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-lg transition">
                        Закрыть
                    </button>
                    <Link :href="route('olympiad.show', { olympiad: olympiadData.slug })"
                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition shadow-sm inline-flex items-center text-sm">
                    <i class="fas fa-external-link-alt mr-2"></i>
                    Перейти к олимпиаде
                    </Link>
                </div>
            </div>
        </div>
    </Teleport>
</template>

<style scoped>
.olympiad-card {
    transition: all 0.2s ease;
}
</style>
