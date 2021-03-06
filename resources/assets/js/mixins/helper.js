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
            if (this.isEmpty(url)) {
                return "";
            }
            var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
            var match = url.match(regExp);
            return match && match[7].length == 11 ? match[7] : false;
        },
        validateThaiCitizenID(id) {
            if (id.length != 13 || id.charAt(0).match(/[09]/)) return false;

            var sum = 0;
            for (var i = 0; i < 12; i++) {
                sum += parseInt(id.charAt(i)) * (13 - i);
            }

            if ((11 - (sum % 11)) % 10 != parseInt(id.charAt(12))) {
                return false;
            }

            return true;
        },
        shuffle(a) {
            for (let i = a.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [a[i], a[j]] = [a[j], a[i]];
            }
            return a;
        }
    }
});
