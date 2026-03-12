<script setup>
const PROPS = defineProps(['news']);
import { computed } from 'vue';
import Container from '@other/Container.vue'
import NoData from '@other/NoData.vue'

const NEWS = computed(() => {
    const news = PROPS?.news;
    return news && news.length !== 0 ? news : null;
});
</script>
<template>
    <Container>
        <div class="flex items-center gap-2 max-h-5.5">
            <div class="self-stretch w-1 bg-indigo-600 rounded-full"></div>
            <h2 class="font-semibold text-lg">Новости</h2>
        </div>
        <NoData v-if="!NEWS" />
        <div class="" v-else>
            УРААА НОВОСТИ
        </div>
    </Container>
</template>
