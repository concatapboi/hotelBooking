import Vue from 'vue';
import VueRouter from 'vue-router';


import login from '@/js/backend/components/login.vue';
import register from '@/js/backend/components/register.vue';
import home from '@/js/backend/components/home';


Vue.use(VueRouter);


const router = new VueRouter({
    mode: 'history',
    routes: [{
            path: '/manager/login',
            name: 'login',
            component: login,
            props: true,
            meta: {
                auth: false
            }
        },
        {
            path: '/manager/register',
            name: 'register',
            component: register,
            props: true,
            meta: {
                auth: false
            }
        },
        {
            path: '/manager/home',
            name: 'home',
            component: home,
            props: true,
            meta: {
                auth: true
            }
        },
    ]
});

export default router;