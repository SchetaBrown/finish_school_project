<script setup>
const PROPS = defineProps(['schools']);
import { useForm } from "@inertiajs/inertia-vue3";
import { AUTH_BASE_FORM_FIELDS } from "@constants/fields.js";
import BaseInput from "@inputs/BaseInput.vue";
import InputBlock from '@blocks/InputBlock.vue'
import BaseButton from "@buttons/BaseButton.vue";
import ParticipantRegisterSection from "@sections/auth/ParticipantRegisterSection.vue";
import AuthLink from "@links/AuthLink.vue";
import { REGISTER_INPUT_VALUES } from "@constants/auth.js";
import { useBaseForm } from '../../../../../composables/useBaseForm.js'
import { onUnmounted } from "vue";
const form = useBaseForm({
    ...AUTH_BASE_FORM_FIELDS,
    education_school_id: "",
    education_direction_id: "",
    cours_number: "",
    role: 'participant'
});

function submit() {
    form.submit('post', route('register.store'));
}

onUnmounted(() => {
    form.clearErrors()
});
</script>
<template>
    <form @submit.prevent="submit">
        <div class="grid grid-cols-2 gap-5">
            <InputBlock :name="input.name" :type="input.type" :placeholder="input.placeholder" :label="input.label"
                :error="form.getErrorByName(input.name)" v-for="input in REGISTER_INPUT_VALUES" :key="input.label"
                @change-value="(data) => {
                    form.updateFormFieldValue(data.name, data.value)
                }" />
        </div>
        <div class="w-full bg-[#F3F4F6] h-px rounded-full my-5"></div>
        <ParticipantRegisterSection />
        <BaseButton :text="'Зарегистрироваться'" :icon="'fas fa-user-plus'" />
        <AuthLink :href="'login.create'" :text-sm="'Есть аккаунт?'" :link-text="'Войти'" />
    </form>
</template>
