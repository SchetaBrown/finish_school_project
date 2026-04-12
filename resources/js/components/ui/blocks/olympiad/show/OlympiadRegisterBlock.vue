<script setup>
const props = defineProps(['title', 'status', 'registerStartDate', 'registerEndDate', 'count', 'limit', 'progressBarWidth', 'slug']);
import Container from '@other/Container.vue'
import BlockTitle from '@titles/BlockTitle.vue'
import { computed, inject } from 'vue';

const userData = inject('userData');

const IS_AVAILABLE_LINK = computed(() => {
    const STATUS = props.status.toLowerCase().trim();

    if (STATUS !== 'завершено' && STATUS !== 'регистрация закрыта') {
        return true;
    }

    return false;
});

const link = computed(() => {
    let href = {
        text: '',
        href: '',
    };
    const role = userData.role.toLowerCase();
    switch (role) {
        case 'участник':
            href.text = 'Перейти к регистрации';
            href.href = route('olympiad.order.create', { olympiad: props.slug })
            break;
        case 'руководитель':
            href.text = 'Перейти к заявкам';
            href.href = route('olympiad.student-orders.index', { olympiad: props.slug })
            break;
        case 'ответственный':
            href.text = 'Перейти к заявкам участников';
            href.href = route('olympiad.olympiad-orders.index', { olympiad: props.slug })
            break;
    }

    return href;
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
                :href="link.href">
                {{ link.text }}</Link>
        </div>
    </Container>
</template>
