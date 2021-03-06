
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
import $ from 'jquery';
import App from './route';
import router from './router';
import store from './store/';
import BootstrapVue from 'bootstrap-vue';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import InputTag from 'vue-input-tag';
import './mixins';
import 'eonasdan-bootstrap-datetimepicker'
import './load-widgets'

window.Vue = require('vue');
Vue.use(BootstrapVue);
Vue.component('input-tag', InputTag);

// const router = new VueRouter({
//     routes // short for `routes: routes`
// })
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
new Vue({
    router,
    store,
    ...App,
}).$mount('#app');