<script setup>

const LINKS = [
    {
        title: 'О нас',
        href: '#',
    },
    {
        title: 'Помощь',
        href: '#',
    },
    {
        title: 'Контакты',
        href: '#',
    },
];

import Logotype from "./Logotype.vue";
</script>
<template>
  <footer
    class="flex items-center justify-between border-t border-gray-200 mt-20 bg-white h-20 px-4 sm:px-6 lg:px-8"
  >
    <div class="flex items-center justify-between max-w-360 w-full mx-auto">
      <Logotype></Logotype>
      <span class="text-sm text-gray-400"
        >© 2026 Event Hub — платформа для участия в олимпиадах и
        соревнованиях</span
      >
      <nav>
        <ul class="flex space-x-4 mt-4 md:mt-0">
          <li v-for="link in LINKS" :key="link.title">
            <Link :href="link.href" class="text-sm text-gray-400 hover:text-gray-600 transition">
              {{ link.title }}
            </Link>
          </li>
        </ul>
      </nav>
    </div>
  </footer>
</template>
