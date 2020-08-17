import Vue from 'vue';
import VueRouter from 'vue-router';
import Default from '@/layouts/default/Default.vue';
import Config from '../views/Config.vue';

Vue.component('layout-default', Default);

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'Config',
    component: Config,
    meta: {
      layout: 'default'
    }
  },
  {
    path: '/marketing',
    name: 'Marketing',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "marketing" */ '../views/Marketing.vue'),
    meta: {
      layout: 'default'
    }
  }
];

const router = new VueRouter({
  linkActiveClass: 'active',
  scrollBehavior() {
    return { x: 0, y: 0 };
  },
  routes
});

export default router;
