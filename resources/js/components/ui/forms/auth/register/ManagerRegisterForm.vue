<script setup>
const PROPS = defineProps(['schools']);
import { AUTH_BASE_FORM_FIELDS } from "@constants/fields.js";
import { REGISTER_INPUT_VALUES } from "@constants/auth.js";
import { PHONE_INPUT_VALUE } from "@constants/auth.js";
import { ref } from "vue";
import { useBaseForm } from "@composables/useBaseForm.js";
import PhoneInput from "@inputs/PhoneInput.vue";
import BaseButton from "@buttons/BaseButton.vue";
import AuthLink from "@links/AuthLink.vue";
import BlockTitle from '@titles/BlockTitle.vue'
import ChooseModal from '@modals/ChooseModal.vue'
import OpenModalButton from "@buttons/OpenModalButton.vue";
import InputBlock from "@blocks/InputBlock.vue";
import DivideLine from "@other/DivideLine.vue";
import { useUserStore } from '@stores/user-store.js'

const form = useBaseForm({
    ...AUTH_BASE_FORM_FIELDS,
    phone: "",
    role: "manager",
});

let showModal = ref(false);
const userStore = useUserStore();

const submit = () => {
    form.toLowerCase().submit('post', route('register.store'), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            userStore.updateAuthStatus(true)
        },
    })
}
</script>
<template>
    <form @submit.prevent="submit">
        <div class="grid grid-cols-2 gap-5 max-lg:grid-cols-1">
            <InputBlock :name="input.name" :type="input.type" :placeholder="input.placeholder" :label="input.label"
                :error="form.getAllErrors(input.name)" v-for="input in REGISTER_INPUT_VALUES" :key="input.label"
                @change-value="data => {
                    form.updateFormFieldValue(data)
                }" />
            <OpenModalButton :name="'education_school_title'" :label="'Учебное заведение'"
                :baseTitle="'Выберите учебное заведение'" :selectTitle="form.getForm().education_school_title"
                @clear-error="form.clearErrors('education_school_title')"
                :error="form.getAllErrors('education_school_title')" @update-value="(choose) => {
                    showModal = choose;
                }" />

        </div>
        <DivideLine />
        <ChooseModal :show="showModal" @close="showModal = false" :title="'Учебные заведения'" :options="schools"
            :name="'education_school_title'" :selectTitle="'full_name'" @select="data => {
                form.updateFormFieldValue(data)
            }" />

        <div class="my-4">
            <BlockTitle :title="'Контактные данные руководителя'" />
            <PhoneInput class="mt-5 mb-1" :label="PHONE_INPUT_VALUE.label" :name="PHONE_INPUT_VALUE.name"
                :error="form.getAllErrors(PHONE_INPUT_VALUE.name)" @change-value="
                    (data) => {
                        form.updateFormFieldValue({ name: PHONE_INPUT_VALUE.name, value: data })
                    }
                " />
            <span class="text-[12px] text-[#99A1AF]">Телефон нужен для оперативной связи по организационным
                вопросам</span>
        </div>
        <BaseButton :text="'Зарегистрироваться'" :icon="'fas fa-user-plus'" />
        <AuthLink :href="'login.create'" :text-sm="'Есть аккаунт?'" :link-text="'Войти'" />
    </form>
</template>
