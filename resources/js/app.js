require('./bootstrap');

window.Vue = require('vue');
 
// Admin components
Vue.component('navbar', require('./components/Admin/Navbar.vue').default);

Vue.component('dashboard', require('./components/Admin/Dashboard.vue').default);
Vue.component('dashboard-general', require('./components/Admin/Dashboard/General.vue').default);
Vue.component('dashboard-lecturer', require('./components/Admin/Dashboard/Lecturer.vue').default);
Vue.component('dashboard-orders', require('./components/Admin/Dashboard/Orders.vue').default);
Vue.component('dashboard-attendees', require('./components/Admin/Dashboard/Attendees.vue').default);

Vue.component('confirmation-modal', require('./components/Admin/Modals/Confirmation.vue').default);

Vue.component('course-dates-list', require('./components/Admin/Courses/CourseDatesList.vue').default);
Vue.component('course-date', require('./components/Admin/Courses/CourseDate.vue').default);

Vue.component('courses-list', require('./components/Admin/Courses/CoursesList.vue').default);
Vue.component('course-create', require('./components/Admin/Courses/CourseCreate.vue').default);

Vue.component('reservation', require('./components/Admin/Reservations/Reservation.vue').default);
Vue.component('reservations', require('./components/Admin/Reservations/Reservations.vue').default);

// Site components
Vue.component('site-navbar', require('./components/Navbar.vue').default);

Vue.component('reservation-form', require('./components/Reservations/ReservationForm.vue').default);
Vue.component('public-reservation', require('./components/Reservations/PublicReservation.vue').default);

Vue.component('order-form', require('./components/Orders/OrderForm.vue').default);

Vue.component('home-course', require('./components/Home/Courses/Course.vue').default);
Vue.component('home-course', require('./components/Home/Courses/Course.vue').default);
Vue.component('home-courses', require('./components/Home/Courses/Courses.vue').default);
Vue.component('home-testamonial', require('./components/Home/Testamonial.vue').default);
Vue.component('home-testamonials', require('./components/Home/Testamonials.vue').default);

Vue.component('contacts', require('./components/Contacts/Contacts.vue').default);

Vue.component('course', require('./components/Courses/Course.vue').default);

Vue.component('public-course-dates', require('./components/Courses/CourseDates.vue').default);

Vue.component('prices', require('./components/Prices/Prices.vue').default);

// Utils
Vue.component('line-chart', require('./components/Utils/Charts/LineChart.vue').default);
Vue.component('bar-chart', require('./components/Utils/Charts/BarChart.vue').default);
Vue.component('pie-chart', require('./components/Utils/Charts/PieChart.vue').default);
Vue.component('doughnut-chart', require('./components/Utils/Charts/DoughnutChart.vue').default);

import VModal from 'vue-js-modal';
Vue.use(VModal);

const app = new Vue({
    el: '#app'
});