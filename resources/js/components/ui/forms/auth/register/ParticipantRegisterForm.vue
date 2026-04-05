<script setup>
const props = defineProps(['schools']);

import { computed, onUnmounted, ref, watch } from "vue";
import BaseButton from "@buttons/BaseButton.vue";
import AuthLink from "@links/AuthLink.vue";
import YandexCaptcha from '@other/YandexCaptcha.vue';
import BlockTitle from '@titles/BlockTitle.vue';
import InputBlock from '@blocks/InputBlock.vue'
import BaseList from '@lists/BaseList.vue'
import { useCustomForm } from '@composables/useCustomForm.js'

const educationDirections = ref([]);

const { form, submit, updateValue, getForm } = useCustomForm({
    surname: "",
    name: "",
    patronymic: "",
    email: "",
    password: "",
    birth_date: "",
    phone: "",
    education_school_id: "",
    education_direction_id: "",
    cours_number: "",
    role: 'участник'
});

const inputs = computed(() => [
    {
        label: "Имя",
        name: "name",
        placeholder: "Иван",
    },
    {
        label: "Фамилия",
        name: "surname",
        placeholder: "Иванов",
    },
    {
        label: "Отчество",
        name: "patronymic",
        placeholder: "Иванович",
    },
    {
        label: "Email",
        name: "email",
        type: "email",
        placeholder: "example@example.com",
    },
    {
        label: "Пароль",
        name: "password",
        type: "password",
        placeholder: "••••••••",
    },
]);

const participantInputs = computed(() => [
    {
        label: 'Телефон',
        type: 'tel',
        name: 'phone',
        placeholder: '+7 (___) ___-__-__',
        component: InputBlock,
    },
    {
        label: 'Учебное заведение',
        name: 'education_school_id',
        component: BaseList,
        options: props.schools,
    },
    {
        label: 'Специальность',
        name: 'education_direction_id',
        component: BaseList,
        options: educationDirections.value,
    },
    {
        label: 'Дата рождения',
        type: 'date',
        name: 'birth_date',
        component: InputBlock,
    },
    {
        label: 'Курс обучения',
        type: 'number',
        name: 'cours_number',
        component: InputBlock,
    },
]);

watch(form, () => {

});

onUnmounted(() => {
    educationDirections.value = [];
});
</script>
<template>
    <form @submit.prevent="submit(route('register.store'))">
        <div class="grid grid-cols-2 gap-5 max-lg:grid-cols-1">
            <InputBlock :name="input.name" :type="input.type" :placeholder="input.placeholder" :label="input.label"
                v-for="input in inputs" :key="input.label" @update-value="updateValue" :form="form" />
        </div>
        <DivideLine />
        <div class="my-4">
            <BlockTitle :title="'Дополнительная информация об участнике'" />
            <div class="grid grid-cols-2 gap-5 max-lg:grid-cols-1">
                <component v-for="input in participantInputs" :key="input.label" :is="input.component"
                    :label="input.label" :name="input.name" :placeholder="input.placeholder" :type="input.type"
                    :options="input.options" @update-value="(data) => {
                        updateValue(data)
                        if (input.name === 'education_school_id') {
                            schools.forEach(school => {
                                if (school.id === data.value) {
                                    educationDirections = school.directions;
                                }
                            });
                        }
                    }" :form="form" :selectTitle="input.selectTitle" :optionTitle="input.optionTitle" />
            </div>
        </div>
        <!-- <YandexCaptcha class="mb-6" /> -->
        <BaseButton :text="'Зарегистрироваться'" :icon="'fas fa-user-plus'"
            class="flex items-center justify-center py-2.5 px-6 font-medium rounded-lg bg-indigo-600 text-sm text-white w-full text-[16px]" />
        <AuthLink :href="'login.create'" :text-sm="'Есть аккаунт?'" :link-text="'Войти'" />
    </form>
</template>
