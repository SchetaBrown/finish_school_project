<script setup>
import { ref, watch, computed } from "vue";
import Logotype from "./Logotype.vue";
import { useUserStore } from "@stores/user-store.js";
import { storeToRefs } from "pinia";

const userStore = useUserStore();
</script>
<template>
    <header class="flex items-center justify-center bg-white h-20 w-full border-b border-gray-200 mb-20">
        <div class="flex items-center justify-between max-w-360 w-full mx-auto px-4 sm:px-6 lg:px-8">
            <Logotype></Logotype>

            <div class="flex items-center" v-if="userStore._authStatus"></div>
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
