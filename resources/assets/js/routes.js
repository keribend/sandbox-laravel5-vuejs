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
    path: '/statistics',
    component: require('./components/StatisticsComponent.vue')
  },
  {
    path: '*',
    redirect: '/'
  }
]

export default new VueRouter({
  routes: routes
})