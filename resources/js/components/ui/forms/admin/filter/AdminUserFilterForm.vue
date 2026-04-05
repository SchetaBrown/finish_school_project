<script setup>
const props = defineProps(['roles']);
import { useFilter } from '@composables/useFilter.js';
import BaseButton from '@buttons/BaseButton.vue'
import BaseList from '@lists/BaseList.vue'
import ResetFilterButton from '@buttons/ResetFilterButton.vue';

const { submit, setField, clear } = useFilter({
    storageKey: 'admin_user_form',
    routeName: 'admin.user.index',
    clearOnUnmount: true,
    only: ['users', 'users_count'],
});
</script>

<template>
    <section class="bg-white rounded-xl border border-gray-200 p-4 mb-6">
        <form @submit.prevent="submit" class="flex flex-col sm:flex-row gap-4 items-end">
            <InputBlock label="Поиск" name="search" placeholder="Поиск пользователей..." class="w-full"
                @update-value="setField" />
            <BaseList label="Роль" name="role" :options="roles.data" @update-value="setField" />
            <BaseButton text="Поиск"
                class="flex items-center justify-center py-2.5 px-6 font-medium rounded-lg bg-indigo-600 text-sm text-white min-h-11" />
            <ResetFilterButton :callback="clear" />
        </form>
    </section>
</template>
