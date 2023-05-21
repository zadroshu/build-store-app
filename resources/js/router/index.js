import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import ProductPage from '../components/ProductPage.vue';
import Cart from '../components/Cart.vue';
import AdminHome from '../components/AdminHome.vue';
import AdminCategory from '../components/AdminCategory.vue';
import AdminOrder from '../components/AdminOrder.vue';
import AdminAdministrators from '../components/AdminAdministrators.vue';
import Login from '../components/Login.vue';

const router = createRouter({
    history: createWebHistory(window.apiUrl),

    routes: [
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
        {
            name: 'adminOrder',
            path: '/admin/order',
            component: AdminOrder,
        },
        {
            name: 'adminAdministrators',
            path: '/admin/administrators',
            component: AdminAdministrators,
        },
        {
            name: 'login',
            path: '/login',
            component: Login,
        },
    ],
}) 

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('x_xsrf_token');

    if(!token) {
        if (to.name === 'login' || to.name === 'home' || to.name === 'product' || to.name === 'cart' || to.name === 'cart') {
            return next();
        }
        else {
            return next({
                name: 'login',
            });
        }
    } 
    
    else if(to.name === 'login' && token) {
        return next({
            name: 'admin',
        });
    }
    next();
});

// const router = createRouter({
//     history: createWebHistory(window.apiUrl),
//     routes
// });

export default router;

