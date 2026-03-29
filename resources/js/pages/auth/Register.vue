<script setup>
const props = defineProps(['schools']);
import PageTitle from "@other/titles/PageTitle.vue";
import AppBaseLayout from "@layouts/AppBaseLayout.vue";
import RegisterForm from "@forms/auth/RegisterForm.vue";
</script>
<template>
    <AppBaseLayout>
        <PageTitle :title="'Регистрация'" :subtitle="'Выберите роль и заполните необходимые поля'"
            class="text-center" />
        <RegisterForm class="mx-auto" :schools="schools.data"></RegisterForm>
    </AppBaseLayout>
</template>
