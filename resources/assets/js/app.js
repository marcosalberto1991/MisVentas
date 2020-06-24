require('./bootstrap');

window.Vue = require('vue');

/*
 */
import Vue from 'vue';
import VueToastr2 from 'vue-toastr-2';
import 'vue-toastr-2/dist/vue-toastr-2.min.css';
import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'


import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import vuejquery from 'vue-jquery';
import DatePicker from 'vue2-datepicker'

import Multiselect from 'vue-multiselect' //https://vue-multiselect.js.org/

Vue.component('multiselect', Multiselect)
Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)

window.toastr = require('toastr');
Vue.use(VueToastr2);
Vue.component('Lista_mesa', require('./components/MyThoughtsComponent.vue'));
Vue.component('vue-config', require('./components/config-templete.vue'));
Vue.component('Producto', require('./components/vue-Producto.vue'));
Vue.component('vue-venta_prueba', require('./components/vue-Producto.vue'));
Vue.component('vue-ventas', require('./components/vue-Ventas.vue'));
Vue.component('vue-factura', require('./components/vue-Factura.vue'));
Vue.component('pagination', require('laravel-vue-pagination')); //https://www.npmjs.com/package/laravel-vue-pagination
Vue.component('vue-venta_prueba', require('./components/vue-venta_prueba.vue'));
Vue.component('vue-inicio', require('./components/Inicio.vue'));
Vue.component('vue-metodo_pago', require('./components/vue-Metodo_Pago.vue'));
Vue.component('vue-facturacion', require('./components/vue-Facturacion.vue'));

Vue.component('vue-campo', require('./components/vue-Campo.vue'));

Vue.component('vue-facturacion_producto', require('./components/vue-Facturacion_Producto.vue'));
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import MyThoughtsComponent from './components/MyThoughtsComponent.vue';
import Producto from './components/vue-Producto.vue';
import Ventas from './components/vue-Ventas.vue';
import Facturacion from './components/vue-Facturacion.vue';
import v404 from './components/vue-404.vue';

const Foo = { template: '<div>Foo</div>' }
const Bar = { template: '<div>bar</div>' }

var url = '/MisVentas/public/';
var url = '/';
const router = new VueRouter({
    mode: 'history',
    routes: [
            { path: url + 'Lista_Mesa', component: MyThoughtsComponent, name: 'MyThoughtsComponent' },
            { path: url + 'Producto', component: Producto, name: 'Producto' },
            { path: url + 'Ventas', component: Ventas, name: 'Ventas' },
            { path: url + 'Facturacion', component: Facturacion, name: 'Facturacion' },



            { path: 'Foo', component: Foo },
            { path: 'Bar', component: Bar }
        ] // short for `routes: routes`
})

//const router = new VueRouter({
//   mode: 'history',
//  routes
//});

//alert(hrefs);
const app = new Vue({
    router
}).$mount('#app')