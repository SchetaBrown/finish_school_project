<script setup>
const props = defineProps(['title', 'code', 'id']);
import BaseModal from '../../BaseModal.vue';
import CloseButton from '@buttons/action/CloseButton.vue';
import InputBlock from '@blocks/InputBlock.vue'
import { computed } from 'vue';
import { useCustomForm } from '@composables/useCustomForm.js'

const { form, updateValue, submit } = useCustomForm({
    code: props.code,
    title: props.title,
});

const inputs = computed(() => [
    {
        label: 'Код',
        name: 'code',
        placeholder: '09.02.08',
        component: InputBlock,
        value: props.code,
    },
    {
        label: 'Название',
        name: 'title',
        placeholder: 'Например: Разработчик веб и мультимедийных приложений',
        component: InputBlock,
        value: props.title,
    },
]);
</script>
<template>
    <BaseModal icon="fas fa-edit">
        <template #default="{ close }">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Создание нового учебного направления</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Заполните необходимые поля</p>
                </div>
                <CloseButton @click="close" />
            </div>
            <form @submit.prevent="() => {
                submit(route('admin.education.direction.update', {
                    direction: id,
                }), 'put');
                close();
            }">
                <div class="grid grid-cols-2 gap-3 px-6 py-5 space-y-4 max-lg:grid-cols-1">
                    <component v-for="input in inputs" :is="input.component" :key="input.label"
                        :placeholder="input.placeholder" :label="input.label" :name="input.name" :type="input.type"
                        :form="form" :options="input.options" @update-value="updateValue" :value="input.value" />
                </div>
                <div
                    class="flex items-center justify-end space-x-3 px-6 py-4 border-t border-gray-100 bg-gray-50 rounded-b-xl">
                    <button type="button" @click="close"
                        class="px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-lg transition">
                        Отмена
                    </button>
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition shadow-sm">
                        Обновить
                    </button>
                </div>
            </form>
        </template>
    </BaseModal>
</template>
