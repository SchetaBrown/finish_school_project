import { usePage } from "@inertiajs/vue3";
import { defineStore } from "pinia";
import { computed, ref, watch } from "vue";

export const useUserStore = defineStore(
    "user",
    () => {
        // Свойства
        const _authStatus = ref(false);
        const _user = ref(null);
        const page = usePage();

        // Геттеры
        const isAuthenticated = computed(() => {
            return _authStatus.value;
        });

        // Методы
        function updateAuthStatus(status) {
            _authStatus.value = status;
        }

        function syncWithServer() {
            const userData =
                page.props.user_data ||
                page.props.auth?.user ||
                page.props.user;

            if (userData) {
                _user.value = userData;
                _authStatus.value = true;
            } else {
                _user.value = null;
                _authStatus.value = false;
                localStorage.removeItem("user");
            }
        }

        watch(
            () => page.props.auth,
            () => {
                syncWithServer();
            },
            { deep: true, immediate: true },
        );

        return {
            _user,
            _authStatus,

            isAuthenticated,

            updateAuthStatus,
            syncWithServer,
        };
    },
    {
        persist: true,
    },
);
