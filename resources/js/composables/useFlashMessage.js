import { usePage } from '@inertiajs/vue3'
import { ref, watch, computed } from 'vue'

export function useFlashMessage(options = {}) {
    const {
        duration = 5000,
        autoClose = true
    } = options

    const page = usePage()
    const flashMessage = ref(null)
    const visible = ref(false)
    const timeoutId = ref(null)

    watch(() => page.props.flash, (flash) => {
        if (flash) {
            const type = Object.keys(flash).find(key =>
                ['success', 'warning', 'info', 'error'].includes(key)
            )

            if (type && flash[type]) {
                showMessage({
                    type,
                    message: flash[type]
                })
            }
        }
    }, { deep: true, immediate: true })

    const showMessage = (message) => {
        if (timeoutId.value) {
            clearTimeout(timeoutId.value)
        }

        flashMessage.value = message
        visible.value = true

        if (autoClose) {
            timeoutId.value = setTimeout(() => {
                hideMessage()
            }, duration)
        }
    }

    const hideMessage = () => {
        visible.value = false
        if (timeoutId.value) {
            clearTimeout(timeoutId.value)
            timeoutId.value = null
        }
    }

    const iconMap = {
        success: 'fas fa-check-circle',
        warning: 'fas fa-exclamation-triangle',
        info: 'fas fa-info-circle',
        error: 'fas fa-times-circle'
    }

    const colorMap = {
        success: 'green',
        warning: 'yellow',
        info: 'blue',
        error: 'red'
    }

    const icon = computed(() => iconMap[flashMessage.value?.type] || 'fas fa-bell')
    const color = computed(() => colorMap[flashMessage.value?.type] || 'gray')
    const message = computed(() => flashMessage.value?.message || '')

    return {
        flashMessage,
        visible,
        icon,
        color,
        message,
        showMessage,
        hideMessage
    }
}
