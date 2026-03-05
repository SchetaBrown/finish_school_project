<script setup>
import { AUTH_BASE_FORM_FIELDS } from "@constants/fields.js";
import { useForm } from "@inertiajs/inertia-vue3";
import { REGISTER_INPUT_VALUES } from "@constants/auth.js";
import ManagarRegisterSection from "@sections/auth/ManagarRegisterSection.vue";
import BaseInput from "@inputs/BaseInput.vue";
import PhoneInput from "@inputs/PhoneInput.vue";
import BaseButton from "@buttons/BaseButton.vue";
import AuthLink from "@links/AuthLink.vue";

const MANAGER_FORM = useForm({
  ...AUTH_BASE_FORM_FIELDS,
  phone_number: "",
});

function submit() {
  MANAGER_FORM.post(route("register.storeManager"));
}
</script>
<template>
  <form @submit.prevent="submit">
    <div class="grid grid-cols-2 gap-5">
      <BaseInput
        :name="input.name"
        :type="input.type"
        :placeholder="input.placeholder"
        :label="input.label"
        v-for="input in REGISTER_INPUT_VALUES"
        :key="input.label"
      />
    </div>
    <div class="w-full bg-[#F3F4F6] h-px rounded-full my-5"></div>
    <ManagarRegisterSection />
    <PhoneInput />
    <BaseButton :text="'Зарегистрироваться'" :icon="'fas fa-user-plus'" />
    <AuthLink
      :href="'login.create'"
      :text-sm="'Есть аккаунт?'"
      :link-text="'Войти'"
    />
  </form>
</template>
