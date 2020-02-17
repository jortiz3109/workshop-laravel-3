<template>
    <b-button :variant="variant" :size="size" @click="deleteItem(action)">
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
                default: "danger"
            },
            size: {
                type: String,
                default: "sm"
            }
        },
        methods: {
            deleteItem(action) {
                window.EventBus.$emit('delete-item', action);
            },
        }
    }
</script>
