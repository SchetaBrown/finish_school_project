<script setup>
const props = defineProps(['directions', 'statuses']);
import BaseButton from '@buttons/BaseButton.vue'
import { useFilter } from '@composables/useFilter.js';
import BaseList from '@lists/BaseList.vue'
import ResetFilterButton from '@buttons/ResetFilterButton.vue';

const { submit, setField, clear } = useFilter({
    storageKey: 'admin_olympiad_form',
    routeName: 'admin.olympiad.index',
    clearOnUnmount: true,
    only: ['olympiads', 'olympiads_count'],
});
</script>

<template>
    <section class="bg-white rounded-xl border border-gray-200 p-4 mb-6">
        <form @submit.prevent="submit" class="flex flex-col sm:flex-row gap-4 items-end">
            <InputBlock label="Поиск" name="title" placeholder="Поиск олимпиад..." class="w-full"
                @update-value="setField" />
            <BaseList label="Направление" name="direction" :options="directions" @update-value="setField" />
            <BaseList label="Статус" name="status" :options="statuses" @update-value="setField" />
            <BaseButton text="Поиск"
                class="flex items-center justify-center py-2.5 font-medium rounded-lg bg-indigo-600 text-sm text-white min-h-11 px-8" />
            <ResetFilterButton :callback="clear" />
        </form>
    </section>
</template>
