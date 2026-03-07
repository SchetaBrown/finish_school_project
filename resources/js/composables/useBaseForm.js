import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { reactive, ref, watch } from "vue";

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

        getAllErrors() {
            return localErrors.value;
        },

        getErrorByName(name) {
            return localErrors.value[name];
        },

        updateFormFieldValue(name, value) {
            FORM[name] = value;
            return this;
        },

        toLowerCase() {
            FORM.transform((data) => {
                const transformed = {};
                Object.entries(data).forEach(([key, value]) => {
                    transformed[key] =
                        typeof value === "string" ? value.toLowerCase() : value;
                });
                return transformed;
            });

            return this;
        },

        submit(method = "post", route, callback = {}) {
            FORM[method](route, callback);
        },

        clearErrors(name) {
            FORM.clearErrors(name);
            FORM.clearErrors("password");
        },
    };
}
