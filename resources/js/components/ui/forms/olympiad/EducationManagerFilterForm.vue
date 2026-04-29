<script setup>
const props = defineProps(['statuses', 'slug']);
import { useFilter } from '@composables/useFilter.js';
import BaseButton from '@buttons/BaseButton.vue'
import ResetFilterButton from '@buttons/ResetFilterButton.vue';
import SelectBlock from '@blocks/SelectBlock.vue'

const { submit, setField, clear } = useFilter({
    storageKey: 'olympiad_student_orders_index',
    routeName: 'olympiad.student-orders.index',
    optionName: props.slug,
    clearOnUnmount: true,
    only: ['orders'],
});
</script>

<template>
    <section class="bg-white rounded-xl border border-gray-200 p-4 mb-6">
        <form @submit.prevent="submit" class="flex flex-col sm:flex-row gap-4 items-end">
            <InputBlock name="search" placeholder="Поиск по фамилии, имени или email..." class="w-full"
                @update-value="setField" />
            <SelectBlock name="status" :options="statuses" @update-value="setField" />
            <BaseButton text="Поиск"
                class="flex items-center justify-center py-2.5 px-6 font-medium rounded-lg bg-indigo-600 text-sm text-white min-h-11" />
            <ResetFilterButton :callback="clear" />
        </form>
    </section>
</template>
