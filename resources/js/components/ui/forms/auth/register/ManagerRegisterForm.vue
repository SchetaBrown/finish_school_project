<script setup>
const PROPS = defineProps(['schools']);
import PhoneInput from "@inputs/PhoneInput.vue";
import BaseButton from "@buttons/BaseButton.vue";
import YandexCaptcha from "@other/YandexCaptcha.vue";
import BaseList from '@lists/BaseList.vue';
import AuthLink from "@links/AuthLink.vue";
import BlockTitle from '@titles/BlockTitle.vue'
import { useCustomForm } from "@composables/useCustomForm";
import { computed } from "vue";

const { form, updateValue, submit } = useCustomForm({
    surname: "",
    name: "",
    patronymic: "",
    email: "",
    phone: "",
    password: "",
    education_school_id: "",
    role: 'руководитель'
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

const phoneInput = computed(() => {
    return {
        label: "Телефон",
        name: "phone",
        type: "tel",
        placeholder: "+7 (___) ___-__-__",
    }
});
</script>
<template>
    <form @submit.prevent="submit(route('register.store'))">
        <div class="grid grid-cols-2 gap-5 max-lg:grid-cols-1">
            <InputBlock :name="input.name" :type="input.type" :placeholder="input.placeholder" :label="input.label"
                v-for="input in inputs" :key="input.label" @update-value="updateValue" :form="form" />
            <BaseList :options="schools.data" name="education_school_id" label="Учебное заведение"
                @update-value="updateValue" />
        </div>
        <DivideLine />
        <div class="my-4">
            <BlockTitle :title="'Контактные данные руководителя'" />
            <PhoneInput class="mt-5 mb-1" :label="phoneInput.label" :name="phoneInput.name" @update-value="
                updateValue
            " />
            <span class="text-[12px] text-[#99A1AF]">Телефон нужен для оперативной связи по организационным
                вопросам</span>
        </div>
        <!-- <YandexCaptcha class="mb-6" /> -->
        <BaseButton :text="'Оставить заявку'" :icon="'fas fa-user-plus'" />
        <AuthLink :href="'login.create'" :text-sm="'Есть аккаунт?'" :link-text="'Войти'" />
    </form>
</template>
