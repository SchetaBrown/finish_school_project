<script setup>
import Label from '@other/Label.vue'
import InputError from '@other/InputError.vue'

const props = defineProps({
    name: String,
    label: String,
    error: String,
    isDirty: { type: Boolean, default: true },
    required: Boolean,
    subtitle: String
})
</script>

<template>
    <div class="flex flex-col gap-1">
        <Label v-if="label" :label="label" :name="name" :required="required" />

        <slot :error="error" :is-dirty="isDirty" />

        <span v-if="subtitle" class="text-[12px] text-[#99A1AF]">{{ subtitle }}</span>

        <InputError :error="error" :is-dirty="isDirty" />
    </div>
</template>
