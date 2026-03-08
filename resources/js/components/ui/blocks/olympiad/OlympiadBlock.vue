<script setup>
const PROPS = defineProps(["olympiad"]);
import OlympiadProgress from "./components/OlympiadProgress.vue";
import BlockTitle from "@titles/BlockTitle.vue";
import OlympiadDescription from "./components/OlympiadDescription.vue";
import OlympiadStatus from "./components/OlympiadStatus.vue";
import OlympiadLink from "./components/OlympiadLink.vue";
import Container from '@other/Container.vue'
</script>
<template>
    <Container class="p-5 hover:shadow-lg transition">
        <OlympiadStatus :status="olympiad.status" />
        <BlockTitle :title="olympiad.title" />
        <OlympiadDescription :description="olympiad.description" />
        <OlympiadProgress :direction="olympiad.direction" :player_count="olympiad.player_count"
            :player_limit="olympiad.player_limit" :status="olympiad.status" />
        <OlympiadLink :slug="olympiad.slug" :status="olympiad.status" />
    </Container>
</template>
