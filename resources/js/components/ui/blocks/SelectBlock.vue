<script setup>
import Select from '@selects/BaseSelect.vue'
import Label from '@other/BaseLabel.vue'
import { ref, watch } from 'vue';

let selectValue = ref('');

const PROPS = defineProps(['label', 'options', 'name']);

const emit = defineEmits(['select']);

watch(selectValue, (newValue) => {
    emit('select', {
        name: PROPS.name,
        value: newValue
    })
});
</script>
<template>
    <div class="flex flex-col gap-1">
        <Label :name="name" :label="label" />
        <Select :label="label" :name="name" :options="options" @select="(value) => {
            selectValue = value;
        }" />
    </div>
</template>
