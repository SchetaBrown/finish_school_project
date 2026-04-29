<script setup>
const props = defineProps(["olympiads"]);

import OlympiadCard from "@blocks/olympiad/OlympiadCard.vue";
import { computed } from "vue";

const availableOlympiads = computed(() => {
    return props.olympiads.data.length > 0 ? props.olympiads : null;
});
</script>
<template>
    <section class="grid grid-cols-3 max-xl:grid-cols-2 max-md:grid-cols-1 gap-5">
        <OlympiadCard v-if="availableOlympiads" v-for="olympiad in olympiads.data" :key="olympiad.id"
            :olympiad="olympiad">
        </OlympiadCard>
    </section>
    <span v-if="olympiads.data.length === 0" class="flex justify-center text-gray-600 my-4">
        Олимпиады не найдены. Попробуйте изменить входные данные фильтров
    </span>
    <Pagination v-if="availableOlympiads" :links="olympiads.links" />
</template>
