<script setup>
import AppBaseLayout from "../layouts/AppBaseLayout.vue";
import OlympiadSection from "../components/ui/sections/olympiad/OlympiadSection.vue";
import FilterSection from "../components/ui/sections/filter/IndexPageFilterSection.vue";

const PROPS = defineProps([
  "olympiads",
  "statuses",
  "directions",
  "olympiad_count",
]);

const OLYMPIADS = PROPS.olympiads;
const OLYMPIAD_COUNT = PROPS.olympiad_count;
const OLYMPIAD_DIRECTIONS = PROPS.directions;
const OLYMPIAD_STATUSES = PROPS.statuses;
</script>
<template>
  <AppBaseLayout>
    <FilterSection
      :count="OLYMPIAD_COUNT"
      :directions="OLYMPIAD_DIRECTIONS"
      :statuses="OLYMPIAD_STATUSES"
    ></FilterSection>
    <OlympiadSection :olympiads="OLYMPIADS.data"></OlympiadSection>
  </AppBaseLayout>
</template>
