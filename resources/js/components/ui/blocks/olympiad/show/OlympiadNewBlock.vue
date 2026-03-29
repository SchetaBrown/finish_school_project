<script setup>
const props = defineProps(['news', 'olympiadSlug']);
import { computed } from 'vue';
import Container from '@other/Container.vue'
import NoData from '@other/NoData.vue'

const NEWS = computed(() => {
    const news = props?.news;
    return news && news.length !== 0 ? news : null;
});
</script>
<template>
    <Container>
        <div class="flex items-center gap-2 max-h-5.5 mb-4">
            <div class="self-stretch w-1 bg-indigo-600 rounded-full"></div>
            <h2 class="font-semibold text-lg">Новости</h2>
        </div>

        <div class="flex flex-col justify-center items-center" v-if="$page.props.auth.isAuthenticated !== true">
            <p class="text-gray-500 text-sm">Для просмотра новостей войдите в систему</p>
        </div>
        <NoData v-else-if="!NEWS" />
        <div class="pb-4 border-b border-gray-100 mb-4 last:mb-0 last:border-0 last:pb-0" v-else
            v-for="olympiadNew in NEWS">
            <Link :href="route('olympiad.new.show', { olympiad: olympiadSlug, new: olympiadNew.slug })">
            <div class="flex items-center space-x-2 text-xs text-gray-400 mb-2">
                <i class="far fa-calendar"></i>
                <span>{{ olympiadNew.published_at }}</span>
            </div>
            <h3 class="font-medium text-gray-900 mb-1">{{ olympiadNew.title }}</h3>
            <p class="text-sm text-gray-600">{{ olympiadNew.description }}</p>
            </Link>
        </div>
    </Container>
</template>
