<script setup>
import { ref, watch } from "vue";
import RoleButton from "@buttons/RoleButton.vue";
import { CHANGE_ROLE_BUTTONS } from "@constants/button.js";
const emit = defineEmits(["change-role"]);

let identificator = ref(CHANGE_ROLE_BUTTONS[0].id);

function changeIdentificator(newId) {
  identificator.value = newId;
}

watch(identificator, (newValue) => {
  emit("change-role", newValue);
});
</script>
<template>
  <section class="flex justify-center mb-8">
    <div class="flex gap-4">
      <RoleButton
        v-for="button in CHANGE_ROLE_BUTTONS"
        :key="button.id"
        :id="button.id"
        @click="changeIdentificator(button.id)"
        :activeTab="identificator"
      >
        <i :class="button.i"></i>
        {{ button.title }}
      </RoleButton>
    </div>
  </section>
</template>
