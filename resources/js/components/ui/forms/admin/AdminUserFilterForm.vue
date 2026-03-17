<script setup>
const props = defineProps(['roles']);
import BaseButton from '@buttons/BaseButton.vue'
import { useFilter } from '@composables/useFilter.js';

const { submit, setField, clear } = useFilter({
    storageKey: 'admin_user_form',
    routeName: 'admin.user.index',
    clearOnUnmount: true,
    only: ['users', 'users_count'],
});
</script>

<template>
    <section class="bg-white rounded-xl border border-gray-200 p-4 mb-6">
        <form @submit.prevent="submit" class="flex flex-col sm:flex-row gap-4">
            <InputBlock name="search" placeholder="Поиск пользователей..." class="w-full" @update-value="setField" />
            <SelectBlock :options="roles" @update-value="setField" name="role" />
            <BaseButton text="Поиск" class="max-w-fit px-8" />
        </form>
    </section>
</template>
