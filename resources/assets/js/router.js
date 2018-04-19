import VueRouter from 'vue-router';

import User from './route/User';
import Home from './components/Home';
import Profile from './components/Profile';
import ProductDetail from './components/ProductDetail';

import Admin from './route/Admin';
import AdminHome from './components/admin/AdminHome';

import Auth from './route/Auth';
import Login from './components/auth/Login';

import Error404 from './components/Error404';

window.Vue = require('vue');
Vue.use(VueRouter);

const routes = [
    { path: '/', component: User, children: [
        { path: '/', name: 'Home', component: Home},
        { path: '/profile', name: 'Profile', component: Profile },
        { path: '/product-detail', name: 'Product Detail', component: ProductDetail }
    ]},
    { path: '/admin', component: Admin, children: [
        { path: '/', name: 'Admin', component: AdminHome }
    ]},
    { path: '/auth', component: Auth, children: [
        { path: '/', name: 'Login', component: Login }     
    ]},
    { path: "/errors", name: 'Page not found', component: Error404 },
    { path: "*", name: '404'}
]

const router = new VueRouter({ mode: 'history', routes: routes});
router.afterEach((toRoute, fromRoute) => {
    if(toRoute.name == '404') {
        window.location.href = '/errors'
    }
    document.title = toRoute.name + ' | Yakru'
    // console.log(toRoute)
})

export default router;