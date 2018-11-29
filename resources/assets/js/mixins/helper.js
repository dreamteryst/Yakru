import Vue from "vue";
import moment from "moment";
Vue.mixin({
    methods: {
        dateFormat(datetime, format) {
            return moment(datetime).format(format);
        },
        ucfirst(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
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
        },
        renderPicture(picture) {
            if (picture !== undefined && picture !== "" && picture !== null) {
                if (picture.startsWith("http") || picture.startsWith("blob")) {
                    return picture;
                } else {
                    return `/photo/${picture}`;
                }
            } else {
                // null image
                return "https://fakeimg.pl/240x135/";
            }
        },
        youtube_parser(url) {
            var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
            var match = url.match(regExp);
            return match && match[7].length == 11 ? match[7] : false;
        }
    }
});
