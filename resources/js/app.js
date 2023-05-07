import './bootstrap';
import { createApp } from 'vue'
import VueAxios from 'vue-axios';
import router from './router/index.js';
import App from './App.vue';
import axios from 'axios';
 
createApp(App).use(router).use(VueAxios, axios).mount('#app');


