<template>
    <b-modal ref="delete-modal" :title="title">
        <p>{{ message }}</p>
        <b-form ref="delete-form" :action="action" method="post">
            <input :value="CSRFToken" type="hidden" name="_token">
            <input type="hidden" name="_method" value="DELETE">
        </b-form>
        <template v-slot:modal-footer>
            <b-button @click="cancel()" variant="info">{{ cancelText }}</b-button>
            <b-button @click="submit()" variant="danger">{{ okText }}</b-button>
        </template>
    </b-modal>
</template>

<script>
    export default {
        props: {
            title: {
                type: String,
                default: "¿Are you sure?"
            },
            message: {
                type: String,
                default: "This action cannot be undone!"
            },
            cancelText: {
                type: String,
                default: 'Cancel'
            },
            okText: {
                type: String,
                default: 'Ok'
            }
        },
        data() {
            return {
                CSRFToken: document.head.querySelector("[name=csrf-token][content]").content,
                action: null,
            }
        },
        methods: {
            cancel() {
                this.$refs['delete-modal'].hide();
                this.setAction(null);
            },
            submit() {
                this.$refs['delete-form'].submit();
            },
            setAction(action) {
                this.action = action;
            },
            show(action) {
                this.setAction(action);
                this.$refs['delete-modal'].show()
            }
        },
        mounted() {
            window.EventBus.$on('delete-item', action => {
                this.show(action)
            });
        }
    }
</script>
