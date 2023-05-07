import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import ProductPage from '../components/ProductPage.vue';
export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'product',
        path: '/product/:id',
        component: ProductPage
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;

