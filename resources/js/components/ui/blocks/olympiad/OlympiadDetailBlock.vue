<script setup>
defineProps(['icon', 'subtitle', 'title']);
</script>
<template>
    <div class="flex items-center">
        <i :class="`fa ${icon}`" class="size-5 text-[#8669D1]"></i>
        <div class="flex flex-col ml-3">
            <span class="text-[14px] text-[#99A1AF]">{{ subtitle }}</span>
            <span class="text-gray-900">{{ title }}</span>
        </div>
    </div>
</template>
