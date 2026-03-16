<script setup>
import { useFilter } from '@composables/useFilter.js';
import { computed } from 'vue';

const { form, submit, clear } = useFilter({
    storageKey: 'admin_user_form',
    routeName: 'olympiad.index',
    clearOnUnmount: true,
    only: ['users', 'users_count'],
    onSuccess: (data) => {
        console.log(data)
    },
});

const inputs = computed(() => [
    { name: 'title', label: 'название' },
    { name: 'name', label: 'Имя' },
    { name: 'patronymic', label: 'Отчество' },
]);
</script>

<template>
    <form @submit.prevent="submit" class="flex gap-2">
        <div v-for="input in inputs" :key="input.name">
            <input type="text" :name="input.name" :placeholder="input.label"
                class="bg-white border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300"
                v-model="form[input.name]">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
            Отправить
        </button>

        <button type="button" @click="clear"
            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
            Очистить
        </button>
    </form>
</template>
