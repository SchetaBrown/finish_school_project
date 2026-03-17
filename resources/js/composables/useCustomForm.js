import { useForm } from "@inertiajs/vue3";
import { onUnmounted } from "vue";

export function useCustomForm(fields = {}) {

    onUnmounted(() => {
        form.clearErrors();
    });

    const form = useForm({ ...fields });

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
