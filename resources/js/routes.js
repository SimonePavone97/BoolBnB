import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import HomePage from './components/pages/HomePage.vue';
import NotFound from './components/pages/NotFound.vue';

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        { path: '/', component: HomePage, name: 'home' },
        { path: '*', component: NotFound, name: 'notFound' },
    ]
});



export default router;