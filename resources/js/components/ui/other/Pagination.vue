<script setup>
import { computed, ref } from "vue";

const props = defineProps({
    links: {
        type: Object,
        required: true
    }
});

const emit = defineEmits(['page-changed']);
const isMobileOpen = ref(false);

const getPageNumber = (url) => {
    if (!url) return null;
    const match = url.match(/page=(\d+)/);
    return match ? parseInt(match[1]) : null;
};

const currentPage = computed(() => {
    if (props.links.prev) {
        return getPageNumber(props.links.prev) + 1;
    }
    if (props.links.next) {
        return getPageNumber(props.links.next) - 1;
    }
    return 1;
});

const lastPage = computed(() => {
    return getPageNumber(props.links.last) || 1;
});

const paginationLinks = computed(() => {
    const pages = [];
    const total = lastPage.value;
    const current = currentPage.value;

    if (total <= 10) {
        for (let i = 1; i <= total; i++) {
            pages.push({
                page: i,
                url: getUrlForPage(i),
                active: i === current
            });
        }
    } else {
        for (let i = 1; i <= 5; i++) {
            pages.push({
                page: i,
                url: getUrlForPage(i),
                active: i === current
            });
        }

        if (current > 5 && current < total - 4) {
            pages.push({ page: '...', url: null, active: false });

            for (let i = current - 1; i <= current + 1; i++) {
                pages.push({
                    page: i,
                    url: getUrlForPage(i),
                    active: i === current
                });
            }

            pages.push({ page: '...', url: null, active: false });
        }

        for (let i = total - 4; i <= total; i++) {
            pages.push({
                page: i,
                url: getUrlForPage(i),
                active: i === current
            });
        }
    }

    return pages;
});

const getUrlForPage = (page) => {
    if (page === 1) return props.links.first;
    if (page === lastPage.value) return props.links.last;

    const baseUrl = props.links.first?.split('?')[0];
    return `${baseUrl}?page=${page}`;
};

const goToPage = (page, url) => {
    if (page === '...') return;
    if (page === currentPage.value) return;

    isMobileOpen.value = false;
    emit('page-changed', { page, url });
};

const prevPage = () => {
    if (props.links.prev) {
        const page = getPageNumber(props.links.prev);
        goToPage(page, props.links.prev);
    }
};

const nextPage = () => {
    if (props.links.next) {
        const page = getPageNumber(props.links.next);
        goToPage(page, props.links.next);
    }
};

// Для мобильного селекта
const handleMobileSelect = (event) => {
    const page = parseInt(event.target.value);
    if (page && page !== currentPage.value) {
        const url = getUrlForPage(page);
        goToPage(page, url);
    }
};

// Все страницы для мобильного селекта
const allPages = computed(() => {
    const pages = [];
    for (let i = 1; i <= lastPage.value; i++) {
        pages.push(i);
    }
    return pages;
});
</script>

<template>
    <div class="hidden sm:flex gap-1.75 justify-center items-center mt-12.5">
        <Link v-if="links.prev" :href="links.prev" @click.prevent="prevPage"
            class="h-10 w-10 bg-white flex items-center justify-center border border-gray-300 rounded hover:bg-gray-50 transition">
        &laquo;
        </Link>
        <div v-else
            class="h-10 w-10 bg-gray-100 flex items-center justify-center border border-gray-300 rounded text-gray-400 cursor-not-allowed">
            &laquo;
        </div>

        <template v-for="link in paginationLinks" :key="link.page">
            <Link v-if="link.url" :href="link.url" @click.prevent="goToPage(link.page, link.url)"
                class="flex justify-center items-center h-10 w-10 border border-gray-300 rounded transition" :class="{
                    'bg-indigo-600 text-white hover:bg-indigo-700': link.active,
                    'bg-white text-black hover:bg-gray-50': !link.active
                }">
            {{ link.page }}
            </Link>
            <div v-else class="flex justify-center items-center h-10 w-10 text-gray-400">
                {{ link.page }}
            </div>
        </template>

        <Link v-if="links.next" :href="links.next" @click.prevent="nextPage"
            class="h-10 w-10 bg-white flex items-center justify-center border border-gray-300 rounded hover:bg-gray-50 transition">
        &raquo;
        </Link>
        <div v-else
            class="h-10 w-10 bg-gray-100 flex items-center justify-center border border-gray-300 rounded text-gray-400 cursor-not-allowed">
            &raquo;
        </div>
    </div>

    <div class="sm:hidden flex flex-col gap-3 items-center mt-8">
        <div class="flex gap-3 w-full justify-center">
            <button @click="prevPage" :disabled="!links.prev"
                class="flex-1 max-w-30 px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition">
                ← Назад
            </button>
            <button @click="nextPage" :disabled="!links.next"
                class="flex-1 max-w-30 px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition">
                Вперед →
            </button>
        </div>
    </div>
</template>
