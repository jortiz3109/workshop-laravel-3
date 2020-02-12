<template>
    <b-alert
        :show="dismissCountDown"
        dismissible
        :variant="variant"
        fade
        @dismissed="dismissCountDown=0"
        @dismiss-count-down="countDownChanged"
    >
        <slot/>
        <b-progress
            :variant="variant"
            :max="dismissSecs"
            :value="dismissCountDown"
            height="4px"
        />
    </b-alert>
</template>

<script>
    export default {
        props: {
            variant: {
                type: String,
                default: 'info'
            },
            dismiss: {
                type: Number,
                default: null,
            }
        },
        data() {
            return {
                dismissSecs: 10,
                dismissCountDown: 10,
                showDismissibleAlert: false
            }
        },
        created() {
            if (this.dismiss) {
                this.dismissSecs = this.dismiss;
            }
        },
        methods: {
            countDownChanged(dismissCountDown) {
                this.dismissCountDown = dismissCountDown
            }
        }
    }
</script>

