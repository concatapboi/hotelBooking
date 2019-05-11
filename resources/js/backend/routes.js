import Vue  from 'vue';
import VueRouter  from 'vue-router';

import home  from '@/js/backend/components/home';
import about  from '@/js/backend/components/about';

Vue.use(VueRouter);

const router = new VueRouter({
	mode: 'history',
	routes :[
		{
			path: '/manager/home',
			name: 'home',
			component: home
		},
		{
			path: '/manager/about',
			name: 'about',
			component: about
		}
	]
});

export default router;