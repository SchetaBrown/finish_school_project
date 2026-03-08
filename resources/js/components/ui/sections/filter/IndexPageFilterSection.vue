<script setup>
import PageTitle from "@titles/PageTitle.vue";
import IndexPageFilterForm from "@forms/IndexPageFilterForm.vue";
import IndexPageSort from "@forms/IndexPageSort.vue";
const PROPS = defineProps(["count", "directions", "statuses"]);
</script>
<template>
  <section>
    <PageTitle
      :title="'Все олимпиады'"
      :subtitle="'Найди событие по душе и прокачай свои навыки'"
    />
    <IndexPageFilterForm :directions="directions" :statuses="statuses" />
    <IndexPageSort :count="count" />
  </section>
</template>
