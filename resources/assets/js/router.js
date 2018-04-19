import VueRouter from 'vue-router';
import Home from './components/Home';

window.Vue = require('vue');
Vue.use(VueRouter);

const routes = [
    { path: '/', component: Home }
]

const router = new VueRouter({ mode: 'history', routes: routes});

export default router;