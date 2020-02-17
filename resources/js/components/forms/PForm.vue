<template>
        <ValidationObserver v-slot="{ passes }" slim>
            <b-form ref="form" v-bind="$attrs" @submit.prevent="passes(onSubmit);">
                <slot/>
            </b-form>
        </ValidationObserver>
</template>

<script>
    import {ValidationObserver} from "vee-validate";
    export default {
        components: {
            ValidationObserver
        },
        methods: {
            onSubmit () {
                this.$refs.form.submit();
           }
        }
    };
</script>
