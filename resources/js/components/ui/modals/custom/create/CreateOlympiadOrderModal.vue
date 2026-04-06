<script setup>
const props = defineProps(["managers", "olympiad"]);
import BaseModal from "../../BaseModal.vue";
import CloseButton from "@buttons/action/CloseButton.vue";
import InputBlock from "@blocks/InputBlock.vue";
import BaseList from "@lists/BaseList.vue";
import { computed, ref } from "vue";
import { useCustomForm } from "@composables/useCustomForm.js";

const { form, updateValue, submit } = useCustomForm({
  is_hostel: false,
  arrival_date: null,
  departure_date: null,
  olympiad_id: "",
  manager_id: "",
});

const dateInputs = computed(() => [
  {
    label: "Дата приезда",
    name: "arrival_date",
    type: "datetime-local",
  },
  {
    label: "Дата отъезда",
    name: "departure_date",
    type: "datetime-local",
  },
]);

const managers = computed(() => {
  return props.managers ? props.managers : [];
});
</script>
<template>
  <BaseModal btn-text="Добавить" icon="fa-plus">
    <template #default="{ close }">
      <div
        class="flex items-center justify-between px-6 py-4 border-b border-gray-100"
      >
        <div>
          <h2 class="text-xl font-semibold text-gray-900">
            Регистрация пользователя на олимпиаду
          </h2>
          <p class="text-sm text-gray-500 mt-0.5">Подвердите данные ниже</p>
        </div>
        <CloseButton @click="close" />
      </div>
      <form
        @submit.prevent="
          () => {
            submit(route('olympiad.order.store', { olympiad: olympiad.slug }));
          }
        "
      >
        <div class="p-3 space-y-2">
          <div class="bg-gray-50 rounded-lg p-5 mt-4">
            <div class="flex items-center">
              <input
                name="is_hostel"
                type="checkbox"
                @change="
                  () => {
                    form.is_hostel = !form.is_hostel;
                  }
                "
                class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
              />
              <label for="is_hostel" class="ml-2 block text-sm text-gray-700"
                >Нужно ли общежитие?</label
              >
            </div>
            <div class="grid grid-cols-2 gap-2 mt-4" v-if="form.is_hostel">
              <InputBlock
                :key="input.label"
                v-for="input in dateInputs"
                :label="input.label"
                :name="input.name"
                :type="input.type"
                :form="form"
                @update-value="updateValue"
              />
            </div>
          </div>
          <BaseList
            name="manager_id"
            label="Руководитель"
            :options="managers"
            :form="form"
            @update-value="updateValue"
          />
        </div>
        <div
          class="flex items-center justify-end space-x-3 px-6 py-4 border-t border-gray-100 bg-gray-50 rounded-b-xl"
        >
          <button
            type="button"
            @click="close"
            class="px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-lg transition"
          >
            Отмена
          </button>
          <button
            type="submit"
            class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition shadow-sm"
          >
            Подтвердить
          </button>
        </div>
      </form>
    </template>
  </BaseModal>
</template>
