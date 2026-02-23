<script setup>
import AppBaseLayout from "../layouts/AppBaseLayout.vue";
import OlympiadSection from "../components/ui/sections/olympiad/OlympiadSection.vue";
import FilterSection from "../components/ui/sections/filter/IndexPageFilterSection.vue";
const PROPS = defineProps(["data"]);

const OLYMPIADS = PROPS.data.olympiads;
const OLYMPIAD_COUNT = PROPS.data.olympiad_count;
</script>
<template>
  <AppBaseLayout>
    <FilterSection></FilterSection>
    <OlympiadSection :olympiads="OLYMPIADS.data"></OlympiadSection>
  </AppBaseLayout>
</template>
