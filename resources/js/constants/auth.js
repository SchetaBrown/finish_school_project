const BASE_INPUT_VALUES = [
    {
        label: "Email",
        name: "email",
        type: "email",
        placeholder: "example@example.com",
    },
    {
        label: "Пароль",
        name: "password",
        type: "password",
        placeholder: "••••••••",
    },
];

export const REGISTER_INPUT_VALUES = [
    {
        label: "Имя",
        name: "name",
        placeholder: "Иван",
    },
    {
        label: "Фамилия",
        name: "surname",
        placeholder: "Иванов",
    },
    {
        label: "Отчество",
        name: "patronymic",
        placeholder: "Иванович",
    },
    ...BASE_INPUT_VALUES,
];

export const LOGIN_INPUT_VALUES = [...BASE_INPUT_VALUES];

export const PHONE_INPUT_VALUE = [
    {
        label: "Телефон",
        name: "phone",
        type: "tel",
        placeholder: "+7 (___) ___-__-__",
    },
];
