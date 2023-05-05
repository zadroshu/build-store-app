import './bootstrap';
import { createApp } from 'vue';
import AppComponent from './App.vue';
import router from './router/index';

const app = createApp(AppComponent);

app.use(router);
app.mount('#app');
