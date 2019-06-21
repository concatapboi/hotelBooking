import Vue  from 'vue';
import VueRouter  from 'vue-router';

import home  from '@/js/frontend/community/components/home';
import account  from '@/js/frontend/community/components/account';
import user  from '@/js/frontend/community/components/user';
import news  from '@/js/frontend/community/components/news';

Vue.use(VueRouter);

const router = new VueRouter({
	mode: 'history',
	routes :[
		{
			path: '/community/',
			name: 'home',
			component: home
		},
		{
			path: '/community/account',
			name: 'account',
			component: account
		},
		{
			path: '/community/user/:id',
			name: 'user',
			component: user
		},
		{
			path: '/community/news',
			name: 'news',
			component: news
		}
	]
});

export default router;
