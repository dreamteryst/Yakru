import Vue from "vue";

Vue.mixin({
    methods: {
        ucfirst(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        },
        getPercent(course) {
            return parseInt(
                ((course.discount - course.price) * 100) / course.discount
            );
        },
        numberWithCommas(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        isEmpty(item) {
            return !this.isNotEmpty(item);
        },
        isNotEmpty(item) {
            return (
                item !== undefined && item !== "" && item !== 0 && item !== null
            );
        },
        isError(errors, field) {
            return errors[field] !== undefined;
        }
    }
});
