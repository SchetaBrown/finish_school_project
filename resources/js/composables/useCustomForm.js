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
        const field = form[data.name];
<<<<<<< HEAD
        if (typeof data.value === 'object') {
=======
        if (typeof field === 'object' && field !== null) {
>>>>>>> bcb0195f5b2b32c235eaec7bd01ba7ed50efeae0
            if (data.clear) {
                const index = field.indexOf(data.value);

                if (index !== -1) {
                    field.splice(index, 1);
                }
            } else {
                if (!field.includes(data.value)) {
                    field.push(data.value);
                }
            }
        } else {
            form[data.name] = data.value;
        }
    };

    const submit = (routeName, method, params) => {
        form[method || 'post'](routeName, {
            preserveState: true,
            preserveScroll: true,
            onError: (error) => {
                console.log('Произошла ошибка', error)
            },
            params
        });
    };

    return {
        form,
        getForm,
        updateValue,
        submit,
    };
}
