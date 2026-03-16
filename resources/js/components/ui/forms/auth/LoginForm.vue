<script setup>
import InputBlock from '@blocks/InputBlock.vue'
import BaseButton from "@buttons/BaseButton.vue";
import AuthLink from "@links/AuthLink.vue";
import YandexCaptcha from "@other/YandexCaptcha.vue";
import { computed } from "vue";
import { useCustomForm } from '@composables/useCustomForm.js'

const { updateValue, submit } = useCustomForm({
    surname: "",
    name: "",
    patronymic: "",
    email: "",
    phone: "",
    password: "",
    education_school_title: "",
});
const inputs = computed(() => [
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
    <div class="flex justify-center w-auto">
        <form @submit.prevent="submit(route('login.store'))"
            class="bg-white border border-gray-200 rounded-xl p-8 max-w-md w-full">
            <div class="grid gap-5">
                <InputBlock v-for="input in inputs" :name="input.name" :type="input.type"
                    :placeholder="input.placeholder" :label="input.label" :key="input.label"
                    @update-value="updateValue" />
            </div>
            <!-- <YandexCaptcha class="mt-5"></YandexCaptcha> -->
            <BaseButton :text="'Войти'" :icon="'fas fa-user-plus'" class="mt-6" />
            <AuthLink :href="'register.create'" :text-sm="'Нет аккаунта?'" :link-text="'Зарегистрироваться'" />
        </form>
    </div>
</template>
