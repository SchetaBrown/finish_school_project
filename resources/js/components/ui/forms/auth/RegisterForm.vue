<script setup>
import ChangeRoleSection from "@sections/ChangeRoleSection.vue";
import ManagarRegisterForm from "./register/ManagerRegisterForm.vue";
import ParticipantRegisterForm from "./register/ParticipantRegisterForm.vue";
import { computed, ref } from "vue";

let identificator = ref("participant");

function getActiveTab(id) {
  if (typeof id === "string") {
    identificator.value = id;
  }
}
</script>
<template>
  <div class="bg-white border border-gray-200 rounded-xl p-8 max-w-196">
    <ChangeRoleSection @change-role="getActiveTab" />

    <ParticipantRegisterForm v-if="identificator === 'participant'" />
    <ManagarRegisterForm v-else />
  </div>
</template>
