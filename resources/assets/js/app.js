
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import App from './route/App.vue';
import router from './router';
import store from './store/';
require('./bootstrap');

window.Vue = require('vue');

// const router = new VueRouter({
//     routes // short for `routes: routes`
// })
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue(
    Vue.util.extend({ router }, App),
    store
).$mount('#page-container');