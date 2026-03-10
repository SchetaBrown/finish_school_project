<script setup>
import { usePage } from '@inertiajs/vue3';
import Logotype from "./Logotype.vue";
import UserProfileButton from "@buttons/UserProfileButton.vue";
import { computed } from "vue";

const page = usePage();
const userData = computed(() => {
    return page.props.auth.user ?? [];
});
</script>
<template>
    <header class="flex items-center justify-center bg-white h-20 w-full border-b border-gray-200 mb-20">
        <div class="flex items-center justify-between max-w-360 w-full mx-auto px-4 sm:px-6 lg:px-8">
            <Logotype></Logotype>

            <div class="flex items-center" v-if="$page.props.auth.isAuthenticated && userData.length !== 0">
                <UserProfileButton :userData="userData" />
            </div>
            <ul class="flex gap-2" v-else>
                <li>
                    <Link :href="route('login.create')"
                        class="flex items-center justify-center px-10 py-2 bg-indigo-600 text-white rounded-md max-h-11.25 h-full">
                    Вход</Link>
                </li>
                <li>
                    <Link :href="route('register.create')"
                        class="flex items-center justify-center px-10 py-2 border-2 border-indigo-600 rounded-md text-indigo-600 font-medium max-h-11.25">
                    Регистрация</Link>
                </li>
            </ul>
        </div>
    </header>
</template>
