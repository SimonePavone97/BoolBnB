import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import HomePage from './components/pages/HomePage.vue';
import ApartmentDetailPage from './components/pages/ApartmentDetailPage.vue';
import NotFound from './components/pages/NotFound.vue';
import AdvancedSearch from './components/pages/AdvancedSearch.vue';

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        { path: '/', component: HomePage, name: 'home' },
        { path: '/apartments/:id', component: ApartmentDetailPage, name: 'apartment-detail' },
        { path: '/advanced', component: AdvancedSearch, name: 'AdvancedSearch' },
        { path: '*', component: NotFound, name: 'notFound' },
        
    ]
});



export default router;