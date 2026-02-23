<script setup>
const PROPS = defineProps(["olympiad"]);
import OlympiadProgress from "./components/OlympiadProgress.vue";
import OlympiadTitle from "./components/OlympiadTitle.vue";
import OlympiadDescription from "./components/OlympiadDescription.vue";
import OlympiadStatus from "./components/OlympiadStatus.vue";
import OlympiadLink from "./components/OlympiadLink.vue";
</script>
<template>
  <div
    class="bg-white border border-gray-200 rounded-xl p-5 hover:shadow-lg transition"
  >
    <OlympiadStatus :status="olympiad.status" />
    <OlympiadTitle :title="olympiad.title" />
    <OlympiadDescription :description="olympiad.description" />
    <OlympiadProgress
      :direction="olympiad.direction"
      :player_count="olympiad.player_count"
      :player_limit="olympiad.player_limit"
      :status="olympiad.status"
    />
    <OlympiadLink :slug="olympiad.slug" :status="olympiad.status" />
  </div>
</template>
