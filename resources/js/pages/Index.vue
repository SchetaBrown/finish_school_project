<script setup>
import AppBaseLayout from "../layouts/AppBaseLayout.vue";
import OlympiadSection from "../components/ui/sections/olympiad/OlympiadSection.vue";
import FilterSection from "../components/ui/sections/filter/IndexPageFilterSection.vue";
const props = defineProps(["olympiads"]);
</script>
<template>
  <AppBaseLayout>
    <FilterSection></FilterSection>
    <OlympiadSection></OlympiadSection>
  </AppBaseLayout>
</template>
