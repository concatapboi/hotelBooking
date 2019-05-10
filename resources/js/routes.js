import Vue  from 'vue';
import VueRouter  from 'vue-router';

import example  from '@/js/components/ExampleComponent';
import home  from '@/js/components/home';
import about  from '@/js/components/about';

Vue.use(VueRouter);

const router = new VueRouter({
	mode: 'history',
	routes :[
		{
			path: '/',
			name: 'example',
			component: example
		},
		{
			path: '/home',
			name: 'home',
			component: home
		},
		{
			path: '/about',
			name: 'about',
			component: about
		}
	]
});

export default router;