<script setup>
import AppBaseLayout from "@layouts/AppBaseLayout.vue";
import BaseTitle from "@titles/BaseTitle.vue";
import LoginForm from "@forms/auth/LoginForm.vue";
</script>
<template>
  <AppBaseLayout>
    <BaseTitle
      :title="'Вход в систему'"
      :subtitle="'Введите свои данные для входа в аккаунт'"
      class="text-center"
    />
    <LoginForm />
  </AppBaseLayout>
</template>
