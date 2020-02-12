<template>
    <ValidationProvider
        ref="validationProvider"
        :vid="vid"
        :name="$attrs.name"
        :rules="rules"
        v-slot="{ errors }"
        slim
    >
        <b-form-group
            :id="formGroupID"
            :description="description"
            :label="label"
            :label-for="$attrs.id"
        >
            <b-form-select
                v-bind="$attrs"
                v-model="value"
                :state="errors[0] ? false : null"
            >
                <template v-slot:first v-if="placeholder">
                    <b-form-select-option :value="null" disabled>{{ placeholder }}</b-form-select-option>
                </template>
            </b-form-select>
            <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
        </b-form-group>
    </ValidationProvider>
</template>

<script>
    import { ValidationProvider } from "vee-validate";

    export default {
        components: {
            ValidationProvider
        },
        props: {
            vid: {
                type: String
            },
            rules: {
                type: [Object, String],
                default: ""
            },
            label: {
                type: String,
                default: null
            },
            description: {
                type: String,
                default: null,
            },
            error: {
                default: null,
            },
            initialValue:{
                default: null,
            },
            placeholder: {
                type: String,
                default: null
            }
        },
        computed: {
            formGroupID: function() {
                return 'fieldset-for-' + this.$attrs.id;
            }
        },
        data: function() {
            return {
                value: null,
            }
        },
        methods: {
            addError(error) {
                this.$refs.validationProvider.setErrors([this.error]);
            }
        },
        created() {
            if (this.initialValue) {
                this.value = this.initialValue;
            }
        },
        mounted() {
            if (this.error) {
                this.addError(this.error);
            }
        }
    };
</script>

