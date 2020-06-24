import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import Producto from './components/vue-Producto';
//import Example from './components/Example.vue';
export const routes = [
    { path: '/Producto', component: Producto, name: 'Producto' },
    { path: 'Producto', component: Producto, name: 'Producto' },
    //{ path: '/vue/example', component: Example, name: 'Example' }
];


/*
export default new Router({
    routes: [{
            path: '/',
            name: 'home',
            component: require('./components/vue-Producto')
        },


        {
            path: '*',
            component: require('./views/404')
        }
    ],
    mode: 'history',
    scrollBehavior() {
        return { x: 0, y: 0 }
    }
}) */