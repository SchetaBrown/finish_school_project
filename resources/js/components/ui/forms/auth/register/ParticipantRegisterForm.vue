<script setup>
const PROPS = defineProps(['schools', 'directions']);
import { AUTH_BASE_FORM_FIELDS } from "@constants/fields.js";
import { REGISTER_INPUT_VALUES } from "@constants/auth.js";
import { useBaseForm } from '../../../../../composables/useBaseForm.js'
import { onUnmounted, ref } from "vue";
import InputBlock from '@blocks/InputBlock.vue'
import BaseButton from "@buttons/BaseButton.vue";
import AuthLink from "@links/AuthLink.vue";
import OpenModalButton from "@buttons/OpenModalButton.vue";
import ChooseModal from '@modals/ChooseModal.vue'
import DivideLine from "@other/DivideLine.vue";

const form = useBaseForm({
    ...AUTH_BASE_FORM_FIELDS,
    education_direction_id: "",
    cours_number: "",
    role: 'participant'
});

let showModal = ref(false);

function submit() {
    form.submit('post', route('register.store'));
}

onUnmounted(() => {
    form.clearErrors()
});
</script>
<template>
    <form @submit.prevent="submit">
        <div class="grid grid-cols-2 gap-5 max-lg:grid-cols-1">
            <InputBlock :name="input.name" :type="input.type" :placeholder="input.placeholder" :label="input.label"
                :error="form.getAllErrors(input.name)" v-for="input in REGISTER_INPUT_VALUES" :key="input.label"
                @change-value="(data) => {
                    form.updateFormFieldValue(data.name, data.value)
                }" />
            <OpenModalButton :name="'education_school_title'" :label="'Учебное заведение'"
                :baseTitle="'Выберите учебное заведение'" :selectTitle="form.getForm().education_school_title"
                @clear-error="form.clearErrors('education_school_title')"
                :error="form.getAllErrors('education_school_title')" @update-value="(choose) => {
                    showModal = choose;
                }" />
        </div>

        <ChooseModal :show="showModal" @close="showModal = false" :title="'Учебные заведения'" :options="schools"
            :name="'education_school_title'" :selectTitle="'title'" @select="data => {
                form.updateFormFieldValue(data.name, data.value)
            }" />

        <DivideLine />
        <BaseButton :text="'Зарегистрироваться'" :icon="'fas fa-user-plus'" />
        <AuthLink :href="'login.create'" :text-sm="'Есть аккаунт?'" :link-text="'Войти'" />
    </form>
</template>
