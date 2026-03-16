import { useForm } from "@inertiajs/vue3";
import { onUnmounted } from "vue";

export function useCustomForm(fields = {}) {
    const form = useForm({ ...fields });

    onUnmounted(() => {
        form.clearErrors();
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
        updateValue,
        submit,
    };
}
