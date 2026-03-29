<script setup>
import { computed } from "vue";
import AppBaseLayout from "@layouts/AppBaseLayout.vue";
import PageTitle from '@titles/PageTitle.vue'
import BlockTitle from '@titles/BlockTitle.vue'
import Container from '@other/Container.vue'
import OlympiadDetailBlock from "@blocks/olympiad/show/OlympiadDetailBlock.vue";
import OlympiadNewBlock from "@blocks/olympiad/show/OlympiadNewBlock.vue";
import OlympiadRegisterBlock from "@blocks/olympiad/show/OlympiadRegisterBlock.vue";
import Status from '@other/Status.vue'

const PROPS = defineProps(["olympiad"]);

const DATA = computed(() => {
    return PROPS.olympiad.data
});

const OLYMPIAD_TYPES = computed(() => {
    const TYPES = DATA.value.types;

    if (typeof TYPES === 'object') {
        return TYPES.length !== 0 ? TYPES : 'Не указано';
    }
});

const REGISTER_START_DATE = computed(() => {
    return DATA.value.register_start_date;
});

const REGISTER_END_DATE = computed(() => {
    return DATA.value.register_end_date;
});

const END_DATE = computed(() => {
    return DATA.value.end_date
});

const START_DATE = computed(() => {
    return DATA.value.start_date;
});

const DIRECTION = computed(() => {
    return DATA.value.direction;
});

const PLAYER_COUNT = computed(() => {
    return DATA.value.player_count;
});

const PLAYER_LIMIT = computed(() => {
    return DATA.value.player_limit;
});

const PROGRESS_BAR_WIDTH = computed(() => {
    return `width:${((PLAYER_COUNT.value / PLAYER_LIMIT.value) * 100).toFixed(0)}%`;
});

const OLYMPIAD_DETAILS = computed(() => {
    return [
        {
            icon: 'fa-code',
            subtitle: 'Направление',
            title: DIRECTION,
        },
        {
            icon: 'fa-calendar-alt',
            subtitle: 'Дата начала',
            title: START_DATE,
        },
        {
            icon: 'fa-user',
            subtitle: 'Тип участия',
            title: OLYMPIAD_TYPES ?? 'Не указан',
        },
        {
            icon: 'fa-calendar-alt',
            subtitle: 'Дата окончания',
            title: END_DATE,
        },
    ];
});
</script>
<template>
    <AppBaseLayout>
        <div class="flex items-center justify-between max-md:flex-wrap max-md:mb-5">
            <PageTitle :title="DATA.title" />
            <Status :status="DATA.status" />
        </div>
        <section class="grid grid-cols-2 gap-5 max-lg:grid-cols-1">
            <Container>
                <BlockTitle :title="'Описание'" />
                <p class="mt-3 text-[#4A5565] text-justify">
                    {{ DATA.description }}
                </p>
            </Container>
            <OlympiadDetailBlock :details="OLYMPIAD_DETAILS" :labelTitle="'Детали олимпиады'" />
            <OlympiadNewBlock :news="DATA.news" :olympiadSlug="DATA.slug" />
            <OlympiadRegisterBlock :title="'Регистрация'" :count="PLAYER_COUNT" :limit="PLAYER_LIMIT"
                :progressBarWidth="PROGRESS_BAR_WIDTH" :register-end-date="REGISTER_END_DATE"
                :register-start-date="REGISTER_START_DATE" :slug="DATA.slug" :status="DATA.status">
            </OlympiadRegisterBlock>
        </section>
    </AppBaseLayout>
</template>
