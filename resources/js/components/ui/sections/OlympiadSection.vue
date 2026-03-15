<script setup>
const PROPS = defineProps(["olympiads"]);

import OlympiadCard from "@blocks/olympiad/OlympiadCard.vue";
</script>
<template>
  <section
    class="grid grid-cols-3 max-xl:grid-cols-2 max-md:grid-cols-1 gap-5"
  >
    <OlympiadCard
      v-for="olympiad in olympiads"
      :key="olympiad.id"
      :olympiad="olympiad"
    ></OlympiadCard>
  </section>
</template>
