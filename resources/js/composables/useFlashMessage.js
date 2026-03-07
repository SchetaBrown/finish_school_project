import { usePage } from "@inertiajs/inertia-vue3";
import { computed } from "vue";

export function useFlashMessage() {
    const PAGE = usePage();

    const ERRORS = computed(() => {
        return PAGE.props.value.errors;
    });

    const SUCCESS = computed(() => {
        return PAGE.props.value.success;
    });

    return {
        PAGE,

        getGlobalErrors() {
            return ERRORS;
        },

        getSucessMessage() {
            return SUCCESS;
        },
    };
}
