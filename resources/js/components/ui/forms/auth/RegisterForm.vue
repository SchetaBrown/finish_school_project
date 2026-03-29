<script setup>
const PROPS = defineProps(['schools']);
import ChangeRoleSection from "@sections/ChangeRoleSection.vue";
import ManagarRegisterForm from "./register/ManagerRegisterForm.vue";
import ParticipantRegisterForm from "./register/ParticipantRegisterForm.vue";
import Container from '@other/Container.vue'
import { ref } from "vue";

let identificator = ref("participant");

function getActiveTab(id) {
    if (typeof id === "string") {
        identificator.value = id;
    }
}
</script>
<template>
    <Container class="max-w-196 p-8">
        <ChangeRoleSection @change-role="getActiveTab" />

        <ParticipantRegisterForm :schools="schools" v-if="identificator === 'participant'" />
        <ManagarRegisterForm :schools="schools" v-else />
    </Container>
</template>
