require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router';
import ViewUI from 'view-design';
import Common from './common';
import moment from "moment";
import 'view-design/dist/styles/iview.css';
import Swal from "sweetalert2";
Vue.use(ViewUI)
Vue.use(VueRouter)
Vue.mixin(Common)
Vue.use(moment)
// Vue.use(Swal)
window.Swal = Swal



// Routes Import
import {routes} from './router'

const Router = new VueRouter({
    routes,
    mode: 'history'
})

Vue.filter('dateFormat', function (value){
    if (value){
        return moment(String(value)).format("MMM Do YY");
    }
})



Vue.component('app', require('./components/App.vue').default);

const app = new Vue({
    el: '#app',
    router:Router
});
