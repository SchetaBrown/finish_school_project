<script setup>
const PROPS = defineProps(["olympiad", "managers"]);
import { computed } from "vue";
import AppBaseLayout from "@layouts/AppBaseLayout.vue";
import OlympiadCreateDocumentBlock from "@blocks/olympiad/create/OlympiadCreateDocumentBlock.vue";
import OlympiadUserDataBlock from "@blocks/olympiad/create/OlympiadUserDataBlock.vue";
import PageTitle from "@titles/PageTitle.vue";
import BlockTitle from "@titles/BlockTitle.vue";
import Container from "@other/Container.vue";
import Status from "@other/Status.vue";
import DivideLine from "@other/DivideLine.vue";
import InfoInputBlock from "@blocks/InfoInputBlock.vue";
import CreateOlympiadOrderModal from "@modals/create/CreateOlympiadOrderModal.vue";

const OLYMPIAD_DATA = computed(() => {
    return PROPS.olympiad.data;
});

const OLYMPIAD_TYPES = computed(() => {
    const types = OLYMPIAD_DATA.value?.types;

    if (!types || types.length === 0) {
        return "";
    }

    const formattedTypes = types
        .map((type, index) => {
            if (!type) return "";

            if (index === 0) {
                return type.charAt(0).toUpperCase() + type.slice(1).toLowerCase();
            }
            return type.toLowerCase();
        })
        .filter(Boolean);

    return formattedTypes.join(", ");
});

const SPONSOR = computed(() => {
    return OLYMPIAD_DATA.value.organizer ?? "Не указан";
});

const OLYMPIAD_DATA_BLOCK = computed(() => {
    return [
        {
            subtitle: "Направление",
            title: OLYMPIAD_DATA.value.direction,
        },
        {
            subtitle: "Тип участия",
            title: OLYMPIAD_TYPES.value ?? "Не указан",
        },
    ];
});
</script>
<template>
    <AppBaseLayout>
        <PageTitle :title="'Регистрация на олимпиаду'" :subtitle="'Проверьте данные перед отправкой'" />
        <OlympiadCreateDocumentBlock></OlympiadCreateDocumentBlock>

        <CreateOlympiadOrderModal :managers="managers.data" :olympiad="OLYMPIAD_DATA" />

        <div class="grid grid-cols-2 gap-5 mt-8 w-full max-lg:grid-cols-1">
            <OlympiadUserDataBlock></OlympiadUserDataBlock>
            <div class="flex flex-col gap-5 w-full">
                <Container>
                    <div class="flex justify-between flex-wrap">
                        <BlockTitle :title="OLYMPIAD_DATA.title" :full-text="true" />
                        <Status :status="OLYMPIAD_DATA.status" :fontSize="'12'" />
                    </div>
                    <span class="text-sm text-[#6A7282]">Организатор: {{ SPONSOR }}</span>
                    <DivideLine />
                    <div class="flex justify-between max-sm:grid max-sm:grid-cols-1 max-sm:gap-4 max-sm:justify-center">
                        <InfoInputBlock v-for="data in OLYMPIAD_DATA_BLOCK" :key="data.subtitle" :title="data.title"
                            :subtitle="data.subtitle" />
                    </div>
                </Container>
                <Container>
                    <BlockTitle :title="'Подтверждение'" />
                </Container>
            </div>
        </div>
    </AppBaseLayout>
</template>
