import { useForm, router  } from "@inertiajs/vue3";
import { onMounted, onUnmounted, reactive, watch } from "vue";

export function useBaseForm(fields, options = {}) {
    const {
        clearOnUnmount = true,
        persistKey,
        persistFields = [],
        useRemember = null,
    } = options;

    const storageKey = persistKey ? `form_${persistKey}` : null;
    const FORM = useForm(useRemember ?? storageKey, { ...fields });
    const localErrors = reactive({});

    watch(
        () => FORM.errors,
        (newErrors) => {
            localErrors.value = { ...newErrors };
        },
        { deep: true, immediate: true },
    );

    return {
        getForm() {
            return FORM;
        },

        getAllErrors(name) {
            return name ? localErrors.value[name] : localErrors.value;
        },

        hasError() {
            return FORM.hasError;
        },

        updateFormFieldValue(data) {
            FORM[data.name] = data.value;
            return this;
        },

        toLowerCase() {
            FORM.transform((data) => {
                const TRANSOFMED = {};

                Object.entries(data).forEach(([key, value]) => {
                    TRANSOFMED[key] =
                        typeof value === "string" ? value.toLowerCase() : value;
                });

                return TRANSOFMED;
            });

            return this;
        },

        submit(method = "post", route, options = {}) {
            FORM[method](route, options);
        },

        oldValue(name) {
            if (persistKey) {
                return JSON.parse(localStorage.getItem(persistKey))[name];
            }
        },

        clearErrors(name) {
            name ? FORM.clearErrors(name) : FORM.clearErrors();
        },

        reset(name) {
            FORM.reset(name);
        },
    };
}
