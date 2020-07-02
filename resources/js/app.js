require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import App from './views/App'

import HeaderComponent from './components/HeaderComponent'

import Profile from './views/profile/Page'
import Brief from './views/brief/Page'
import BriefCreateUpdate from './views/brief/CreateUpdate'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/admin',
            name: 'profile',
            component: Profile
        },
        {
            path: '/admin/brief',
            name: 'brief',
            component: Brief
        },
        {
            path: '/admin/brief/create_update',
            name: 'brief.create_update',
            component: BriefCreateUpdate,
            props: true
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: {
        App,
        HeaderComponent
    },
    router,
});