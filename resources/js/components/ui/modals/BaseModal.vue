<script setup>
const props = defineProps(['btnClass', 'btnText', 'icon']);
import { computed, ref } from 'vue';

console.log(props.icon)

const isOpen = ref(false);

const buttonCls = computed(() => {
    return props?.btnClass || 'flex items-center justify-center gap-2 py-3 px-4 font-medium rounded-lg bg-indigo-600 text-sm text-white';
});

const icon = computed(() => {
    return props?.icon && props.icon !== '' ? props?.icon : '';
});

const close = () => {
    isOpen.value = false;
}
</script>
<template>
    <button v-if="icon === 'fa-trash'" type="button" @click="isOpen = !isOpen" class="text-red-600 hover:text-red-800">
        <i class="fas fa-trash"></i>
    </button>
    <button v-else-if="icon === 'fas fa-edit'" type="button" @click="isOpen = !isOpen" class="text-indigo-600 mr-3">
        <i class="fas fa-edit"></i>
    </button>
    <button v-else @click="isOpen = !isOpen" :class="buttonCls">
        <i v-if="icon" :class="`fas fa-plus`"></i>
        {{ btnText }}
    </button>
    <Teleport to="body">
        <div v-if="isOpen" class="fixed inset-0 z-50 flex items-center justify-center border border-gray-100">
            <div class="absolute inset-0 backdrop-blur-sm" @click="close"></div>
            <div class="relative bg-white rounded-xl shadow-xl w-full max-w-lg mx-4">
                <slot :close="close"></slot>
            </div>
        </div>
    </Teleport>
</template>
