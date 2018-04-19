import VueRouter from 'vue-router';

import User from './route/User';
import Home from './components/Home';
import Profile from './components/Profile';
import ProductDetail from './components/ProductDetail';

import Admin from './route/Admin.vue';
import AdminHome from './components/admin/AdminHome';

window.Vue = require('vue');
Vue.use(VueRouter);

const routes = [
    { path: '/', component: User, children: [
        { path: '/', component: Home },
        { path: '/profile', component: Profile },
        { path: '/product-detail', component: ProductDetail }
    ]},
    { path: '/admin', component: Admin, children: [
        { path: '/', component: AdminHome }
    ]}
]

const router = new VueRouter({ mode: 'history', routes: routes});

export default router;