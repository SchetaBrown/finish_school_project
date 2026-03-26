<script setup>
import { computed } from 'vue';
import TableHead from '@other/TableHead.vue';

const props = defineProps(['users']);
const ths = computed(() => ['Пользователь', 'Роль', 'Аккаунт доступен', 'Email', 'Действия']);
</script>
<template>
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <TableHead :ths="ths" />
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50 transition" v-for="user in users" :key="user.email">
                        <td class="px-6 py-4">{{ user.full_name }}</td>
                        <td class="px-6 py-4">{{ user.role }}</td>
                        <td class="px-6 py-4">{{ user.is_ban ? 'Нет' : 'Да' }}</td>
                        <td class="px-6 py-4">{{ user.email }}</td>
                        <td class="px-6 py-4">
                            <Link :href="route('admin.user.edit', { id: user.id })" class="text-indigo-600 mr-3">
                            <i class="fas fa-edit"></i>
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
