<script setup>
const props = defineProps(['cities', 'directions']);

import { useCustomForm } from '@composables/useCustomForm.js';
const { form, submit, updateValue } = useCustomForm({
    full_name: '',
    short_name: '',
    inn: '',
    phone: '',
    director_surname: '',
    director_name: '',
    director_patronymic: '',
    email: '',
    max_player_count: '',
    city: '',
    education_directions: [],
});

import InputBlock from '@blocks/InputBlock.vue'
import BaseButton from '@buttons/BaseButton.vue';
import BaseList from '@lists/BaseList.vue'
import { computed } from 'vue';
import { router } from '@inertiajs/vue3';
const inputs = computed(() => [
    {
        label: 'Полное название учебного заведения',
        name: 'full_name',
        placeholder: 'Введите название',
        component: InputBlock,
    },
    {
        label: 'Сокращённое название учебного заведения',
        name: 'short_name',
        placeholder: 'Введите название',
        component: InputBlock,
    },
    {
        label: 'ИНН',
        name: 'inn',
        placeholder: 'Введите название',
        component: InputBlock,
    },
    {
        label: 'Телефон',
        name: 'phone',
        placeholder: 'Введите название',
        component: InputBlock,
    },
    {
        label: 'Фамилия директора',
        name: 'director_surname',
        placeholder: 'Введите название',
        component: InputBlock,
    },
    {
        label: 'Имя директора',
        name: 'director_name',
        placeholder: 'Введите название',
        component: InputBlock,
    },
    {
        label: 'Отчество директора',
        name: 'director_patronymic',
        placeholder: 'Введите название',
        component: InputBlock,
    },
    {
        label: 'Email',
        name: 'email',
        type: 'email',
        placeholder: 'Введите название',
        component: InputBlock,
    },
    {
        label: 'Максимальное количество участников в олимпиаде',
        name: 'max_player_count',
        type: 'number',
        placeholder: 'Введите число',
        component: InputBlock,
        subtitle: 'Необязательно (по стандарту, устанавливается 5 участников)'
    },
    {
        label: 'Город',
        name: 'city',
        component: InputBlock,
    },
]);


</script>
<template>
    <form @submit.prevent="submit(route('admin.education.school.store'))">
        <Container>
            <div class="space-y-5 grid grid-cols-2 gap-x-4">
                <component :is="input.component" :key="input.label" v-for="input in inputs" :label="input.label"
                    :type="input.type" :options="input.options" :name="input.name" :placeholder="input.placeholder"
                    @update-value="updateValue" :form="form" :subtitle="input.subtitle" />
            </div>
            <div class="flex justify-end gap-3">
                <BaseButton type="button" text="Отмена" @click="router.get(route('admin.education.school.index'))"
                    class="px-6 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-lg transition" />
                <BaseButton icon="fas fa-plus" text="Создать заведение" />
            </div>
        </Container>
        <div class="flex flex-col mt-5">
            <PageTitle title="Учебные направления" />
            <div class="grid grid-cols-4 gap-3">
                <button type="button" @click="() => {
                    const field = form.education_directions;
                    const directionId = direction.id;
                    if (field.includes(directionId)) {
                        const index = field.indexOf(directionId);

                        if (index !== -1) {
                            field.splice(index, 1);
                        }
                    } else {
                        if (!field.includes(directionId)) {
                            field.push(directionId);
                        }
                    }
                }" v-for="direction in directions" :key="direction.id">
                    <Container :class="[
                        `h-full`,
                        form.education_directions.includes(direction.id) ? 'border-indigo-500' : '',
                    ]">
                        <span class="text-center">
                            {{ direction.code }}
                            {{ direction.title }}
                        </span>
                    </Container>
                </button>
            </div>
        </div>
    </form>
</template>
