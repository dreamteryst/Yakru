import Vue from "vue";

Vue.mixin({
    methods: {
        getPercent(course) {
            return parseInt(
                ((course.discount - course.price) * 100) / course.discount
            );
        },
        getPrice(percent, price) {
            return parseInt(
                price * (1-(percent/100))
            );
        }
    }
});
