<script setup>
const props = defineProps(["error", 'isDirty']);
</script>

<template>
    <transition enter-active-class="transition duration-200 ease-out"
        enter-from-class="transform -translate-y-2 opacity-0" enter-to-class="transform translate-y-0 opacity-100"
        leave-active-class="transition duration-150 ease-in" leave-from-class="transform translate-y-0 opacity-100"
        leave-to-class="transform -translate-y-2 opacity-0">
        <div v-if="isDirty" class="flex items-center gap-1.5 mt-1 text-sm text-red-600">
            <span>{{ error }}</span>
        </div>
    </transition>
</template>
