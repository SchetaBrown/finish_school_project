<script setup>
const props = defineProps(['title', 'description', 'href', 'params', 'icon']);
import { computed } from 'vue';
import { router } from '@inertiajs/vue3';
import BaseModal from './../BaseModal.vue';
import CloseButton from '@buttons/action/CloseButton.vue';

const title = computed(() => {
    return props.title ? props.title : 'Вы действительно хотите выполнить данное действие?';
});

const description = computed(() => {
    return props.description ? props.description : 'Данное действие нельзя будет отменить, данные будут потеряны.'
});

const icon = computed(() => {
    return props.icon ? props.icon : 'fa-trash';
});
</script>
<template>
    <BaseModal btn-text="Добавить" :icon="icon">
        <template #default="{ close }">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Подтверждение действия</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Пожалуйста, подтвердите ваше действие</p>
                </div>
                <CloseButton @click="close" />
            </div>
            <div class="px-6 py-8 text-center">
                <div class="mx-auto w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">{{ title }}</h3>
                <p class="text-sm text-gray-500">{{ description }}</p>
            </div>
            <div
                class="flex items-center justify-end space-x-3 px-6 py-4 border-t border-gray-100 bg-gray-50 rounded-b-xl">
                <button type="button" @click="close"
                    class="px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-lg transition">Отмена</button>
                <form @submit.prevent="router.delete(route(href, params))">
                    <button type="submit"
                        class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition shadow-sm">
                        <i class="fas fa-trash-alt mr-2"></i>
                        Продолжить
                    </button>
                </form>
            </div>
        </template>
    </BaseModal>
</template>
