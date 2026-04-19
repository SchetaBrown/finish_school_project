<script setup>
const PROPS = defineProps(['schools']);
import SelectTabSectionV1 from '@sections/SelectTabSectionV1.vue'
import ManagarRegisterForm from "./register/ManagerRegisterForm.vue";
import ParticipantRegisterForm from "./register/ParticipantRegisterForm.vue";
import Container from '@other/Container.vue'
import { computed, ref } from "vue";

const buttons = computed(() => [
    {
        id: 1,
        text: 'Участник',
        icon: 'fa-user-graduate',
    },
    {
        id: 2,
        text: 'Руководитель',
        icon: 'fa-user-tie',
    },
]);

const activeTab = ref(buttons.value[0].id);
</script>
<template>
    <Container class="max-w-196 p-8">
        <div class="flex justify-center">
            <SelectTabSectionV1 :buttons="buttons" @select-tab="(id) => {
                activeTab = id
            }" />
        </div>

        <ParticipantRegisterForm :schools="schools" v-if="activeTab === 1" />
        <ManagarRegisterForm :schools="schools" v-else />
    </Container>
</template>
