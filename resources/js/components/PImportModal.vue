<template>
    <b-modal ref="import-modal" :title="title">
        <p>{{ message }}</p>
        <b-form ref="import-form" :action="action" method="POST" enctype="multipart/form-data">
            <input :value="CSRFToken" type="hidden" name="_token">
            <p-file-input
                name="import_file"
                id="import_file"
                rules="required|ext:xls,xlsx"
                accept=".xlsx, .xls"
                :error="error"
                >
            </p-file-input>
        </b-form>
        <template v-slot:modal-footer>
            <b-button @click="cancel()" variant="info">{{ cancelText }}</b-button>
            <b-button @click="submit()" variant="success">{{ okText }}</b-button>
        </template>
    </b-modal>
</template>

<script>
    export default {
        props: {
            title: {
                type: String,
                default: "Import"
            },
            message: {
                type: String,
                default: "Please select a file to be imported"
            },
            cancelText: {
                type: String,
                default: 'Cancel'
            },
            okText: {
                type: String,
                default: 'Ok'
            },
            error: {
                type: String,
                default: null
            },
            action: {
                type: String
            }
        },
        data() {
            return {
                CSRFToken: document.head.querySelector("[name=csrf-token][content]").content,
            }
        },
        methods: {
            cancel() {
                this.hide();
            },
            submit() {
                this.hide();
                this.$refs['import-form'].submit();
            },
            show() {
                this.$refs['import-modal'].show()
            },
            hide() {
                this.$refs['import-modal'].hide();
            }
        },
        mounted() {
            window.EventBus.$on('import-file', params => {
                this.show();
            });

            if (this.error) {
                this.show();
            }
        }
    }
</script>
