<script setup>
const props = defineProps(['orders', 'links']);
import { computed, ref } from 'vue';
import SelectTabSectionV2 from '../SelectTabSectionV2.vue';
import ShowOlympiadOrderModal from '@modals/show/ShowOlympiadOrderModal.vue';

const buttons = computed(() => [
    {
        id: 1,
        text: 'Мои заявки',
        icon: '',
    },
]);

const activeTab = ref(buttons.value[0].id);
</script>
<template>
    <section class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <SelectTabSectionV2 :buttons="buttons" @select-tab="(id) => {
            activeTab = id
        }" />
        <div class="p-6">
            <div class="space-y-4">
                <ShowOlympiadOrderModal v-for="order in orders" v-if="activeTab === buttons[0].id"
                    :olympiad=order />
            </div>
        </div>
    </section>
    <Pagination v-if="activeTab === buttons[0].id && links" :links="links" />
</template>
