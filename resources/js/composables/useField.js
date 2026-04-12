import { computed, ref, watch } from 'vue'

export function useField(props, emit, customConfig = {}) {
    const innerValue = ref(customConfig.formatIn?.(props.modelValue) ?? props.modelValue)

    const error = computed(() => {
        if (props.error) return props.error
        if (props.form?.errors?.[props.name]) return props.form.errors[props.name]
        return null
    })

    const isDirty = computed(() => {
        if (props.isDirty !== undefined) return props.isDirty
        return props.form?.isDirty?.[props.name] ?? true
    })

    const updateValue = (newValue) => {
        let finalValue = newValue

        if (customConfig.formatOut) {
            finalValue = customConfig.formatOut(newValue)
        }

        innerValue.value = customConfig.formatIn?.(finalValue) ?? finalValue

        emit('update:modelValue', finalValue)

        if (props.form?.setData) {
            props.form.setData(props.name, finalValue)
            props.form.clearErrors(props.name)
        }
    }

    watch(() => props.modelValue, (newVal) => {
        const formatted = customConfig.formatIn?.(newVal) ?? newVal
        if (formatted !== innerValue.value) {
            innerValue.value = formatted
        }
    })

    return {
        innerValue,
        error,
        isDirty,
        updateValue
    }
}
