<script setup>
import AppBaseLayout from "@layouts/AppBaseLayout.vue";
import OlympiadSection from "@sections/OlympiadSection.vue";
import FilterSection from "@forms/IndexPageFilterForm.vue";
import PageTitle from '@titles/PageTitle.vue'

const PROPS = defineProps([
    'olympiads',
    "statuses",
    "directions",
    "olympiad_count",
]);

const OLYMPIAD_COUNT = PROPS.olympiad_count;
const OLYMPIAD_DIRECTIONS = PROPS.directions;
const OLYMPIAD_STATUSES = PROPS.statuses;
</script>
<template>
    <AppBaseLayout>
        <PageTitle :title="'Все олимпиады'" :subtitle="'Найди событие по душе и прокачай свои навыки'" />
        <FilterSection :count="OLYMPIAD_COUNT" :directions="OLYMPIAD_DIRECTIONS" :statuses="OLYMPIAD_STATUSES">
        </FilterSection>
        <OlympiadSection :olympiads="olympiads.data"></OlympiadSection>
    </AppBaseLayout>
</template>
