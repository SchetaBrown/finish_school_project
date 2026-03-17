import { reactive, onMounted, onUnmounted } from "vue";
import { router } from "@inertiajs/vue3";

export function useFilter(options = {}) {
    const {
        storageKey = "form",
        routeName = null,
        preserveScroll = true,
        clearOnUnmount = true,
        preserveState = true,
        onSuccess = null,
        onError = null,
        only = [],
    } = options;

    const form = reactive({});

    const loadFromStorage = () => {
        const saved = localStorage.getItem(storageKey);
        if (saved) {
            try {
                const parsed = JSON.parse(saved);
                Object.assign(form, parsed);
            } catch (e) {
                localStorage.removeItem(storageKey);
            }
        }
    };

    const saveToStorage = () => {
        localStorage.setItem(storageKey, JSON.stringify(form));
    };

    const submit = async () => {
        if (!routeName) {
            console.error("❌ routeName не указан");
            return;
        }

        try {
            saveToStorage();

            const saved = localStorage.getItem(storageKey);

            let dataToSend = { ...form };

            if (saved) {
                dataToSend = {
                    ...JSON.parse(saved),
                    ...form,
                };
            }

            const cleanData = Object.fromEntries(
                Object.entries(dataToSend).filter(
                    ([_, value]) =>
                        value !== "" && value !== null && value !== undefined,
                ),
            );

            router.get(route(routeName), cleanData, {
                preserveState: preserveState,
                preserveScroll: preserveScroll,
                replace: true,
                only: only ? [only] : undefined,
                onSuccess: (page) => {
                    if (only && onSuccess) {
                        onSuccess(page.props[only]);
                    } else if (onSuccess) {
                        onSuccess(page.props);
                    }
                },
                onError: (errors) => {
                    if (onError) onError(errors);
                },
            });
        } catch (error) {
            console.error("❌ Ошибка:", error);
        }
    };

    const clear = () => {
        try {
            localStorage.removeItem(storageKey);

            Object.keys(form).forEach((key) => {
                form[key] = "";
            });

            router.get(route(routeName));
        } catch (error) {
            console.error("❌ Ошибка при очистке:", error);
        }
    };

    const setField = (data) => {
        form[data.name] = data.value;
        saveToStorage();
    };

    const setFields = (fields) => {
        Object.assign(form, fields);
        saveToStorage();
    };

    const reset = () => {
        Object.keys(form).forEach((key) => {
            form[key] = "";
        });
        localStorage.removeItem(storageKey);
    };

    onMounted(() => {
        loadFromStorage();
    });

    onUnmounted(() => {
        if (clearOnUnmount) {
            localStorage.removeItem(storageKey);
        }
    });

    return {
        form,
        submit,
        clear,
        reset,
        setField,
        setFields,
        loadFromStorage,
        saveToStorage,
    };
}
