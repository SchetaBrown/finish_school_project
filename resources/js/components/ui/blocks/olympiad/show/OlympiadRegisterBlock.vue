<script setup>
const props = defineProps([
    'title',
    'status',
    'registerStartDate',
    'registerEndDate',
    'count',
    'limit',
    'progressBarWidth',
    'slug',
    'isRegisterParticipant'
]);
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

const canRegister = computed(() => {
    if (props.isRegisterParticipant) {
        return false;
    }

    if (!IS_AVAILABLE_LINK.value) {
        return false;
    }

    return true;
});

const buttonText = computed(() => {
    const role = userData?.role?.toLowerCase() || '';

    if (props.isRegisterParticipant) {
        return 'Вы уже зарегистрированы';
    }

    switch (role) {
        case 'участник':
            return 'Перейти к регистрации';
        case 'руководитель':
            return 'Перейти к заявкам';
        case 'ответственный':
            return 'Перейти к заявкам участников';
        default:
            return 'Войдите в систему, чтобы зарегистрироваться';
    }
});

const link = computed(() => {
    const role = userData?.role?.toLowerCase() || '';

    if (props.isRegisterParticipant) {
        return {
            text: buttonText.value,
            href: '#',
            disabled: true
        };
    }

    switch (role) {
        case 'участник':
            return {
                text: buttonText.value,
                href: route('olympiad.order.create', { olympiad: props.slug }),
                disabled: false
            };
        case 'руководитель':
            return {
                text: buttonText.value,
                href: route('olympiad.student-orders.index', { olympiad: props.slug }),
                disabled: false
            };
        case 'ответственный':
            return {
                text: buttonText.value,
                href: route('olympiad.olympiad-orders.index', { olympiad: props.slug }),
                disabled: false
            };
        default:
            return {
                text: buttonText.value,
                href: route('login.create'),
                disabled: false
            };
    }
});

const buttonClasses = computed(() => {
    const baseClasses = 'flex items-center justify-center text-white py-3.5 w-full font-medium rounded-lg transition-colors';

    if (!canRegister.value || props.isRegisterParticipant) {
        return `${baseClasses} bg-gray-400 cursor-not-allowed`;
    }

    return `${baseClasses} bg-indigo-600 hover:bg-indigo-700`;
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
                    <span class="font-medium text-gray-900">{{ status }}</span>
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

            <Link v-if="IS_AVAILABLE_LINK || isRegisterParticipant" :class="buttonClasses" :href="link.href"
                :disabled="!canRegister || isRegisterParticipant"
                @click.prevent="(!canRegister || isRegisterParticipant) ? null : null">
                {{ link.text }}
            </Link>

            <div v-if="!IS_AVAILABLE_LINK && !isRegisterParticipant"
                class="flex items-center justify-center py-3.5 w-full font-medium rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed">
                Регистрация закрыта
            </div>
        </div>
    </Container>
</template>
