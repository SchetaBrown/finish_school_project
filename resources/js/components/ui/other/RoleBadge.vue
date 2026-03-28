<script setup>
import { computed } from 'vue';

const props = defineProps({
    role: {
        type: String,
        required: true
    }
});

const roleConfig = {
    'администратор': {
        bg: 'bg-purple-100',
        text: 'text-purple-800'
    },
    'ответственный': {
        bg: 'bg-blue-100',
        text: 'text-blue-800'
    },
    'сопровождающий': {
        bg: 'bg-green-100',
        text: 'text-green-800'
    },
    'руководитель': {
        bg: 'bg-orange-100',
        text: 'text-orange-800'
    },
    'участник': {
        bg: 'bg-gray-100',
        text: 'text-gray-800'
    },
};

const normalizedRole = computed(() => {
    return props.role?.toLowerCase().trim() || '';
});

const roleStyle = computed(() => {
    if (roleConfig[normalizedRole.value]) {
        return roleConfig[normalizedRole.value];
    }

    if (normalizedRole.value.includes('руководитель')) {
        return roleConfig['руководитель'];
    }
    if (normalizedRole.value.includes('участник')) {
        return roleConfig['участник'];
    }

    return {
        bg: 'bg-gray-100',
        text: 'text-gray-800'
    };
});

const displayText = computed(() => {
    const role = normalizedRole.value;

    if (role.includes('руководитель')) {
        return 'Руководитель';
    }
    if (role.includes('участник')) {
        return 'Участник';
    }

    return props.role;
});
</script>

<template>
    <span :class="[roleStyle.bg, roleStyle.text]"
        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium">
        {{ displayText }}
    </span>
</template>
