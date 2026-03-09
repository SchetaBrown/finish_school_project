<script setup>
const PROPS = defineProps(['olympiad', 'user']);
console.log(PROPS.user)
import AppBaseLayout from '@layouts/AppBaseLayout.vue'
import OlympiadCreateDocumentBlock from '@blocks/olympiad/OlympiadCreateDocumentBlock.vue'
import PageTitle from '@titles/PageTitle.vue'
import BlockTitle from '@titles/BlockTitle.vue'
import Container from '@other/Container.vue'
</script>
<template>
    <AppBaseLayout>
        <PageTitle :title="'Регистрация на олимпиаду'" :subtitle="'Проверьте данные перед отправкой'" />
        <OlympiadCreateDocumentBlock></OlympiadCreateDocumentBlock>
        <div class="grid grid-cols-2 gap-5 mt-8 w-full">
            <Container>
                <BlockTitle :title="'Данные участника'" />
            </Container>
            <div class="flex flex-col gap-5 w-full">
                <Container>
                    <BlockTitle :title="'Здесь название олимпиады'" />

                </Container>
                <Container>
                    <BlockTitle :title="'Подтверждение'" />
                </Container>
            </div>
        </div>
    </AppBaseLayout>
</template>
