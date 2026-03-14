<script setup>
import AppBaseLayout from "@layouts/AppBaseLayout.vue";
import OlympiadSection from "@sections/OlympiadSection.vue";
import FilterSection from "@sections/filter/IndexPageFilterSection.vue";
import { ref } from "vue";

const PROPS = defineProps([
    "statuses",
    "directions",
    "olympiad_count",
]);

const OLYMPIAD_COUNT = PROPS.olympiad_count;
const OLYMPIAD_DIRECTIONS = PROPS.directions;
const OLYMPIAD_STATUSES = PROPS.statuses;
const OLYMPIADS = ref([]);
</script>
<template>
    <AppBaseLayout>
        <FilterSection :count="OLYMPIAD_COUNT" :directions="OLYMPIAD_DIRECTIONS" :statuses="OLYMPIAD_STATUSES"
            @update-olympiads="(data) => {
                OLYMPIADS = data;
            }">
        </FilterSection>
        <OlympiadSection :olympiads="OLYMPIADS"></OlympiadSection>
    </AppBaseLayout>
</template>
