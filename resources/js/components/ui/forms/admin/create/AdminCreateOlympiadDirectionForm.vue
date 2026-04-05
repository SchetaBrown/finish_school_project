<script setup>
const props = defineProps(['directions', 'managers']);
import { useCustomForm } from '@composables/useCustomForm.js';
const { form, submit, updateValue } = useCustomForm({
    title: ""
});
import InputBlock from '@blocks/InputBlock.vue'
import BaseButton from '@buttons/BaseButton.vue';
import { router } from '@inertiajs/vue3';
</script>
<template>
    <Container>
        <form @submit.prevent="submit(route('admin.olympiad.direction.store'))" class="space-y-5">
            <InputBlock label="Название направления" placeholder="Например: Веб-разработка" name="title"
                @update-value="updateValue" :form="form" />
            <div class="flex justify-end gap-3">
                <BaseButton type="button" text="Отмена" @click="router.get(route('admin.olympiad.index'))"
                    class="px-6 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-lg transition" />
                <BaseButton icon="fa-plus" text="Создать олимпиаду" />
            </div>
        </form>
    </Container>
</template>
