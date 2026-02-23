<script setup>
import Logotype from "./Logotype.vue";
</script>
<template>
  <footer
    class="flex items-center justify-between border-t border-(--gray-color) mt-20 bg-white h-20 px-4 sm:px-6 lg:px-8"
  >
    <div class="flex items-center justify-between max-w-360 w-full mx-auto">
      <Logotype></Logotype>
      <span class="text-sm text-gray-400"
        >© 2026 Event Hub — платформа для участия в олимпиадах и
        соревнованиях</span
      >
      <nav>
        <ul class="flex space-x-4 mt-4 md:mt-0">
          <li>
            <Link class="text-sm text-gray-400 hover:text-gray-600 transition">
              О нас
            </Link>
          </li>
          <li>
            <Link class="text-sm text-gray-400 hover:text-gray-600 transition">
              Помощь
            </Link>
          </li>
          <li>
            <Link class="text-sm text-gray-400 hover:text-gray-600 transition">
              Контакты
            </Link>
          </li>
        </ul>
      </nav>
    </div>
  </footer>
</template>
