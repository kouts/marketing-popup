import Vue from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
import { Notyf } from 'notyf';

Vue.prototype.$notyf = new Notyf({
  duration: 4500,
  position: { x: 'right', y: 'top' },
  dismissible: true
});
Vue.config.productionTip = false;

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app');
