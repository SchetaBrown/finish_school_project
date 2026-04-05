<script setup>
const props = defineProps(['directions', 'managers', 'types']);
import { useCustomForm } from '@composables/useCustomForm.js';
import InputBlock from '@blocks/InputBlock.vue'
import BaseButton from '@buttons/BaseButton.vue';
import BaseList from '@lists/BaseList.vue'
import Label from '@other/Label.vue'
import { computed } from 'vue';
import { router } from '@inertiajs/vue3';

const { form, submit, updateValue } = useCustomForm({
    title: '',
    description: '',
    max_player_register_count: '',
    register_start_date: '',
    register_end_date: '',
    slug: '',
    start_date: '',
    end_date: '',
    olympiad_manager_id: '',
    olympiad_direction_id: '',
    olympiad_types: [],
});

const olympiadMetaInputs = computed(() => [
    {
        label: 'Название олимпиады',
        name: 'title',
        placeholder: 'Введите название',
        component: InputBlock,
    },
    {
        label: 'Описание',
        name: 'description',
        placeholder: 'Введите название',
        component: InputBlock,
    },
]);
const inputs = computed(() => [
    {
        label: 'Максимальное количество игроков от команды',
        name: 'max_player_register_count',
        placeholder: 'Введите название',
        component: InputBlock,
        type: 'number',
    },
    {
        label: 'Дата начала регистрации',
        name: 'register_start_date',
        placeholder: 'Введите название',
        component: InputBlock,
        type: 'datetime-local',
    },
    {
        label: 'Дата окончания регистрации',
        name: 'register_end_date',
        placeholder: 'Введите название',
        component: InputBlock,
        type: 'datetime-local',
    },
    {
        label: 'Дата начала олимпиады',
        name: 'start_date',
        placeholder: 'Введите название',
        component: InputBlock,
        type: 'datetime-local',
    },
    {
        label: 'Дата окончания олимпиады',
        name: 'end_date',
        placeholder: 'Введите название',
        component: InputBlock,
        type: 'datetime-local',
    },
]);

const lists = computed(() => [
    {
        label: 'Ответственный',
        name: 'olympiad_manager_id',
        component: BaseList,
        options: props.managers.data,
    },
    {
        label: 'Направление',
        name: 'olympiad_direction_id',
        component: BaseList,
        options: props.directions.data,
    },
]);
</script>
<template>
    <Container>
        <form @submit.prevent="submit(route('admin.olympiad.store'))" class="space-y-5">
            <component :is="input.component" :key="input.label" v-for="input in olympiadMetaInputs" :label="input.label"
                :name="input.name" :placeholder="input.placeholder" @update-value="updateValue" :form="form" />
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <component :is="input.component" :key="input.label" v-for="input in inputs" :label="input.label"
                    :name="input.name" :placeholder="input.placeholder" :type="input.type" :form="form"
                    @update-value="updateValue" />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <component :is="list.component" :key="list.label" v-for="list in lists" :label="list.label"
                    :name="list.name" :options="list.options" :form="form" @update-value="updateValue" />
            </div>
            <div class="flex flex-col gap-2">
                <Label label="Тип участия" />
                <div class="flex gap-2">
                    <InputBlock name="olympiad_types" type="checkbox" v-for="type in types.data" :key="type.id"
                        :checkboxOption="type.id" :placeholder="type.title" @update-value="updateValue" />
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <BaseButton type="button" text="Отмена" @click="router.get(route('admin.olympiad.index'))"
                    class="px-6 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-lg transition" />
                <BaseButton icon="fa-plus" text="Создать олимпиаду" />
            </div>
        </form>
    </Container>
</template>
