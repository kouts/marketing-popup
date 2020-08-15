import Vue from 'vue';
import VueRouter from 'vue-router';
import Default from '@/layouts/default/Default.vue';
import Home from '../views/Home.vue';

Vue.component('layout-default', Default);

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
    meta: {
      layout: 'default'
    }
  },
  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue'),
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
