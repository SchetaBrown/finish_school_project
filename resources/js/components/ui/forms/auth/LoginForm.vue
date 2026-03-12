<script setup>
import { LOGIN_INPUT_VALUES } from "@constants/auth.js";
import InputBlock from '@blocks/InputBlock.vue'
import BaseButton from "@buttons/BaseButton.vue";
import AuthLink from "@links/AuthLink.vue";
import { useBaseForm } from "@composables/useBaseForm";
import YandexCaptcha from "@other/YandexCaptcha.vue";

const form = useBaseForm({
    email: "",
    password: "",
});

function login() {
    form.submit('post', route('login.store'), {
        preserveState: true,
        preserveScroll: true,
    })
}
</script>
<template>
    <div class="flex justify-center w-auto">
        <form @submit.prevent="login" class="bg-white border border-gray-200 rounded-xl p-8 max-w-md w-full">
            <div class="grid gap-5">
                <InputBlock :name="input.name" :type="input.type" :placeholder="input.placeholder" :label="input.label"
                    :error="form.getAllErrors(input.name)" v-for="input in LOGIN_INPUT_VALUES" :key="input.label"
                    @change-value="data => {
                        form.updateFormFieldValue(data)
                    }" />
            </div>
            <YandexCaptcha class="mt-5"></YandexCaptcha>
            <BaseButton :text="'Войти'" :icon="'fas fa-user-plus'" :disabled="form.processing" class="mt-6" />
            <AuthLink :href="'register.create'" :text-sm="'Нет аккаунта?'" :link-text="'Зарегистрироваться'" />
        </form>
    </div>
</template>

<style scoped></style>
