<script setup>
const PROPS = defineProps(["directions", "statuses"]);
import { useBaseForm } from '@composables/useBaseForm.js'
import InputBlock from '@blocks/InputBlock.vue'
import SelectBlock from '@blocks/SelectBlock.vue'
import DivideLine from '@other/DivideLine.vue';
import SubmitButton from '@buttons/BaseButton.vue'

const form = useBaseForm({
    title: "",
    direction: "",
    status: "",
});

const SELECTS = [
    {
        label: "Направление",
        name: "direcion",
        options: PROPS.directions,
    },
    {
        label: "Статус",
        name: "status",
        options: PROPS.statuses,
    },
];

function submit() {
    form.submit('get', route('olympiad.index'), {
        preserveState: true
    })
}
</script>
<template>
    <div class="bg-white rounded-xl border border-gray-200 p-5 mb-8 min-h-fit">
        <form @submit.prevent="submit">
            <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <InputBlock :label="'Поиск'" :name="'title'"
                    :icon="'fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm'"
                    :placeholder="'Введите название олимпиады...'" @change-value="data => {
                        form.updateFormFieldValue(data)
                    }">
                </InputBlock>
                <SelectBlock v-for="select in SELECTS" :label="select.label" :name="select.name"
                    :options="select.options" :key="select.title" @select-value="(data) => {
                        form.updateFormFieldValue(data)
                    }" />
            </div>
            <DivideLine class="my-4" />
            <div class="flex justify-end gap-6">
                <SubmitButton :text="'Применить фильтры'" class="max-w-fit" />
            </div>
        </form>
    </div>
</template>
