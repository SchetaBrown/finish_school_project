<script setup>
import BlockTitle from '@titles/BlockTitle.vue'
import Container from '@other/Container.vue'
const PROPS = defineProps(['details', 'labelTitle']);
</script>
<template>
    <Container>
        <BlockTitle :title="labelTitle" />
        <div class="grid grid-cols-2 justify-between gap-4 max-md:grid-cols-1">
            <div class="flex items-center" v-for="detail in details" :key="detail.subtitle">
                <i :class="`fa ${detail.icon}`" class="size-5 text-[#8669D1]"></i>
                <div class="flex flex-col ml-3">
                    <span class="text-[14px] text-[#99A1AF]">{{ detail.subtitle }}</span>
                    <span class="text-gray-900">{{ detail.title }}</span>
                </div>
            </div>
        </div>
    </Container>
</template>
