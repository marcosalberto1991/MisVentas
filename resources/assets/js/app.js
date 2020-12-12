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

Vue.component('listaproducto-vue', require('./components/ListaProducto-vue.vue'));


import VueRouter from 'vue-router'
Vue.use(VueRouter)

import listaMesa from './components/listaMesa.vue';
import Producto from './components/vue-Producto.vue';
import Ventas from './components/vue-Ventas.vue';
import Facturacion from './components/vue-Facturacion.vue';
import v404 from './components/vue-404.vue';

import ListaProducto from './components/ListaProducto-vue.vue';
import ListaProductoForm from './components/ListaProductoForm-vue.vue';

const router = new VueRouter({
    mode: 'history', 
    routes: [
            { path: '/Lista_Mesa', component: listaMesa, name: 'listaMesa' },
            { path: '/Producto', component: Producto, name: 'Producto' },
            { path: '/Ventas', component: Ventas, name: 'Ventas' }, 
            { path: '/Facturacion', component: Facturacion, name: 'Facturacion' },
            { path: '/ListaProducto', component: ListaProducto, name: 'listaproducto' },
            { path: '/ListaProducto/:id/edit', component: ListaProductoForm, name: 'listaproductoform' },
            { path: '/ListaProducto/create', component: ListaProductoForm, name: 'listaproductoformadd' }, 
         //   { path: 'Foo', component: Foo },
           // { path: 'Bar', component: Bar }
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