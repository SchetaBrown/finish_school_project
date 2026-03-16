<script setup>
const PROPS = defineProps(['schools']);
import { PHONE_INPUT_VALUE } from "@constants/auth.js";
import { computed } from "vue";
import InputBlock from '@blocks/InputBlock.vue'
import BaseButton from "@buttons/BaseButton.vue";
import AuthLink from "@links/AuthLink.vue";
import DivideLine from "@other/DivideLine.vue";
import YandexCaptcha from '@other/YandexCaptcha.vue';
import BlockTitle from '@titles/BlockTitle.vue';
import PhoneInput from "@inputs/PhoneInput.vue";
import SelectBlock from '@blocks/SelectBlock.vue'
import { useCustomForm } from '@composables/useCustomForm.js'

const { submit, updateValue } = useCustomForm({
    surname: "",
    name: "",
    patronymic: "",
    email: "",
    phone: "",
    password: "",
    education_school_title: "",
    cours_number: "",
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
</script>
<template>
    <form @submit.prevent="submit">
        <div class="grid grid-cols-2 gap-5 max-lg:grid-cols-1">
            <InputBlock :name="input.name" :type="input.type" :placeholder="input.placeholder" :label="input.label"
                v-for="input in inputs" :key="input.label" @update-value="updateValue" />
        </div>
        <DivideLine />
        <div class="my-4">
            <BlockTitle :title="'Дополнительная информация об участнике'" />
            <div class="grid grid-cols-2 gap-5 max-lg:grid-cols-1">
                <PhoneInput :label="PHONE_INPUT_VALUE.label" :name="PHONE_INPUT_VALUE.name"
                    @update-value="updateValue" />
                <SelectBlock :label="'Специальность'" :name="'education_direction_title'" @update-value="updateValue" />
            </div>
        </div>
        <YandexCaptcha class="mb-6" />
        <BaseButton :text="'Зарегистрироваться'" :icon="'fas fa-user-plus'" />
        <AuthLink :href="'login.create'" :text-sm="'Есть аккаунт?'" :link-text="'Войти'" />
    </form>
</template>
