<script setup>
import { computed } from "vue";
import AppBaseLayout from "@layouts/AppBaseLayout.vue";
import PageTitle from '@titles/PageTitle.vue'
import BlockTitle from '@titles/BlockTitle.vue'
import Container from '@other/Container.vue'
import OlympiadDetailBlock from "@blocks/olympiad/OlympiadDetailBlock.vue";
import OlympiadNewBlock from "@blocks/olympiad/OlympiadNewBlock.vue";

const PROPS = defineProps(["olympiad"]);

const DATA = PROPS.olympiad.data;

const OLYMPIAD_TYPES = computed(() => {
    const TYPES = DATA.types;

    if (typeof TYPES === 'object') {
        return TYPES.length !== 0 ? TYPES : 'Не указано';
    }
});

const OLYMPIAD_DETAILS = computed(() => {
    return [
        {
            icon: 'fa-code',
            subtitle: 'Направление',
            title: DATA.direction,
        },
        {
            icon: 'fa-calendar-alt',
            subtitle: 'Дата начала',
            title: DATA.start_date,
        },
        {
            icon: 'fa-user',
            subtitle: 'Тип участия',
            title: OLYMPIAD_TYPES ?? 'Не указан',
        },
        {
            icon: 'fa-calendar-alt',
            subtitle: 'Дата окончания',
            title: DATA.end_date,
        },
    ];
});
</script>
<template>
    <AppBaseLayout>
        <div class="flex items-center justify-between">
            <PageTitle :title="olympiad.data.title" />
        </div>
        <section class="grid grid-cols-2 gap-5 max-lg:grid-cols-1">
            <Container>
                <BlockTitle :title="'Описание'" />
                <p class="mt-3 text-[#4A5565] text-justify">
                    {{ olympiad.data.description }}
                </p>
            </Container>
            <Container>
                <BlockTitle :title="'Детали олимпиады'" />
                <div class="grid grid-cols-2 justify-between gap-4">
                    <OlympiadDetailBlock v-for="detail in OLYMPIAD_DETAILS" :key="detail.subtitle" :title="detail.title"
                        :subtitle="detail.subtitle" :icon="detail.icon" />
                </div>
            </Container>
            <OlympiadNewBlock />
            <Container>
                <BlockTitle :title="'Регистрация'" />
                <div class="mt-3 w-full">
                    <div class="flex flex-col gap-2">
                        <div class="flex justify-between">
                            <span class="text-sm text-[#6A7282]">Участники:</span>
                        </div>
                    </div>
                </div>
            </Container>
        </section>
    </AppBaseLayout>
</template>
