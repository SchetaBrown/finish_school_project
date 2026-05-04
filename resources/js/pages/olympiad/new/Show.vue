<script setup>
const props = defineProps(['new', 'olympiad_title', 'olympiad_news']);
import AppBaseLayout from '@layouts/AppBaseLayout.vue'
import { computed } from 'vue';
const olympiadNew = computed(() => {
    return props.new.data;
});
</script>
<template>
    <AppBaseLayout>
        <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
            <PageTitle title="Новости олимпиады" :subtitle="olympiad_title" />
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <Container>
                    <div class="flex items-center space-x-3 mb-4">
                        <span class="text-xs text-gray-400">{{ olympiadNew.published_at }}</span>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">{{ olympiadNew.title }}</h2>
                    <div class="prose prose-sm max-w-none text-gray-600 leading-relaxed">
                        <p>{{ olympiadNew.description }}</p>
                    </div>
                </Container>
            </div>
            <Container>
                <h3 class="font-semibold text-gray-900">
                    <i class="fas fa-newspaper text-indigo-600 mr-2"></i>
                    Другие новости олимпиады
                </h3>
                <div class="divide-y divide-gray-100 max-h-125 overflow-y-auto custom-scroll">
                    <Link :href="route('olympiad.new.show', { olympiad: olympiadNew.olympiad.slug, new: olympiadNew.slug })"
                        class="news-card p-5 cursor-pointer transition" v-for="olympiadNew in olympiad_news.data">
                    <div class="flex items-start space-x-3">
                        <div class="flex-1 min-w-0">
                            <div class="text-xs text-gray-400">{{ olympiadNew.published_at }}</div>
                        </div>
                    </div>
                    <h4 class="font-medium text-gray-900 mb-1 line-clamp-2">
                        {{ olympiadNew.title }}
                    </h4>
                    <p class="text-xs text-gray-500 line-clamp-2">
                        {{ olympiadNew.short_description ?? 'Нет краткого описания' }}
                    </p>
                    </Link>
                </div>
            </Container>
        </div>
    </AppBaseLayout>
</template>
<style scoped></style>
