<script setup>
const PROPS = defineProps(["olympiads"]);

import OlympiadCard from "@blocks/olympiad/OlympiadCard.vue";
import NoData from '@other/NoData.vue'
</script>
<template>
    <section class="grid grid-cols-3 max-xl:grid-cols-2 max-md:grid-cols-1 gap-5">
        <OlympiadCard v-if="olympiads.length > 0" v-for="olympiad in olympiads" :key="olympiad.id" :olympiad="olympiad">
        </OlympiadCard>
        <div class="" v-else>
            Ничего не найдено
        </div>
    </section>
</template>
