<script setup>
import AppBaseLayout from "../../layouts/AppBaseLayout.vue";

const PROPS = defineProps(["olympiad"]);
console.log(PROPS.olympiad);
</script>
<template>
  <AppBaseLayout></AppBaseLayout>
</template>
