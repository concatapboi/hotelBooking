import Vue from 'vue';
import VueRouter from 'vue-router';

import home from '@/js/backend/components/home';
import login from '@/js/backend/components/login';
import about from '@/js/backend/components/about';
import room from '@/js/backend/components/room';
import room_facility from '@/js/backend/components/room-facility';
import service from '@/js/backend/components/service';
import order from '@/js/backend/components/order';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [{
            path: '/manager/home/',
            name: 'home',
            component: home,
        },
        {
            path: '/manager/about',
            name: 'about',
            component: about,
            props: true,
        },
        {
            path: '/manager/room',
            name: 'room',
            component: room,
        },
        {
            path: '/manager/room-facility',
            name: 'room-facility',
            component: room_facility,
        },
        {
            path: '/manager/service',
            name: 'service',
            component: service,
        },
        {
            path: '/manager/login',
            name: 'login',
            component: login,
            props: true,
        },
        {
            path: '/manager/order',
            name: 'order',
            component: order,
        },
    ]
});

export default router;