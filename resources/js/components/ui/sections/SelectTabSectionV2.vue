<script setup>
const props = defineProps(['buttons']);
import { ref } from 'vue';

const activeTab = ref(props?.buttons[0]?.id || '');
const disableClass = 'px-6 py-4 text-sm font-medium border-b-2 hover:text-gray-700 transition border-transparent text-gray-500';
</script>

<template>
    <div class="flex">
        <button v-for="button in buttons" :key="button.id" @click="() => {
            activeTab = button.id
            $emit('select-tab', button.id);
        }" class="px-6 py-4 text-sm font-medium border-b-2 transition" :class="activeTab === button.id
            ? 'border-indigo-600 text-indigo-600'
            : disableClass">
            <i v-if="button.icon" :class="`fas ${button.icon}`"></i>
            {{ button.text }}
        </button>
    </div>
</template>
