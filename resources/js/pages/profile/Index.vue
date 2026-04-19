<script setup>
const props = defineProps(['participantOlympiadOrders', 'educationManagerOlympiadOrders', 'role']);
import AppBaseLayout from '@layouts/AppBaseLayout.vue';
import TheProfileAside from '@components/partials/TheProfileAside.vue';
import Container from '@other/Container.vue'
import ParticipantProfileSection from '@sections/profile/ParticipantProfileSection.vue';
import EducationManagerProfileSection from '@sections/profile/EducationManagerProfileSection.vue';
</script>
<template>
    <AppBaseLayout>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <TheProfileAside />
            <div class="lg:col-span-3 space-y-6">
                <ParticipantProfileSection v-if="role === 'Участник'" :orders="participantOlympiadOrders.data"
                    :links="participantOlympiadOrders.links" />
                <EducationManagerProfileSection v-else-if="role === 'Руководитель'"
                    :orders="educationManagerOlympiadOrders.data" :links="educationManagerOlympiadOrders.links" />
            </div>
        </div>
    </AppBaseLayout>
</template>
