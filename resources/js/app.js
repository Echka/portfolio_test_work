require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import App from './views/App'

import HeaderComponent from './components/HeaderComponent'

import Profile from './views/profile/Page'

import Brief from './views/brief/Page'
import BriefCreateUpdate from './views/brief/CreateUpdate'
import BriefShow from './views/brief/Show'

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
            path: '/admin/brief/update/:id',
            name: 'brief.update',
            component: BriefCreateUpdate,
            props: true
        },
        {
            path: '/admin/brief/create/',
            name: 'brief.create',
            component: BriefCreateUpdate,
            props: true
        },
        {
            path: '/admin/brief/show/:id',
            name: 'brief.show',
            component: BriefShow,
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