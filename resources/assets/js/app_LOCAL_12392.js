require('./bootstrap');

window.Vue = require('vue');

/*
 */
import Vue from 'vue';
import VueToastr2 from 'vue-toastr-2';
import 'vue-toastr-2/dist/vue-toastr-2.min.css';

window.toastr = require('toastr');
Vue.use(VueToastr2);

Vue.component(
    'listamesa-component',
    require('./components/ListamesaComponent.vue')
);
Vue.component('ayuda-component', require('./components/AyudaComponent.vue'));
Vue.component(
    'formmesa-component',
    require('./components/formmesaComponent.vue')
);
Vue.component(
    'mylistamesa-component',
    require('./components/mylistamesaComponent.vue')
);

Vue.component(
    'my-thoughts-component',
    require('./components/MyThoughtsComponent.vue')
);
Vue.component('form-component', require('./components/FormComponent.vue'));
Vue.component(
    'thought-component',
    require('./components/ThoughtComponent.vue')
);
Vue.component('null-component', require('./components/nullComponent.vue'));
Vue.component('punto-component', require('./components/puntoComponent.vue'));
Vue.component('mesa-component', require('./components/mesaComponent.vue'));

import Select2 from 'v-select2-component';
Vue.component('Select2', Select2);

const app = new Vue({
    el: '#app',
});