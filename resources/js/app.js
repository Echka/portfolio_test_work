require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import App from './views/App'

import HeaderComponent from './components/HeaderComponent'

import Profile from './views/profile/Page'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/admin',
            name: 'profile',
            component: Profile
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App, HeaderComponent },
    router,
});