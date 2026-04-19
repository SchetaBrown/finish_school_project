<script setup>
import BaseButton from "@buttons/BaseButton.vue";
import AuthLink from "@links/AuthLink.vue";
import YandexCaptcha from "@other/YandexCaptcha.vue";
import { computed } from "vue";
import { useCustomForm } from '@composables/useCustomForm.js'

const { form, updateValue, submit } = useCustomForm({
    email: "",
    password: "",
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
            class="bg-white border border-gray-200 rounded-xl p-8 max-w-md w-full space-y-6">
            <div class="grid gap-5">
                <InputBlock v-for="input in inputs" :name="input.name" :type="input.type"
                    :placeholder="input.placeholder" :label="input.label" :key="input.label" :errors="123"
                    @update-value="updateValue" :form="form" />
            </div>
            <BaseButton :text="'Войти'" :icon="'fas fa-user-plus'"
                class="flex items-center justify-center py-2.5 px-6 font-medium rounded-lg bg-indigo-600 text-[16px] text-white w-full" />
            <AuthLink :href="'register.create'" :text-sm="'Нет аккаунта?'" :link-text="'Зарегистрироваться'" />
        </form>
    </div>
</template>
