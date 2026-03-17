<script setup>
import AppBaseLayout from '@layouts/AppBaseLayout.vue'
import { useCustomForm } from '@composables/useCustomForm.js'

const { form, submit } = useCustomForm();
</script>
<template>
    <AppBaseLayout>
        <form @submit.prevent="submit(route('verification.send'))">
            <button>Подтвердить почту</button>
        </form>
    </AppBaseLayout>
</template>
