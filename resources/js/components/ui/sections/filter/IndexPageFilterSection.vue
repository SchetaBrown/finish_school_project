<script setup>
import BaseTitle from "@titles/BaseTitle.vue";
import IndexPageFilterForm from "@forms/IndexPageFilterForm.vue";
import IndexPageSort from "@forms/IndexPageSort.vue";
const PROPS = defineProps(["count", "directions", "statuses"]);
</script>
<template>
  <section>
    <BaseTitle
      :title="'Все олимпиады'"
      :subtitle="'Найди событие по душе и прокачай свои навыки'"
    />
    <IndexPageFilterForm :directions="directions" :statuses="statuses" />
    <IndexPageSort :count="count" />
  </section>
</template>
