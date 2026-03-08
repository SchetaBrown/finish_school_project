<script setup>
import { LOGIN_INPUT_VALUES } from "@constants/auth.js";
import InputBlock from '@blocks/InputBlock.vue'
import BaseButton from "@buttons/BaseButton.vue";
import AuthLink from "@links/AuthLink.vue";
import { useBaseForm } from "../../../../composables/useBaseForm";

const form = useBaseForm({
    email: "",
    password: "",
});

</script>
<template>
    <div class="flex justify-center w-auto">
        <form @submit.prevent="form.submit('post', route('login.store'))"
            class="bg-white border border-gray-200 rounded-xl p-8 max-w-md w-full">
            <div class="grid gap-5">
                <InputBlock :name="input.name" :type="input.type" :placeholder="input.placeholder" :label="input.label"
                    :error="form.getAllErrors(input.name)" v-for="input in LOGIN_INPUT_VALUES" :key="input.label"
                    @change-value="data => {
                        form.updateFormFieldValue(data.name, data.value)
                    }" />
            </div>

            <BaseButton :text="'Войти'" :icon="'fas fa-user-plus'" :disabled="form.processing" />
            <AuthLink :href="'register.create'" :text-sm="'Нет аккаунта?'" :link-text="'Зарегистрироваться'" />
        </form>
    </div>
</template>
