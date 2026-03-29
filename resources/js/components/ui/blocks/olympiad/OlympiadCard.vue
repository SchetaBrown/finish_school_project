<script setup>
const PROPS = defineProps(["olympiad"]);
import OlympiadProgress from "./components/OlympiadProgress.vue";
import BlockTitle from "@titles/BlockTitle.vue";
import OlympiadDescription from "./components/OlympiadDescription.vue";
import Container from '@other/Container.vue'
import Status from '@other/Status.vue'
import { computed } from "vue";

const STATUS = computed(() => {
    return PROPS.olympiad.status;
});

const OLYMPIAD_IS_FINISHED =
    typeof STATUS.value === "string"
        ? STATUS.value.toLowerCase() === "завершено"
        : STATUS.value;
</script>
<template>
    <Link :href="OLYMPIAD_IS_FINISHED
        ? route('olympiad.result.index', { olympiad: olympiad.slug })
        : route('olympiad.show', { olympiad: olympiad.slug })
        " class="text-sm font-medium" :class="OLYMPIAD_IS_FINISHED
            ? 'text-gray-500 hover:text-gray-700'
            : 'text-indigo-600 hover:text-indigo-700'
            ">
    <Container class="p-5 hover:shadow-lg transition">
        <Status class="mb-4" :status="olympiad.status" :fontSize="12" />
        <BlockTitle :title="olympiad.title" />
        <OlympiadDescription :description="olympiad.description" />
        <OlympiadProgress :direction="olympiad.direction" :player_count="olympiad.player_count"
            :status="olympiad.status" />
    </Container>
    </Link>
</template>
