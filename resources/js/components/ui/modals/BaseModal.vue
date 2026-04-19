<script setup>
const props = defineProps(['btnClass', 'btnText', 'icon', 'isOpen', 'reject']);
import { computed, ref } from 'vue';

console.log(props.icon)

const buttonCls = computed(() => {
    return props?.btnClass || 'flex items-center justify-center gap-2 py-3 px-4 font-medium rounded-lg bg-indigo-600 text-sm text-white';
});

const icon = computed(() => {
    return props?.icon && props.icon !== '' ? props?.icon : '';
});

const isOpen = ref(false);

const close = () => {
    isOpen.value = false;
}
</script>
<template>
    <button v-if="icon && icon === 'fa-trash'" type="button" @click="isOpen = !isOpen"
        class="text-red-600 hover:text-red-800">
        <i class="fas fa-trash"></i>
    </button>
    <button v-else-if="icon && icon === 'fas fa-edit'" type="button" @click="isOpen = !isOpen"
        class="text-indigo-600 mr-3">
        <i class="fas fa-edit"></i>
    </button>
    <button v-else-if="icon" @click="isOpen = !isOpen" :class="buttonCls">
        <i v-if="icon" :class="`fas fa-plus`"></i>
        {{ btnText }}
    </button>
    <button v-if="reject" @click="isOpen = !isOpen"
        class="reject-btn px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition">
        <i class="fas fa-times mr-1"></i>
        Отклонить
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
