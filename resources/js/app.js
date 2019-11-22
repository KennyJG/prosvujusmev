require('./bootstrap');

window.Vue = require('vue');
 
Vue.component('navbar', require('./components/Admin/Navbar.vue').default);
Vue.component('confirmation-modal', require('./components/Admin/Modals/Confirmation.vue').default);

Vue.component('site-navbar', require('./components/SiteNavbar.vue').default);
Vue.component('reservation-form', require('./components/Reservations/ReservationForm.vue').default);

const app = new Vue({
    el: '#app'
});