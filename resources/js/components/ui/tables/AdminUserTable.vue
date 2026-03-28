<script setup>
import { computed } from 'vue';
import TableContainer from '@other/TableContainer.vue';
import RoleBadge from '@other/RoleBadge.vue';

const props = defineProps(['users']);
const ths = computed(() => ['Пользователь', 'Роль', 'Аккаунт доступен', 'Email', 'Действия']);
</script>
<template>
    <TableContainer :ths="ths">
        <tr class="hover:bg-gray-50 transition w-full" v-for="user in users" :key="user.email">
            <td class="px-6 py-4">{{ user.full_name }}</td>
            <td class="px-6 py-4">
                <RoleBadge :role="user.role" />
            </td>
            <td class="px-6 py-4">{{ user.is_ban ? 'Нет' : 'Да' }}</td>
            <td class="px-6 py-4">{{ user.email }}</td>
            <td class="px-6 py-4">
                <Link :href="route('admin.user.edit', { id: user.id })" class="text-indigo-600 mr-3">
                <i class="fas fa-edit"></i>
                </Link>
            </td>
        </tr>
    </TableContainer>
</template>
