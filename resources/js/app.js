/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
    {path: '/', component: require('./components/start.vue').default},
    {path: '/poll/:id/vote', name:"vote", component: require('./components/vote.vue').default},
    {path: '/poll/:id/stats', name:"estado", component: require('./components/stats.vue').default},
    {path: '/poll', name:"novo", component: require('./components/novo.vue').default}

]

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const router =  new VueRouter({
    routes: routes,
    mode: "history"
})
const app = new Vue({
    router
}).$mount('#app')
