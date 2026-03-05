<script setup>

</script>
<template>
  <div class="col-span-1 md:col-span-2 lg:col-span-1">
    <label class="block text-sm font-medium text-gray-700 mb-1" for="title"
      >Поиск</label
    >
    <div class="relative">
      <i
        class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"
      ></i>
      <input
        type="text"
        name="title"
        placeholder="Введите название олимпиады..."
        class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
      />
    </div>
  </div>
</template>
