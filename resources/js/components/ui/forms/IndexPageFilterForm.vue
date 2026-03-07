<script setup>
import BaseInput from "@inputs/BaseInput.vue";
import InputBlock from '@blocks/InputBlock.vue'
import BaseSelect from "@selects/BaseSelect.vue";
import { useForm } from "@inertiajs/inertia-vue3";
const PROPS = defineProps(["directions", "statuses"]);

const SEARCH_FORM = useForm({
    title: "",
    direction: "",
    status: "",
});

function submit() {

}

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

function updateSearchFormField(data) {
    const VALUE = data.value;
    const NAME = data.name;

    SEARCH_FORM[NAME] = VALUE;
}
</script>
<template>
    <div class="bg-white rounded-xl border border-gray-200 p-5 mb-8 min-h-fit">
        <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <InputBlock :label="'Поиск'" :name="'title'"
                :icon="'fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm'"
                :placeholder="'Введите название олимпиады...'" v-model="SEARCH_FORM.title">
            </InputBlock>
            <BaseSelect v-for="select in SELECTS" :label="select.label" :name="select.name" :options="select.options"
                :key="select.title" />
        </form>
    </div>
</template>
