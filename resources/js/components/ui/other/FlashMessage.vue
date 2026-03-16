<script setup>
import { useFlashMessage } from '@composables/useFlashMessage.js'

const { visible, icon, color, message, hideMessage } = useFlashMessage({
    duration: 5000,
    autoClose: true
})
</script>

<template>
    123123
    {{ icon }}
    <Transition enter-active-class="transform ease-out duration-300 transition"
        enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        enter-to-class="translate-y-0 opacity-100 sm:translate-x-0" leave-active-class="transition ease-in duration-100"
        leave-from-class="opacity-100" leave-to-class="opacity-0">
        <div v-if="visible" class="fixed top-4 right-4 z-50 max-w-sm w-full shadow-lg rounded-lg pointer-events-auto"
            :class="`bg-${color}-50 border-l-4 border-${color}-400`" role="alert">
            <div class="p-4">
                <div class="flex items-start">
                    <div class="shrink-0">
                        <i :class="[icon, `text-${color}-400`, 'text-lg']"></i>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium" :class="`text-${color}-800`">
                            {{ message }}
                        </p>
                    </div>
                    <div class="ml-4 shrink-0 flex">
                        <button @click="hideMessage"
                            class="inline-flex text-gray-400 hover:text-gray-500 focus:outline-none">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>
