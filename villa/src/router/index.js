// Import vue router
import { createRouter, createWebHistory } from 'vue-router';

// Define routes
const routes = [
    // Home Page
    {
        path: '/',
        name: 'home',
        component: () => import( /* webpackChunkName: "home" */ '../views/home.vue')
    },

    // Villas Routes
    {
        path: '/villas',
        name: 'villas.index',
        component: () => import( /* webpackChunkName: "villas.index" */ '../views/posts/index.vue')
    },
    {
        path: '/villas/create',
        name: 'villas.create',
        component: () => import( /* webpackChunkName: "villas.create" */ '../views/posts/create.vue')
    },
    {
        path: '/villas/edit/:id',
        name: 'villas.edit',
        component: () => import( /* webpackChunkName: "villas.edit" */ '../views/posts/edit.vue')
    },

    // Reservations Routes
    {
        path: '/reservations',
        name: 'reservations.index',
        component: () => import( /* webpackChunkName: "reservations.index" */ '../views/Reservation/index.vue') // Daftar reservasi
    },
    {
        path: '/reservations/create',
        name: 'reservations.create',
        component: () => import( /* webpackChunkName: "reservations.create" */ '../views/Reservation/create.vue') // Form buat reservasi
    },
    {
        path: '/reservations/edit/:id',
        name: 'reservations.edit',
        component: () => import( /* webpackChunkName: "reservations.edit" */ '../views/Reservation/edit.vue') // Form edit reservasi
    }
];

// Create router
const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
