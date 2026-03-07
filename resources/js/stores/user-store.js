import { defineStore } from "pinia";
import { reactive, ref } from "vue";

export const useUserStore = defineStore("user", () => {
    // Свойства
    const IS_AUTH = ref(false);
    const USER_DATA = reactive({});

    // Геттеры

    // Методы
    function updateAuthStatus(status) {
        IS_AUTH.value = status;
    }

    return {
        USER_DATA,
        updateAuthStatus,
    };
});
