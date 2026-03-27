<script setup>
const props = defineProps(['schools']);
import { computed } from "vue";
import BaseButton from "@buttons/BaseButton.vue";
import AuthLink from "@links/AuthLink.vue";
import YandexCaptcha from '@other/YandexCaptcha.vue';
import BlockTitle from '@titles/BlockTitle.vue';
import PhoneInput from "@inputs/PhoneInput.vue";
import InputBlock from '@blocks/InputBlock.vue'
import SelectBlock from '@blocks/SelectBlock.vue'
import BaseList from '@lists/BaseList.vue'
import { useCustomForm } from '@composables/useCustomForm.js'

const { form, submit, updateValue } = useCustomForm({
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
        component: PhoneInput,
    },
    {
        label: 'Учебное заведение',
        name: 'education_school_id',
        component: BaseList,
        options: props.schools.data,
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
                    :options="input.options" @update-value="updateValue" :form="form" :selectTitle="input.selectTitle"
                    :optionTitle="input.optionTitle" />
            </div>
        </div>
        <!-- <YandexCaptcha class="mb-6" /> -->
        <BaseButton :text="'Зарегистрироваться'" :icon="'fas fa-user-plus'" />
        <AuthLink :href="'login.create'" :text-sm="'Есть аккаунт?'" :link-text="'Войти'" />
    </form>
</template>
