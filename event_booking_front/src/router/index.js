import {createRouter, createWebHistory} from 'vue-router'
import HomePage from "@/views/HomePage.vue";
import LoginPage from "@/views/Auth/LoginPage.vue";
import RegisterPage from "@/views/Auth/RegisterPage.vue";
import DashboardPage from "@/views/DashboardPage.vue";
import BookingConfirm from '@/views/BookingConfirm.vue';
import AdminDashboard from "@/views/AdminDashboard.vue";
import AdminProfile from "@/components/Admin/AdminProfile.vue";
import Events from "@/components/Admin/Events.vue";
import EventEdit from "@/components/Admin/EventEdit.vue";

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
        path: '/member-dashboard',
        name: 'member-dashboard',
        component: DashboardPage,
    }, {
        path: '/admin',
        name: 'admin',
        component: AdminDashboard,
        children: [
            {
                path: 'admin-profile', component: AdminProfile,
            }, {
                path: 'events', component: Events,
            }, {
                path: 'event/edit/:id', component: EventEdit,
            }
        ]
    },
    {
        path: '/event-details',
        name: 'event-details',
        component: BookingConfirm
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router
