require('./bootstrap');

window.Vue = require('vue');
 
Vue.component('navbar', require('./components/Admin/Navbar.vue').default);

const app = new Vue({
    el: '#app'
});