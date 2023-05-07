import './bootstrap';
import { createApp } from 'vue'
import VueAxios from 'vue-axios';
import router from './router/index.js';
import axios from 'axios';
import App from './App.vue';
import StButton from './components/primitives/st-button.vue';
import StInput from './components/primitives/st-input.vue';
import StLabel from './components/primitives/st-label.vue';

const app = createApp(App);

app
    .component('StButton', StButton)
    .component('StInput', StInput)
    .component('StLabel', StLabel);

app
    .use(router)
    .use(VueAxios, axios)
    .mount('#app');


