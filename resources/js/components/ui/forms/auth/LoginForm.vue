<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { LOGIN_INPUT_VALUES } from "@constants/auth.js";
import InputBlock from '@blocks/InputBlock.vue'
import BaseButton from "@buttons/BaseButton.vue";
import AuthLink from "@links/AuthLink.vue";

const FORM = useForm({
    email: "",
    password: "",
});

function setFormFieldData(data) {
    FORM[data.name] = data.value;
}

function submit() {
    FORM.post(route("login.store"), {
        onSuccess: () => FORM.reset("password"),
    });
}
</script>
<template>
    <div class="flex justify-center w-auto">
        <form @submit.prevent="submit" class="bg-white border border-gray-200 rounded-xl p-8 max-w-md w-full">
            <div class="grid gap-5">
                <InputBlock :name="input.name" :type="input.type" :placeholder="input.placeholder" :label="input.label"
                    v-for="input in LOGIN_INPUT_VALUES" :key="input.label" @change-value="setFormFieldData" />
            </div>

            <BaseButton :text="'Войти'" :icon="'fas fa-user-plus'" :disabled="FORM.processing" />
            <AuthLink :href="'register.create'" :text-sm="'Нет аккаунта?'" :link-text="'Зарегистрироваться'" />
        </form>
    </div>
</template>
