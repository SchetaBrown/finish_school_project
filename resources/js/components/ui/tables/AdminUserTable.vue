<script setup>
import { computed } from 'vue';

const props = defineProps(['users']);
const ths = computed(() => ['Пользователь', 'Роль', 'Аккаунт доступен', 'Email', 'Действия']);

console.log(props.users)
</script>
<template>
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-xs font-medium text-gray-400 uppercase tracking-wider"
                            v-for="th in ths" :key="th">{{ th }}</th>
                    </tr>
                </thead>
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
