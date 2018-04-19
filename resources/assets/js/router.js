import VueRouter from 'vue-router';
import Home from './components/Home';
import ProductDetail from './components/ProductDetail';

window.Vue = require('vue');
Vue.use(VueRouter);

const routes = [
    { path: '/', component: Home },
    { path: '/product-detail', component: ProductDetail}
]

const router = new VueRouter({ mode: 'history', routes: routes});

export default router;