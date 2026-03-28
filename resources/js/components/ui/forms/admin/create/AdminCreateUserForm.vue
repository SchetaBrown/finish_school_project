<script setup>
const props = defineProps(['roles']);
import InputBlock from '@blocks/InputBlock.vue'
import BaseList from '@lists/BaseList.vue'
import BaseButton from '@buttons/BaseButton.vue'
import { computed } from 'vue';
import { useCustomForm } from "@composables/useCustomForm";

const { form, updateValue, submit } = useCustomForm({
    surname: "",
    name: "",
    patronymic: "",
    email: "",
    phone: "",
    password: "",
    role_id: ''
});

const inputs = computed(() => [
    {
        label: 'Фамилия',
        name: 'surname',
        placeholder: 'Введите фамилию...',
        component: InputBlock
    },
    {
        label: 'Имя',
        name: 'name',
        placeholder: 'Введите имя...',
        component: InputBlock
    },
    {
        label: 'Отчество',
        name: 'patronymic',
        placeholder: 'Введите отчество...',
        component: InputBlock
    },
    {
        label: 'Email',
        name: 'email',
        type: 'email',
        placeholder: 'Введите email...',
        component: InputBlock
    },
    {
        label: 'Пароль',
        name: 'password',
        type: 'password',
        placeholder: 'Введите пароль...',
        component: InputBlock
    },
    {
        label: 'Телефон',
        name: 'phone',
        type: 'tel',
        placeholder: '+7 (___) ___-__-__',
        component: InputBlock
    },
    {
        label: 'Роль',
        name: 'role_id',
        options: props.roles,
        component: BaseList
    },
]);
</script>
<template>
    <Container>
        <form @submit.prevent="submit(route('admin.user.store'))" class="">
            <div class="grid grid-cols-2 gap-3">
                <component :is="input.component" v-for="input in inputs" :key="input.name" :label="input.label"
                    :name="input.name" :placeholder="input.placeholder" :type="input.type" :options="input.options"
                    @update-value="updateValue" :form="form" />
            </div>
            <BaseButton text="Создать" class="mt-5" />
        </form>
    </Container>
</template>
