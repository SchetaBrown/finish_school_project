<script setup>
defineProps(['label', 'name', 'placeholder', 'type', 'icon', 'error']);
import Label from '@other/BaseLabel.vue'
import Input from '@inputs/BaseInput.vue'
import { ref, watch } from 'vue';
const emit = defineEmits(['change-value']);

let value = ref('');

function updateValue(data) {
    value.value = data;
}

watch(value, (newValue) => {
    emit('change-value', newValue);
});
</script>
<template>
    <div class="flex flex-col gap-1">
        <Label :label="label" :name="name" />
        <Input :label="label" :icon="icon" :type="type" :placeholder="placeholder" :name="name" :error="error"
            @change-value="updateValue" />
    </div>
</template>
