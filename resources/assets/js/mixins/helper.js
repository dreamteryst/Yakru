import Vue from 'vue';

Vue.mixin({
    methods: {
        isEmpty(item) {
            return !this.isNotEmpty(item)
        },
        isNotEmpty(item) {
            return item !== undefined && item !== "" && item !== 0 && item !== null
        },
        isError(errors, field){
            return errors[field] !== undefined;
        }
    },
});
