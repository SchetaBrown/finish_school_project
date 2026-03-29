<script setup>
const PROPS = defineProps(['title', 'status', 'registerStartDate', 'registerEndDate', 'count', 'limit', 'progressBarWidth', 'slug']);
import Container from '@other/Container.vue'
import BlockTitle from '@titles/BlockTitle.vue'
import { computed } from 'vue';

const IS_AVAILABLE_LINK = computed(() => {
    const STATUS = PROPS.status.toLowerCase().trim();

    if (STATUS !== 'завершено' && STATUS !== 'регистрация закрыта') {
        return true;
    }

    return false;
});
</script>
<template>
    <Container>
        <BlockTitle :title="title"></BlockTitle>
        <div class="mt-3 flex flex-col gap-5 w-full">
            <div class="flex flex-col gap-2">
                <div class="flex justify-between">
                    <span class="text-sm text-[#6A7282]">Участники:</span>
                    <span class="font-medium text-sm text-gray-900">{{ count }}/{{ limit }}</span>
                </div>
                <div class="h-2.5 rounded-full w-full bg-[#E5E7EB]">
                    <div class="h-full bg-indigo-600 rounded-full" :style="progressBarWidth"></div>
                </div>
            </div>
            <div class="flex flex-col gap-1">
                <div class="flex justify-between">
                    <span class="text-[#6A7282] text-sm">Статус:</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-[#6A7282] text-sm">Начало регистрации:</span>
                    <span class="font-medium text-gray-900">{{ registerStartDate }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-[#6A7282] text-sm">Окончание регистрации:</span>
                    <span class="font-medium text-gray-900">{{ registerEndDate }}</span>
                </div>
            </div>
            <Link v-if="IS_AVAILABLE_LINK"
                class="flex items-center justify-center text-white py-3.5 w-full font-medium rounded-lg bg-indigo-600"
                :href="route('olympiad.order.create', {
                    olympiad: slug
                })">
            Перейти к регистрации</Link>
        </div>
    </Container>
</template>
