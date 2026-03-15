<script setup>
const PROPS = defineProps(['news']);
import { computed } from 'vue';
import Container from '@other/Container.vue'
import NoData from '@other/NoData.vue'
import DivideLine from '@other/DivideLine.vue'

const NEWS = computed(() => {
    const news = PROPS?.news;
    return news && news.length !== 0 ? news : null;
});
</script>
<template>
    <Container>
        <div class="flex items-center gap-2 max-h-5.5 mb-4">
            <div class="self-stretch w-1 bg-indigo-600 rounded-full"></div>
            <h2 class="font-semibold text-lg">Новости</h2>
        </div>

        <NoData v-if="!NEWS" />
        <div class="pb-4 border-b border-gray-100 last:border-0 last:pb-0" v-else v-for="olympiadNew in NEWS">
            <div class="flex items-center space-x-2 text-xs text-gray-400 mb-2">
                <i class="far fa-calendar"></i>
                <span>{{ olympiadNew.published_at }}</span>
            </div>
            <h3 class="font-medium text-gray-900 mb-1">{{ olympiadNew.title }}</h3>
            <p class="text-sm text-gray-600">{{ olympiadNew.description }}</p>
            <DivideLine />
        </div>
    </Container>
</template>
