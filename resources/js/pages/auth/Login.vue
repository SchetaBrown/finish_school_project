<script setup>
import AppBaseLayout from "@layouts/AppBaseLayout.vue";
import PageTitle from "@titles/PageTitle.vue";
import LoginForm from "@forms/auth/LoginForm.vue";
</script>
<template>
  <AppBaseLayout>
    <PageTitle
      :title="'Вход в систему'"
      :subtitle="'Введите свои данные для входа в аккаунт'"
      class="text-center"
    />
    <LoginForm />
  </AppBaseLayout>
</template>
