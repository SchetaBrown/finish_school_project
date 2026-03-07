<script setup>
const PROPS = defineProps(['schools', 'directions']);
import BaseTitle from "@other/titles/BaseTitle.vue";
import AppBaseLayout from "@layouts/AppBaseLayout.vue";
import RegisterForm from "@forms/auth/RegisterForm.vue";
</script>
<template>
    <AppBaseLayout>
        <BaseTitle :title="'Регистрация'" :subtitle="'Выберите роль и заполните необходимые поля'"
            class="text-center" />
        <RegisterForm class="mx-auto" :schools="schools"></RegisterForm>
    </AppBaseLayout>
</template>
