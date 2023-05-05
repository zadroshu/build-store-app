require('./bootstrap');
// window.Vue = require('vue');
import * as Vue from 'vue';
import App from './App.vue';
import VueAxios from 'vue-axios';
import * as VueRouter from 'vue-router';
import axios from 'axios';
import { routes } from './router/index.js';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
 
const router = new VueRouter({
    mode: 'history',
    routes: routes
});
 
const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});


