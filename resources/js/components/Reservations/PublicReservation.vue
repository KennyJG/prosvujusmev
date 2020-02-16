<template>
    <div class="relative overflow-hidden bg-gray-400 h-full w-full">
        <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.1;">
            <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
            <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
        </svg>
        <div class="container mx-auto h-full">
            <div class="h-full flex items-center justify-center">
                <div class="sm:p-16 flex flex-wrap items-center justify-center">
                    <div class="m-6 relative rounded-lg shadow-lg sm:w-full bg-gray-100" style="min-width:600px; min-height: 400px;">
                        <div class="flex items-strech justify-between" style="min-height: 400px;">
                            <div class="rounded-l-lg block w-1/3 shadow-b-lg bg-purple-500 text-white">
                                <div @click="activeTab='RESERVATION'" :class="{'flex px-4 py-3 cursor-pointer hover:text-gray-300': activeTab != 'RESERVATION', 'rounded-tl-lg flex py-3 px-4 text-purple-500 bg-gray-100': activeTab == 'RESERVATION'}">
                                    <div class="w-full font-bold">Vaše rezervace</div>
                                </div>
                                <div v-if="reservation.queuedReservation !== null" @click="activeTab='QUEUED_RESERVATION'" :class="{'flex px-4 py-3 cursor-pointer hover:text-gray-300': activeTab != 'QUEUED_RESERVATION', 'flex py-3 px-4 text-purple-500 bg-gray-100': activeTab == 'QUEUED_RESERVATION'}">
                                    <div class="w-full font-bold">Náhradník v Termínu</div>
                                </div>
                            </div>
                            <div v-if="activeTab === 'RESERVATION'" class="block text-gray-600 w-2/3 pl-6 p-6 rounded-r-lg bg-gray-100 flex flex-col">
                                <div>
                                    <div class="flex">
                                        <div class="w-5/12 font-bold">Číslo objednávky</div>
                                        <div class="pl-2 w-7/12">{{ reservation.source_code }} ({{ reservation.source_type }})</div>
                                    </div>
                                    <div class="flex mb-6">
                                        <div class="w-5/12 font-bold">Zarezervováno</div>
                                        <div class="w-7/12 pl-2">{{ reservation.created_at }}</div>
                                    </div>
                                    <div class="flex mb-1">
                                        <div class="w-5/12 font-bold">Kurz</div>
                                        <div class="pl-2 w-7/12">{{ reservation.course.name }}</div>
                                    </div>
                                    <div class="flex mb-1">
                                        <div class="w-5/12 font-bold">Stav</div>
                                        <div class="pl-2 w-7/12">{{ reservation.status }}</div>
                                    </div>
                                    <div class="flex mb-1">
                                        <div class="w-5/12 font-bold">Termín</div>
                                        <div class="pl-2 w-7/12">{{ reservation.courseDate.fullDateForHumans }}</div>
                                    </div>
                                    <div class="flex mb-6">
                                        <div class="w-5/12 font-bold">Místo konání</div>
                                        <div class="pl-2 w-7/12">{{ reservation.courseDate.venue }}</div>
                                    </div>

                                    <div class="flex mb-1">
                                        <div class="w-5/12 font-bold">Jméno</div>
                                        <div class="pl-2 w-7/12">{{ reservation.attendee.fullname }} </div>
                                    </div>
                                    <div class="flex mb-1">
                                        <div class="w-5/12 font-bold">Email</div>
                                        <div class="pl-2 w-7/12">{{ reservation.attendee.email }}</div>
                                    </div>
                                </div>
                                <div class="h-full flex items-end justify-end">
                                    <button :disabled="!reservation.canChangeCourseDate" :class="{'opacity-50 cursor-not-allowed': !reservation.canChangeCourseDate}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-3 rounded" @click="showChangeReservationModal()">Změnit Termín</button>
                                    <button :disabled="!reservation.canBeCanceled" :class="{'opacity-50 cursor-not-allowed': !reservation.canChangeCourseDate}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-3 ml-1 rounded" @click="showModal('cancel-reservation-modal')">Zrušit</button>
                                </div>
                            </div>
                            <div v-if="activeTab === 'QUEUED_RESERVATION' && reservation.queuedReservation" class="block text-gray-600 w-2/3 pl-6 p-6 rounded-r-lg bg-gray-100 flex flex-col" style="min-height: 335px;">
                                <div>
                                    <div class="flex mb-1">
                                        <div class="w-5/12 font-bold">Kurz</div>
                                        <div class="pl-2 w-7/12">{{ reservation.queuedReservation.course.name }}</div>
                                    </div>
                                    <div class="flex mb-1">
                                        <div class="w-5/12 font-bold">Stav</div>
                                        <div class="pl-2 w-7/12">{{ reservation.queuedReservation.status }}</div>
                                    </div>
                                    <div class="flex mb-1">
                                        <div class="w-5/12 font-bold">Termín</div>
                                        <div class="pl-2 w-7/12">{{ reservation.queuedReservation.courseDate.fullDateForHumans }}</div>
                                    </div>
                                    <div class="flex mb-6">
                                        <div class="w-5/12 font-bold">Místo konání</div>
                                        <div class="pl-2 w-7/12">{{ reservation.queuedReservation.courseDate.venue }}</div>
                                    </div>
                                </div>
                                <div class="h-full flex items-end justify-end">
                                    <button v-if="reservation.queuedReservation.canChangeCourseDate" :disabled="!reservation.queuedReservation.canChangeCourseDate" :class="{'opacity-50 cursor-not-allowed': !reservation.queuedReservation.canChangeCourseDate}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-3 rounded">Změnit Termín</button>
                                    <button v-if="reservation.queuedReservation.canChangeCourseDate" :disabled="!reservation.queuedReservation.canBeCanceled" :class="{'opacity-50 cursor-not-allowed': !reservation.queuedReservation.canBeCanceled}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-3 ml-1 rounded" @click="showModal('cancel-queued-reservation-modal')">Zrušit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <modal name="cancel-reservation-modal" width="480" height="auto">
            <div class="flex flex-col">
                <div class="p-6">
                    Opravdu chcete zrušit Vaší rezervaci?
                </div>
                <div class="flex justify-end py-4 px-4">
                   <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-3 rounded" @click="cancelReservation(reservation.uuid)">Ano</button>
                   <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-3 ml-1 rounded" @click="hideModal('cancel-reservation-modal')">Ne</button>
                </div>
            </div>
        </modal>

        <modal name="cancel-queued-reservation-modal" width="480" height="auto">
            <div class="flex flex-col">
                <div class="p-6">
                    Opravdu chcete zrušit Vaší náhradní rezervaci?
                </div>
                <div class="flex justify-end py-4 px-4">
                   <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-3 rounded" @click="cancelReservation(reservation.queuedReservation.uuid)">Ano</button>
                   <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-3 ml-1 rounded" @click="hideModal('cancel-queued-reservation-modal')">Ne</button>
                </div>
            </div>
        </modal>

        <modal name="change-reservation-modal" width="480" height="auto">
            <div :class="{'pb-6': selectedCourseDate == null}">
                <div class="w-full px-6 pt-6 pb-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                        Kurz
                    </label>
                    <div class="relative">
                        <select v-model="selectedCourse" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                            <option v-for="course in courses" :value="course">{{ course.name }}</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>

                <div v-if="selectedCourse != null" class="w-full px-6 pb-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Místo</label>
                    <div class="relative">
                        <select v-model="selectedCourseDateVenue" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option v-for="venue in getVenues()" :value="venue">{{ venue }}</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>

                <div v-if="selectedCourse != null && selectedCourseDateVenue != null" class="w-full px-6 pb-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Termín</label>
                    <div class="relative">
                        <select v-model="selectedCourseDate" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="-">-</option>
                            <option :class="{'text-gray-300': localCourseDate.remaining == 0}" v-for="localCourseDate in filterCourseDatesForVenue(selectedCourseDateVenue)" :value="localCourseDate">
                                {{ localCourseDate.fullDateForHumans }}
                                <span class="italic" v-if="localCourseDate.remaining <= 5 && localCourseDate.remaining > 1">Poslední volná místa</span>
                                <span class="italic font-bold" v-if="localCourseDate.remaining == 1">Poslední 1 volné místo</span>
                                <span class="italic" v-if="localCourseDate.remaining == 0">Plno - Možnost náhradníka</span>
                            </option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pb-6 px-6 mt-3" v-if="selectedCourseDate">
                <button v-if="selectedCourseDate.remaining == 0 && (reservation.queuedReservation === null || reservation.queuedReservation.status === 'CANCELED')" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-3 rounded" @click="createSubstituteReservation()">Obsadit místo náhradník</button>
                <button v-if="selectedCourseDate.remaining == 0 && (reservation.queuedReservation !== null && reservation.queuedReservation.status !== 'CANCELED')" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-3 rounded" @click="changeReservation(reservation.queuedReservation.uuid)">Změnit místo náhradníka</button>
                <button v-if="selectedCourseDate.remaining != 0" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-3 rounded" @click="changeReservation(reservation.uuid)">Změnit</button>
                <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-3 ml-1 rounded" @click="hideModal('change-reservation-modal')">Zrušit</button>
            </div>
        </modal>
    </div>
</template>

<script>
export default {
    props: ['reservationUuid'],

    data() {
        return {
            reservation: null,
            courses: [],

            activeTab: 'RESERVATION',

            selectedCourse: null,
            selectedCourseDate: null,
            selectedCourseDateVenue: null,
            selectedCourseDateDate: null,
        }
    },

    methods: {
        getCourses() {
            axios.get('/api/courses')
                .then((response) => {
                    this.courses = response.data.data;
                });
        },

        getPublicReservation(uuid) {
            axios.get('/api/public/reservations/' + uuid)
                .then((response) => {
                    this.reservation = response.data.data;
                });
        },

        changeReservation(reservationUuid) {
            axios.put('/api/public/reservations/' + reservationUuid, {
                courseDateId: this.selectedCourseDate.id,
            }).then((response) => {
                this.getPublicReservation(this.reservationUuid);
                this.hideModal('change-reservation-modal');
            });
        },

        cancelReservation(reservationUuid) {
            axios.post('/api/public/reservations/' + reservationUuid + '/cancel')
                .then((response) => {
                    this.getPublicReservation(this.reservationUuid);
                    if (reservationUuid == this.reservation.uuid) {
                        this.hideModal('cancel-reservation-modal');
                    } else {
                        this.hideModal('cancel-queued-reservation-modal');
                    }
                });
        },

        createSubstituteReservation () {
            axios.post('/api/public/reservations/' + this.reservationUuid + '/substitute', {
                courseDateId: this.selectedCourseDate.id,
            }).then((response) => {
                this.getPublicReservation(this.reservationUuid);
                this.hideModal('change-reservation-modal');
            });
        },

        showModal (name) {
            this.$modal.show(name);
        },

        hideModal (name) {
            this.$modal.hide(name);
        },

        showChangeReservationModal() {
            this.selectedCourse = null;
            this.selectedCourseDate = null;
            this.getCourses();
            this.showModal('change-reservation-modal');
        },

        showCreateQueuedReservationModal() {
            this.selectedCourse = null;
            this.selectedCourseDate = null;
            this.getCourses();
            this.showModal('create-queued-reservation-modal');
        },

        filterCourseDatesForVenue(venue) {
            return this.selectedCourse.courseDates.filter(courseDate => {
                return courseDate.venue == venue && courseDate.id !== this.reservation.courseDate.id;
            });
        },

        getVenues() {
            let venues = [];
            this.selectedCourse.courseDates.forEach(courseDate => {
                if (!venues.includes(courseDate.venue) && courseDate.id !== this.reservation.courseDate.id) {
                    venues.push(courseDate.venue);
                }
            });
            return venues;
        }
    },

    mounted() {
        this.getPublicReservation(this.reservationUuid);
    }
}
</script>

<style>
   /* Enter and leave animations can use different */
    /* durations and timing functions.              */
    .slide-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-fade-leave-active {
        transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active below version 2.1.8 */ {
        transform: translateX(10px);
        opacity: 0;
    }
</style>