require('./bootstrap');

window.Vue = require('vue');
 
// Admin components
Vue.component('navbar', require('./components/Admin/Navbar.vue').default);
Vue.component('confirmation-modal', require('./components/Admin/Modals/Confirmation.vue').default);

// Site components
Vue.component('site-navbar', require('./components/SiteNavbar.vue').default);
Vue.component('reservation-form', require('./components/Reservations/ReservationForm.vue').default);

const app = new Vue({
    el: '#app'
});