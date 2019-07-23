
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');
import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import VeeValidate from 'vee-validate';
import Routes from '@/js/frontend/community/routes.js';
import App from '@/js/frontend/community/app';
import InfiniteLoading from 'vue-infinite-loading';

Vue.use(Vuetify);
Vue.use(VeeValidate);
Vue.use(InfiniteLoading)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// import Echo from "laravel-echo"

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     authEndpoint:"broadcasting/auth",
//   broadcaster: 'pusher',
//   key: '48a13fe2e169bc928a4e',
//   cluster: 'ap1',
//   forceTLS: true,
//   encrypted: true
// });

const app = new Vue({
    el: '#app',
    // created() {
    //     window.Echo.private('message')
    //         .listen('MessageSentEvent', (e) => {
    //             console.log(e);
    //             app.$forceUpdate();
    //         });
    // },
    router: Routes,
    render: h => h(App),
});
// import Echo from "laravel-echo"

// window.Echo = new Echo({
//   broadcaster: 'pusher',
//   key: '48a13fe2e169bc928a4e',
//   cluster: 'ap1',
//   forceTLS: true
// });

// var channel = Echo.private('message');
// channel.listen('MessageSentEvent', function(data) {
//   alert(JSON.stringify(data));
// });
export default app;
