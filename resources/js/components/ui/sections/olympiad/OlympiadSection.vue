<script setup>
const PROPS = defineProps(["olympiads"]);

import OlympiadBlock from "../../blocks/olympiad/OlympiadBlock.vue";
</script>
<template>
  <section
    class="grid grid-cols-3 max-xl:grid-cols-2 max-md:grid-cols-1 gap-5"
  >
    <OlympiadBlock
      v-for="olympiad in olympiads"
      :key="olympiad.id"
      :olympiad="olympiad"
    ></OlympiadBlock>
  </section>
</template>
