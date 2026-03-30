<script setup>
const PROPS = defineProps(['olympiad']);
import { computed } from 'vue';
import AppBaseLayout from '@layouts/AppBaseLayout.vue'
import OlympiadCreateDocumentBlock from '@blocks/olympiad/create/OlympiadCreateDocumentBlock.vue'
import OlympiadUserDataBlock from '@blocks/olympiad/create/OlympiadUserDataBlock.vue';
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
            subtitle: 'Количество мест',
            title: OLYMPIAD_DATA.value.player_count,
        },
    ];
});
</script>
<template>
    <AppBaseLayout>
        <PageTitle :title="'Регистрация на олимпиаду'" :subtitle="'Проверьте данные перед отправкой'" />
        <OlympiadCreateDocumentBlock></OlympiadCreateDocumentBlock>

        <div class="grid grid-cols-2 gap-5 mt-8 w-full max-lg:grid-cols-1">
            <OlympiadUserDataBlock></OlympiadUserDataBlock>
            <div class="flex flex-col gap-5 w-full">
                <Container>
                    <div class="flex justify-between flex-wrap">
                        <BlockTitle :title="OLYMPIAD_DATA.title" :full-text="true" />
                        <Status :status="OLYMPIAD_DATA.status" :fontSize="'12'" />
                    </div>
                    <span class="text-sm text-[#6A7282]">Организатор: {{ SPONSOR }}</span>
                    <DivideLine />
                    <div class="flex justify-between max-sm:grid max-sm:grid-cols-1 max-sm:gap-4 max-sm:justify-center">
                        <InfoInputBlock v-for="data in OLYMPIAD_DATA_BLOCK" :key="data.subtitle" :title="data.title"
                            :subtitle="data.subtitle" />
                    </div>
                </Container>
                <Container>
                    <BlockTitle :title="'Подтверждение'" />
                    <div class="bg-gray-50 rounded-lg p-5 mt-4">
                        <div class="flex items-center mb-4">
                            <input name="is_hostel" type="checkbox"
                                class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            <label for="is_hostel" class="ml-2 block text-sm text-gray-700">Нужно ли общежитие?</label>
                        </div>
                    </div>
                </Container>
            </div>
        </div>
    </AppBaseLayout>
</template>
