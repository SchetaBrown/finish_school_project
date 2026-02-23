<script setup>
import Logotype from "./Logotype.vue";

const IS_AUTH = false;
</script>
<template>
  <header
    class="flex items-center justify-center bg-white h-20 w-full border-b border-(--gray-color) mb-20"
  >
    <div class="flex items-center justify-between max-w-360 w-full mx-auto">
      <Logotype></Logotype>
      <div class="flex items-center" v-if="IS_AUTH">

      </div>
      <ul v-else>
        <li class="flex gap-2">
          <Link
            :href="route('login.create')"
            class="flex items-center justify-center px-10 py-2 bg-indigo-600 text-white rounded-md"
            >Вход</Link
          >
          <Link
            :href="route('register.create')"
            class="flex items-center justify-center px-10 py-2 border-2 border-indigo-600 rounded-md text-indigo-600 font-medium"
            >Регистрация</Link
          >
        </li>
      </ul>
    </div>
  </header>
</template>
