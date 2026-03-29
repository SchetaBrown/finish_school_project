import { useForm } from "@inertiajs/vue3";
import { computed, onUnmounted } from "vue";

export function useCustomForm(fields = {}) {

    onUnmounted(() => {
        form.clearErrors();
    });

    const form = useForm({ ...fields });

    const getForm = computed(() => {
        return form;
    });

    const updateValue = (data) => {
        form[data.name] = data.value;
    };

    const submit = (routeName) => {
        form.post(routeName, {
            preserveState: true,
            preserveScroll: true,
        });
    };

    return {
        form,
        getForm,
        updateValue,
        submit,
    };
}
