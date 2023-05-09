import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import ProductPage from '../components/ProductPage.vue';
import Cart from '../components/Cart.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home,
    },
    {
        name: 'product',
        path: '/product/:id',
        component: ProductPage,
        props: route => ({ id: parseInt(route.params.id) }),
    },
    {
        name: 'cart',
        path: '/cart',
        component: Cart,
        props: route => ({ products: route.params.products }),
    },
];

const router = createRouter({
    history: createWebHistory(window.apiUrl),
    routes
});

export default router;

