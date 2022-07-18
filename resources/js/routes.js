import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import HomePage from './components/pages/HomePage.vue';
import ApartmentDetailPage from './components/pages/ApartmentDetailPage.vue';
import NotFound from './components/pages/NotFound.vue';
import ShowSponsorships from './components/pages/Payment/ShowSponsorships.vue';
import AdvancedSearch from './components/pages/AdvancedSearch.vue';
import MessagesSend from './components/pages/MessagesSend.vue';


const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        { path: '/', component: HomePage, name: 'home' },
        { path: '/apartments/:id', component: ApartmentDetailPage, name: 'apartment-detail' },
        { path: '/advanced', component: AdvancedSearch, name: 'AdvancedSearch' },
        { path: '*', component: NotFound, name: 'notFound' },
        { path: '/sponsorships', component: ShowSponsorships, name: 'sponsorships' },
        { path: '/messages', component: MessagesSend, name: 'MessagesSend' }
    ]
});



export default router;