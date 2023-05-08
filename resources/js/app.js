import './bootstrap';
import { createApp } from 'vue'
import VueAxios from 'vue-axios';
import router from './router/index.js';
import axios from 'axios';
import App from './App.vue';
import StButton from './components/primitives/st-button.vue';
import StInput from './components/primitives/st-input.vue';
import StLabel from './components/primitives/st-label.vue';
import StLoad from './components/primitives/st-load.vue';
import StCombobox from './components/primitives/st-combobox.vue';

window.apiUrl = 'http://localhost';

const app = createApp(App);

app
    .component('StButton', StButton)
    .component('StInput', StInput)
    .component('StLabel', StLabel)
    .component('StCombobox', StCombobox)
    .component('StLoad', StLoad);

app
    .use(router)
    .use(VueAxios, axios)
    .mount('#app');


