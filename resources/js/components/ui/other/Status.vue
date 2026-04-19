<script setup>
import { computed } from "vue";

const PROPS = defineProps(["status", "fontSize"]);

<<<<<<< HEAD
const PROPS = defineProps(['status', 'fontSize']);

const STATUS_CLASSES = computed(() => {
    const status = PROPS?.status?.toLowerCase().trim();

    switch (status) {
        case 'открыта регистрация':
        case 'принято':
            return 'bg-green-100 text-green-700';
        case 'регистрация закрыта':
        case 'отклонено':
            return 'bg-red-100 text-red-700';
        case 'завершено':
            return 'bg-gray-100 text-gray-600';
        case 'на рассмотрении':
            return 'bg-yellow-100 text-yellow-700';
        default:
            return 'bg-gray-100 text-gray-600';
    }
});

const FONT_SIZE = computed(() => {
    const size = PROPS.fontSize;

    if (!size) return 'text-sm';

    return '';
});

const fontSizeStyle = computed(() => {
    if (!PROPS.fontSize) return {};
    return { fontSize: `${PROPS.fontSize}px` };
});

const FONT_SIZE_CLASS = computed(() => {
    const size = PROPS.fontSize;
    const sizeMap = {
        12: 'text-xs',
        14: 'text-sm',
        16: 'text-base',
        18: 'text-lg',
        20: 'text-xl',
        24: 'text-2xl'
    };

    return sizeMap[size] || 'text-sm';
=======
const STATUS_CLASSES = computed(() => {
  const status = PROPS.status.toLowerCase();

  console.log(status);
  switch (status) {
    case "открыта регистрация" || "принято":
      return "bg-green-100 text-green-700";
    case "регистрация закрыта":
      return "bg-red-100 text-red-700";
    case "завершено":
      return "bg-gray-100 text-gray-600";
    case "на рассмотрении":
      return "bg-yellow-100 text-yellow-700";
    case "отклонено":
      return "bg-red-100 text-red-700";
  }
});

const FONT_SIZE = computed(() => {
  const SIZE = PROPS.fontSize;
  return SIZE ? `text-[${SIZE}px]` : "text-sm";
>>>>>>> bcb0195f5b2b32c235eaec7bd01ba7ed50efeae0
});
</script>

<template>
<<<<<<< HEAD
    <div class="flex items-start justify-between max-w-fit rounded-full h-fit" :class="STATUS_CLASSES">
        <span class="px-3 py-1 font-medium max-w-fit text-center" :class="FONT_SIZE_CLASS" :style="fontSizeStyle">
            {{ status }}
        </span>
    </div>
=======
  <div
    class="flex items-start justify-between max-w-fit rounded-full h-fit"
    :class="STATUS_CLASSES"
  >
    <span
      class="px-3 py-1 font-medium max-w-fit text-center"
      :class="FONT_SIZE"
    >
      {{ status }}
    </span>
  </div>
>>>>>>> bcb0195f5b2b32c235eaec7bd01ba7ed50efeae0
</template>
