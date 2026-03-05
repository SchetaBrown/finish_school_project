<script setup>
import BaseTitle from "../../components/ui/other/titles/BaseTitle.vue";
import AppBaseLayout from "../../layouts/AppBaseLayout.vue";
import RegisterForm from "../../components/ui/forms/auth/RegisterForm.vue";
import ManagaerRegisterForm from "../../components/ui/sections/auth/ManagarRegisterSection.vue";
</script>
<template>
  <AppBaseLayout>
    <BaseTitle
      :title="'Регистрация'"
      :subtitle="'Выберите роль и заполните необходимые поля'"
      class="text-center"
    />
    <RegisterForm class="mx-auto"></RegisterForm>
  </AppBaseLayout>
</template>
