<script setup>
import Container from '@other/Container.vue'
import BlockTitle from '@titles/BlockTitle.vue'
import InfoInputBlock from '@blocks/InfoInputBlock.vue'
import DivideLine from '@other/DivideLine.vue'
import { computed, inject } from 'vue';
const userData = inject('userData');

const infoInputData = computed(() => {
    return [
        {
            mainTitle: 'Личная информация',
            line: true,
            data: [
                {
                    subtitle: 'Фамилия',
                    title: userData.surname,
                },
                {
                    subtitle: 'Имя',
                    title: userData.name,
                },
                {
                    subtitle: 'Отчество',
                    title: userData.patronymic,
                },
                {
                    subtitle: 'Дата рождения',
                    title: '123',
                },
            ],
        },
        {
            mainTitle: 'Контактная информация',
            line: true,
            data: [
                {
                    subtitle: 'Email',
                    title: userData.email,
                },
                {
                    subtitle: 'Телефон',
                    title: userData.phone,
                },
            ],
        },
        {
            mainTitle: 'Образование',
            line: false,
            data: [
                {
                    subtitle: 'Учебное заведение',
                    title: '123',
                },
                {
                    subtitle: 'Курс',
                    title: '456',
                },
                {
                    subtitle: 'Специальность',
                    title: '456',
                },
            ],
        },
    ]
});
</script>
<template>
    <Container>
        <BlockTitle :title="'Данные участника'" />
        <div class="flex flex-col space-y-4">
            <div v-for="infoInput in infoInputData" :key="infoInput.mainTitle">
                <h3 class="text-[#364153] mb-3">{{ infoInput.mainTitle }}</h3>
                <div class="flex justify-between flex-wrap">
                    <InfoInputBlock v-for="data in infoInput.data" :key="data.title" :subtitle="data.subtitle"
                        :title="data.title" />
                </div>
                <DivideLine v-if="infoInput.line" class="mb-0" />
            </div>
        </div>
    </Container>
</template>
