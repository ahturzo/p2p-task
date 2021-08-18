window.Vue = require('vue');

import Vue from 'vue'

Vue.config.productionTip = false;

//vue routes
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import { routes } from './routes';
const router = new VueRouter({
  routes,
  mode: 'history'
})

// vform
import { Form, HasError, AlertError } from 'vform';
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
window.Form= Form;

// filter
import { filter } from './filters/filter';

// sweetalert2
import Swal from 'sweetalert2';
window.Swal = Swal;

// dropify
import VueDropify from 'vue-dropify';
export default {
  components: {
    'vue-dropify': VueDropify
  }
}

// v-select
import vSelect from 'vue-select';
Vue.component('v-select', vSelect)
import 'vue-select/dist/vue-select.css';

// ckeditor
// import CKEditor from 'ckeditor4-vue';
// Vue.use( CKEditor );

// toaster
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 1000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

window.Toast = Toast;

// vue axios
import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)
axios.defaults.baseURL= 'http://localhost:8000/api';

// vuex
import Vuex from 'vuex'
Vue.use(Vuex);
import store from './store'

// datatable
import DataTable from 'laravel-vue-datatable';
Vue.use(DataTable);

Vue.component('main-template', require('./App').default);

require('./store/subscriber');

store.dispatch('auth/attempt', localStorage.getItem('token')).then(() => {
  new Vue({
    el: '#app',
    router,
    store
  })
})


