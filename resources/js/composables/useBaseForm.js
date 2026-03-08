import { useForm } from "@inertiajs/inertia-vue3";
import { reactive, watch } from "vue";

export function useBaseForm(fields) {
    const FORM = useForm({ ...fields });

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

        updateFormFieldValue(name, value) {
            FORM[name] = value;
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

        clearErrors(name) {
            name ? FORM.clearErrors(name) : FORM.clearErrors();
        },
    };
}
