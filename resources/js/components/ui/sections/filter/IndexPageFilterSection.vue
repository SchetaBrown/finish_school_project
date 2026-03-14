<script setup>
const PROPS = defineProps(["count", "directions", "statuses"]);
const emit = defineEmits(['update-olympiads']);
import { computed, onMounted, onUnmounted, ref } from "vue";
import { useBaseForm } from '@composables/useBaseForm.js'
import axios from "axios";
import IndexPageSort from "@forms/IndexPageSort.vue";
import PageTitle from "@titles/PageTitle.vue";
import SubmitButton from '@buttons/BaseButton.vue'
import InputBlock from '@blocks/InputBlock.vue'
import SelectBlock from '@blocks/SelectBlock.vue'
import DivideLine from '@other/DivideLine.vue';

const form = useBaseForm({
    title: "",
    direction: "",
    status: "",
});

const OLYMPIADS = ref([]);
const isLoading = ref(false);
const oldForm = form.getForm();
const initialFilters = ref({});

const SELECTS = computed(() => [
    {
        label: "Направление",
        name: "direction",
        options: PROPS.directions,
    },
    {
        label: "Статус",
        name: "status",
        options: PROPS.statuses,
    },
]);

const fetchOlympiads = async (filters = {}) => {
    form.submit('get', route('olympiad.index'), {
        preserveState: true,
    });
    isLoading.value = true;

    try {
        const response = await axios.get('http://127.0.0.1:8000/api/get-olympiads', {
            params: filters
        });

        if (response.status === 200) {
            OLYMPIADS.value = response.data;
            emit('update-olympiads', response.data);
        }
    } catch (error) {
        console.error('Ошибка загрузки:', error);
    } finally {
        isLoading.value = false;
    }
}

const applyFilters = async () => {
    const currentFilters = {
        title: oldForm.title,
        direction: oldForm.direction,
        status: oldForm.status
    };

    await fetchOlympiads(currentFilters);
}

const resetFilters = () => {
    form.submit('get', route('olympiad.index'));
}

onMounted(() => {
    fetchOlympiads();
});

onUnmounted(() => {
    form.reset()
});
</script>

<template>
    <section>
        <PageTitle :title="'Все олимпиады'" :subtitle="'Найди событие по душе и прокачай свои навыки'" />
        <div class="bg-white rounded-xl border border-gray-200 p-5 mb-8 min-h-fit">
            <form @submit.prevent="applyFilters">
                <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <InputBlock :label="'Поиск'" :name="'title'"
                        :icon="'fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm'"
                        :placeholder="'Введите название олимпиады...'"
                        @change-value="data => form.updateFormFieldValue(data)" />
                    <SelectBlock v-for="select in SELECTS" :label="select.label" :name="select.name"
                        :options="select.options" :key="select.name"
                        @select-value="data => form.updateFormFieldValue(data)" />
                </div>
                <DivideLine class="my-4" />
                <div class="flex justify-end gap-6">
                    <button type="button" @click="resetFilters"
                        class="px-6 py-2.5 text-gray-600 hover:text-gray-900 transition" :disabled="isLoading">
                        Сбросить
                    </button>
                    <SubmitButton :text="'Применить фильтры'" class="max-w-fit" :disabled="isLoading" />
                </div>
            </form>
        </div>

        <!-- Индикатор загрузки -->
        <div v-if="isLoading" class="text-center py-8">
            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600"></div>
            <p class="mt-2 text-gray-600">Загрузка олимпиад...</p>
        </div>

        <!-- Результаты -->
        <IndexPageSort :count="OLYMPIADS.length" :olympiads="OLYMPIADS" />
    </section>
</template>
