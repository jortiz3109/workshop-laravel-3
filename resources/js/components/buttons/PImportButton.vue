<template>
    <b-button :variant="variant" :size="size" @click="importFile(action)">
        <slot/>
    </b-button>
</template>

<script>
    export default {
        props: {
            action: {
                type: String
            },
            variant: {
                type: String,
                default: "info"
            },
            size: {
                type: String,
                default: "sm"
            }
        },
        methods: {
            importFile(action) {
                window.EventBus.$emit('import-file', action);
            },
        }
    }
</script>
