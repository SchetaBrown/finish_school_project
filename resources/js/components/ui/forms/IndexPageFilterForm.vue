<script setup>
const props = defineProps(["directions", "statuses"]);
import { computed } from "vue";
import SubmitButton from '@buttons/BaseButton.vue'
import InputBlock from '@blocks/InputBlock.vue'
import SelectBlock from '@blocks/SelectBlock.vue'
import DivideLine from '@other/DivideLine.vue';
import Container from '@other/Container.vue'
import { useFilter } from '@composables/useFilter.js';

const { submit, clear, setField } = useFilter({
    storageKey: 'olympiad_form',
    routeName: 'olympiad.index',
    clearOnUnmount: true,
    only: ['olympiads'],
});

const inputs = computed(() => [
    {
        label: 'Поиск',
        name: 'title',
        component: InputBlock,
        icon: 'fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm',
    },
    {
        label: 'Направление',
        name: 'direction',
        component: SelectBlock,
        options: props.directions
    },
    {
        label: 'Статус',
        name: 'status',
        component: SelectBlock,
        options: props.statuses
    },
]);
</script>

<template>
    <Container class="mb-8">
        <form @submit.prevent="submit" class="flex flex-col gap-2">
            <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <component v-for="input in inputs" :key="input.name" :is="input.component" :label="input.label"
                    :name="input.name" :icon="input.icon" :options="input.options" @update-value="setField" />
            </div>
            <DivideLine />
            <div class="flex w-full justify-end">
                <button type="button" @click="clear" class="px-6 py-2.5 text-gray-600 hover:text-gray-900 transition">
                    Сбросить
                </button>
                <SubmitButton class="max-w-fit px-6" :text="'Применить фильтры'" />
            </div>
        </form>
    </Container>
</template>
