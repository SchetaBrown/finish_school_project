<script setup>
const PROPS = defineProps(['olympiad']);
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import AppBaseLayout from '@layouts/AppBaseLayout.vue'
import OlympiadCreateDocumentBlock from '@blocks/olympiad/OlympiadCreateDocumentBlock.vue'
import PageTitle from '@titles/PageTitle.vue'
import BlockTitle from '@titles/BlockTitle.vue'
import Container from '@other/Container.vue'
import Status from '@other/Status.vue'
import DivideLine from '@other/DivideLine.vue'
import InfoInputBlock from '@blocks/InfoInputBlock.vue'

const OLYMPIAD_DATA = computed(() => {
    return PROPS.olympiad.data;
});

const OLYMPIAD_TYPES = computed(() => {
    const types = OLYMPIAD_DATA.value.types
    if (types.length !== 0) {
        return types;
    }
});

const FREE_POSITION = computed(() => {
    const playerLimit = OLYMPIAD_DATA.value.player_limit;
    const playerCount = OLYMPIAD_DATA.value.player_count;

    return `${playerLimit - playerCount} из ${playerLimit}`
});

const SPONSOR = computed(() => {
    return OLYMPIAD_DATA.value.organizer ?? 'Не указан';
});

const OLYMPIAD_DATA_BLOCK = computed(() => {
    return [
        {
            subtitle: 'Направление',
            title: OLYMPIAD_DATA.value.direction,
        },
        {
            subtitle: 'Тип участия',
            title: OLYMPIAD_TYPES.value ?? 'Не указан',
        },
        {
            subtitle: 'Свободных мест',
            title: FREE_POSITION.value,
        },
    ];
});
</script>
<template>
    <AppBaseLayout>
        <PageTitle :title="'Регистрация на олимпиаду'" :subtitle="'Проверьте данные перед отправкой'" />
        <OlympiadCreateDocumentBlock></OlympiadCreateDocumentBlock>

        <div class="grid grid-cols-2 gap-5 mt-8 w-full max-lg:grid-cols-1">
            <Container>
                <BlockTitle :title="'Данные участника'" />
            </Container>
            <div class="flex flex-col gap-5 w-full">
                <Container>
                    <div class="flex justify-between">
                        <BlockTitle :title="OLYMPIAD_DATA.title" :full-text="true" />
                        <Status :status="OLYMPIAD_DATA.status" :fontSize="'12'" />
                    </div>
                    <span class="text-sm text-[#6A7282]">Организатор: {{ SPONSOR }}</span>
                    <DivideLine />
                    <div class="flex justify-between">
                        <InfoInputBlock v-for="data in OLYMPIAD_DATA_BLOCK" :key="data.subtitle" :title="data.title"
                            :subtitle="data.subtitle" />
                    </div>
                </Container>
                <Container>
                    <BlockTitle :title="'Подтверждение'" />
                </Container>
            </div>
        </div>
    </AppBaseLayout>
</template>
