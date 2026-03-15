<script setup>
defineProps(['subtitle', 'title']);
</script>
<template>
    <div class="flex flex-col gap-1">
        <span class="text-[14px] text-[#99A1AF]">{{ subtitle }}</span>
        <span class="text-xm text-gray-900">{{ title }}</span>
    </div>
</template>
