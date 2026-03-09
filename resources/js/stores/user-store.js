import { usePage } from "@inertiajs/vue3";
import { defineStore } from "pinia";
import { computed, ref, watch } from "vue";

export const useUserStore = defineStore(
    "user",
    () => {
        // Свойства
        const _authStatus = ref(false);
        const page = usePage();

        // Геттеры
        const isAuthenticated = computed(() => {
            return _authStatus.value;
        });

        // Методы
        function updateAuthStatus(status) {
            _authStatus.value = status;
        }

        // Принудительная синхронизация с сервером
        function syncWithServer() {
            const isAuthFromServer = page.props.isAuthenticated;

            // Если сервер вернул конкретное значение (true/false)
            if (isAuthFromServer !== undefined && isAuthFromServer !== null) {
                // Обновляем только если значение отличается
                if (_authStatus.value !== isAuthFromServer) {
                    _authStatus.value = isAuthFromServer;
                }
            } else {
            }
        }

        // Следим за всеми изменениями пропсов
        watch(
            () => page.props,
            () => {
                syncWithServer();
            },
            { deep: true, immediate: true },
        );

        return {
            _authStatus,
            isAuthenticated,
            updateAuthStatus,
            syncWithServer,
        };
    },
    {
        persist: {
            paths: ["_authStatus"],
            storage: localStorage,
        },
    },
);
