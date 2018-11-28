import Vue from "vue";

Vue.mixin({
    methods: {
        getPercent(course) {
            return parseInt(
                ((course.course_price - course.course_discounted) * 100) / course.course_price
            );
        },
        getPrice(percent, price) {
            return (price * (1-(percent/100))).toFixed(2)
        }
    }
});
