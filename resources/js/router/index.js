import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
export const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    }
];

// const router = createRouter({
//     history: createWebHistory(import.meta.env.BASE_URL),
//     routes
// });
