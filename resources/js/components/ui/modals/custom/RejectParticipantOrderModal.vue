<script setup>
const props = defineProps(["icon", "olympiad", "id", "btnClass"]);
import BaseModal from "../BaseModal.vue";
import CloseButton from "@buttons/action/CloseButton.vue";
import InputBlock from "@blocks/InputBlock.vue";
import { useCustomForm } from "@composables/useCustomForm.js";

const { form, updateValue, submit } = useCustomForm({
  reject_message: null,
});

const onClose = (callback) => {
  form.reject_message = null;
  callback();
};
</script>
<template>
  <BaseModal :icon="icon" :btn-class="btnClass">
    <template #default="{ close }">
      <div
        class="flex items-center justify-between px-6 py-4 border-b border-gray-100"
      >
        <div>
          <h2 class="text-xl font-semibold text-gray-900">Отклонение заявки</h2>
          <p class="text-sm text-gray-500 mt-0.5">Укажите причину отклонения</p>
        </div>
        <CloseButton @click="onClose(close)" />
      </div>
      <div class="px-6 py-8">
        <InputBlock
          name="reject_message"
          label="Причина отклонения"
          subtitle="Участник получит уведомление"
          @update-value="updateValue"
        />
      </div>
      <div
        class="flex items-center justify-end space-x-3 px-6 py-4 border-t border-gray-100 bg-gray-50 rounded-b-xl"
      >
        <button
          type="button"
          @click="onClose(close)"
          class="px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-lg transition"
        >
          Отмена
        </button>
        <form
          @submit.prevent="
            submit(
              route('olympiad.student-orders.update', { olympiad, id }),
              'patch'
            )
          "
        >
          <button
            type="submit"
            class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition shadow-sm"
          >
            Продолжить
          </button>
        </form>
      </div>
    </template>
  </BaseModal>
</template>
