<script setup>
import Input from "./components/index/Input.vue";
import Select from "./components/index/Select.vue";
import { useForm } from "@inertiajs/inertia-vue3";
const PROPS = defineProps(["directions", "statuses"]);

const SEARCH_FORM = useForm({
  title: "",
  direction: "",
  status: "",
});

function sendForm() {}

const SELECTS = [
  {
    label: "Направление",
    name: "direcion",
    options: PROPS.directions,
  },
  {
    label: "Статус",
    name: "status",
    options: PROPS.statuses,
  },
];
</script>
<template>
  <div class="bg-white rounded-xl border border-gray-200 p-5 mb-8">
    <form
      @submit.prevent="sendForm"
      class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4"
    >
      <Input v-model="SEARCH_FORM.title" class="max-h-11.25" />
      <Select
        v-for="select in SELECTS"
        :label="select.label"
        :name="select.name"
        :options="select.options"
        :key="select.title"
      />
    </form>
  </div>
</template>
