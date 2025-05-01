import {createRouter, createWebHistory} from 'vue-router'
import HomePage from "@/views/HomePage.vue";
import LoginPage from "@/views/Auth/LoginPage.vue";
import RegisterPage from "@/views/Auth/RegisterPage.vue";
import DashboardPage from "@/views/DashboardPage.vue";
import BookingConfirm from '@/views/BookingConfirm.vue';

const routes = [
    {
        path: '/',
        name: 'home',
        component: HomePage,
    },
    {
        path: '/login',
        name: 'login',
        component: LoginPage,
    },
    {
        path: '/register',
        name: 'register',
        component: RegisterPage,
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: DashboardPage,
    },
    {
        path: '/booking-details',
        name: 'booking-details',
        component: BookingConfirm
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router
