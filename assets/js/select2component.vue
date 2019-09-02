<template>
    <select2 :options="options" v-model="selected">
        <option disabled value="0">Select one</option>
    </select2>
</template>

<script>
    export default {
        props: ['options', 'value'],
        mounted: function () {
            var vm = this;
            $(this.$el)
            // init select2
                .select2({data: this.options})
                .val(this.value)
                .trigger('change')
                // emit event on change.
                .on('change', function () {
                    vm.$emit('input', this.value)
                })
        },
        watch: {
            value: function (value) {
                // update value
                $(this.$el)
                    .val(value)
                    .trigger('change')
            },
            options: function (options) {
// update options
                $(this.$el).empty().select2({data: options})
            }
        },
        destroyed: function () {
            $(this.$el).off().select2('destroy')
        }
    }
</script>
