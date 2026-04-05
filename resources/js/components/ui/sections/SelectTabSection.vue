<script setup>
const props = defineProps(['buttons']);
import BaseButton from '@buttons/BaseButton.vue'
import { computed, ref } from 'vue';

const activeTab = ref(props?.buttons[0]?.id || '');
const disableClass = computed(() => { return 'px-6 py-2.5 text-sm font-medium rounded-lg transition text-gray-600 hover:bg-gray-50' });
</script>
<template>
    <section class="bg-white rounded-xl border border-gray-200 p-1 mb-6 inline-flex space-x-3">
        <BaseButton v-for="button in buttons" :text="button.text" :icon="button.icon" @click="() => {
            activeTab = button.id;
            $emit('select-tab', button.id);
        }" type="button" :class="[
            activeTab === button.id ? '' : disableClass
        ]" />
    </section>
</template>
