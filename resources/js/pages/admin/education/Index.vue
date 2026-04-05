<script setup>
import AppAdminLayout from '@layouts/AppAdminLayout.vue'
import Container from '@other/Container.vue'
</script>
<template>
    <AppAdminLayout>
        <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-6">Учебные справочники</h1>
        <div class="grid grid-cols-4 gap-4">
            <Link :href="route('admin.education.school.index')">
            <Container>
                <h2 class="text-center">Учебные заведения</h2>
            </Container>
            </Link>
            <Link :href="route('admin.education.direction.index')">
            <Container>
                <h2 class="text-center">Учебные направления</h2>
            </Container>
            </Link>
        </div>
    </AppAdminLayout>
</template>
