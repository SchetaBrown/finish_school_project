<script setup>
import IndexPageTitle from "../../other/titles/IndexPageTitle.vue";
import IndexPageFilterForm from "../../forms/filter/IndexPageFilterForm.vue";
import IndexPageSort from "../../forms/sort/IndexPageSort.vue";
const PROPS = defineProps(["count", "directions", "statuses"]);
</script>
<template>
  <section>
    <IndexPageTitle />
    <IndexPageFilterForm :directions="directions" :statuses="statuses" />
    <IndexPageSort :count="count" />
  </section>
</template>
