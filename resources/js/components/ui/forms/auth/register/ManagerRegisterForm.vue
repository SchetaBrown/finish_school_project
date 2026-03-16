<script setup>
const PROPS = defineProps(['schools']);
import { REGISTER_INPUT_VALUES } from "@constants/auth.js";
import { PHONE_INPUT_VALUE } from "@constants/auth.js";
import PhoneInput from "@inputs/PhoneInput.vue";
import BaseButton from "@buttons/BaseButton.vue";
import YandexCaptcha from "@other/YandexCaptcha.vue";
import AuthLink from "@links/AuthLink.vue";
import BlockTitle from '@titles/BlockTitle.vue'
import InputBlock from "@blocks/InputBlock.vue";
import DivideLine from "@other/DivideLine.vue";
import { useCustomForm } from "@composables/useCustomForm";

const { updateValue, submit } = useCustomForm({
    surname: "",
    name: "",
    patronymic: "",
    email: "",
    phone: "",
    password: "",
    education_school_title: "",
});
</script>
<template>
    <form @submit.prevent="submit">
        <div class="grid grid-cols-2 gap-5 max-lg:grid-cols-1">
            <InputBlock :name="input.name" :type="input.type" :placeholder="input.placeholder" :label="input.label"
                v-for="input in REGISTER_INPUT_VALUES" :key="input.label" @update-value="updateValue" />
        </div>
        <DivideLine />
        <div class="my-4">
            <BlockTitle :title="'Контактные данные руководителя'" />
            <PhoneInput class="mt-5 mb-1" :label="PHONE_INPUT_VALUE.label" :name="PHONE_INPUT_VALUE.name" @update-value="
                updateValue
            " />
            <span class="text-[12px] text-[#99A1AF]">Телефон нужен для оперативной связи по организационным
                вопросам</span>
        </div>
        <YandexCaptcha class="mb-6" />
        <BaseButton :text="'Оставить заявку'" :icon="'fas fa-user-plus'" />
        <AuthLink :href="'login.create'" :text-sm="'Есть аккаунт?'" :link-text="'Войти'" />
    </form>
</template>
