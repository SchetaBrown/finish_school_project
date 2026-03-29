<script setup>
import AppBaseLayout from '@layouts/AppBaseLayout.vue'
import { useCustomForm } from '@composables/useCustomForm.js'

const { submit } = useCustomForm();
</script>
<template>
    <AppBaseLayout>
        <div class="max-w-md w-full mx-auto">
            <div class="text-center">
                <div class="mx-auto w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-envelope text-indigo-600 text-2xl"></i>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-2">Подтверждение email</h2>

                <p class="text-gray-500 text-sm mb-6">
                    На ваш email было отправлено письмо со ссылкой для подтверждения.
                    Перейдите по ссылке, чтобы активировать аккаунт.
                </p>

                <p class="text-xs text-gray-400 mt-6">
                    Если вы не получали письмо, проверьте папку "Спам" или
                <form @submit.prevent="submit(route('verification.send'))">
                    <button type="submit" class="text-indigo-600 hover:text-indigo-700">отправить повторно</button>
                </form>
                </p>
            </div>
        </div>
    </AppBaseLayout>
</template>
