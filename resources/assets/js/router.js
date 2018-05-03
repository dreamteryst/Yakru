import VueRouter from 'vue-router';

import User from './route/User';
import Home from './components/Home';
import Profile from './components/Profile';
import ProductDetail from './components/ProductDetail';

import Admin from './route/Admin';
import AdminHome from './components/admin/AdminHome';
import CourseData from './components/admin/CourseData';
import LectureData from './components/admin/LectureData';
import StudentData from './components/admin/StudentData';
import TeacherData from './components/admin/TeacherData';
import AccountingData from './components/admin/AccountingData';
import SettingData from './components/admin/SettingData';
import PaymentData from './components/admin/PaymentData';
import UnitData from './components/admin/UnitData';
import OrderData from './components/admin/OrderData';

import Auth from './route/Auth';
import Login from './components/auth/Login';

import Error404 from './components/Error404';

window.Vue = require('vue');
Vue.use(VueRouter);

const routes = [
    { path: '', component: User, children: [
        { path: '', name: 'Home', component: Home},
        { path: 'profile', name: 'Profile', component: Profile },
        { path: 'product-detail', name: 'Product Detail', component: ProductDetail }
    ]},
    { path: '/admin', component: Admin, children: [
        { path: '', name: 'Admin', component: AdminHome },
        { path: 'course', name: 'Course', component: CourseData },
        { path: 'course/:id', name: 'Unit', component: UnitData },
        { path: 'course/:id/:unit', name: 'Lecuture', component: LectureData },
        { path: 'student', name: 'Student', component: StudentData },
        { path: 'teacher', name: 'Teacher', component: TeacherData },
        { path: 'accounting', name: 'Accounting', component: AccountingData },
        { path: 'setting', name: 'Setting', component: SettingData },
        { path: 'payment', name: 'Payment', component: PaymentData },
        { path: 'order', name: 'Order', component: OrderData },
    ]},
    { path: '/auth', component: Auth, children: [
        { path: '', name: 'Login', component: Login }
    ]},
    { path: "/errors", name: 'Page not found', component: Error404 },
    { path: "*", name: '404'}
]

const router = new VueRouter({ 
    mode: 'history', 
    routes: routes, 
    scrollBehavior (to, from, savedPosition) {
        return { x: 0, y: 0 }
    }
});

router.afterEach((toRoute, fromRoute) => {
    if(toRoute.name == '404') {
        window.location.href = '/errors'
    }
    document.title = toRoute.name + ' | Yakru'
    // console.log(toRoute)
})

export default router;