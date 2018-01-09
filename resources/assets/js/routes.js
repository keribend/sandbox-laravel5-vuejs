import VueRouter from 'vue-router'

let routes = [
  {
    path: '/',
    component: require('./components/MasterPageComponent.vue')
  },
  {
    path: '/pollings',
    component: require('./components/PollingComponent.vue')
  },
  {
    path: '/statistics1',
    component: require('./components/Statistics1Component.vue')
  },
  {
    path: '/statistics2',
    component: require('./components/Statistics2Component.vue')
  },
  {
    path: '/statistics3',
    component: require('./components/Statistics3Component.vue')
  },
  {
    path: '*',
    redirect: '/'
  }
]

export default new VueRouter({
  routes: routes
})