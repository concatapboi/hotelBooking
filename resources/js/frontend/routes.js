import Vue  from 'vue';
import VueRouter  from 'vue-router';

import home  from '@/js/frontend/components/home';
import about  from '@/js/frontend/components/about';
import booking  from '@/js/frontend/components/booking';
import login  from '@/js/frontend/components/login';
import register  from '@/js/frontend/components/register';
import hotel  from '@/js/frontend/components/hotel';
import singleHotel  from '@/js/frontend/components/singleHotel';
import err  from '@/js/frontend/components/err';
import account  from '@/js/frontend/components/account';
import user  from '@/js/frontend/components/user';
import contact  from '@/js/frontend/components/contact';
import searching  from '@/js/frontend/components/searching';
import policy  from '@/js/frontend/components/policy';

Vue.use(VueRouter);

const router = new VueRouter({
	mode: 'history',
	routes :[
		{
			path: '/',
			name: 'home',
			component: home
		},
		{
			path: '/login.html',
			name: 'login',
			component: login
		},
		{
			path: '/register.html',
			name: 'register',
			component: register
		},
		{
			path: '/hotels.html',
			name: 'hotel',
			component: hotel
		},
		{
			path: '/single-hotel.html',
			name: 'singleHotel',
			component: singleHotel
		},
		{
			path: '/user.html',
			name: 'user',
			component: user
		},
		{
			path: '/account.html',
			name: 'account',
			component: account
		},
		{
			path: '/booking.html',
			name: 'booking',
			component: booking
		},
		{
			path: '/contact.html',
			name: 'contact',
			component: contact
		},
		{
			path: '/about.html',
			name: 'about',
			component: about
		},
		{
			path: '/searching.html',
			name: 'searching',
			component: searching
		},
		{
			path: '/error.html',
			name: 'err',
			component: err
		}
		,
		{
			path: '/policies.html',
			name: 'policy',
			component: policy
		}
	]
});

export default router;
