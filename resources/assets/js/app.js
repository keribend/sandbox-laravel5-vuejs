
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')


import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import MasterPage from './components/MasterPageComponent.vue'
import Polling from './components/PollingComponent.vue'
import Statistics from './components/StatisticsComponent.vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import router from './routes'

Vue.use(Vuetify)
Vue.use(VueAxios, axios)
Vue.use(VueRouter)
Vue.component('master-page', MasterPage)
Vue.component('polling', Polling)
Vue.component('statistics', Statistics)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router: router
});
