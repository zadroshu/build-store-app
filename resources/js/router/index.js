import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import ProductPage from '../components/ProductPage.vue';
import Cart from '../components/Cart.vue';
import AdminHome from '../components/AdminHome.vue';
import AdminCategory from '../components/AdminCategory.vue';

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
    },
    {
        name: 'admin',
        path: '/admin',
        component: AdminHome,
    },
    {
        name: 'adminCategory',
        path: '/admin/category',
        component: AdminCategory,
    },
];

const router = createRouter({
    history: createWebHistory(window.apiUrl),
    routes
});

export default router;

