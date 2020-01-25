<template>
    <div class="w-full">
        <div class="w-full h-12 border-b flex justify-between">
            <div class="flex align-middle content-center text-gray-600">
                <div class="flex content-center items-center pl-6">
                    <a class="mr-4" href="/admin/course-dates">Termíny</a>/
                    <div class="ml-4 text-black">{{ actualCourseDate.course.name }} {{ actualCourseDate.from_date_date }}</div>
                </div>
            </div>
            <div class="flex align-middle">
                <button @click="deleteCourseDate()" class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border-l hover:border-transparent">Odstranit</button> 
                <a v-show="actualCourseDate.status !== 'COMPLETED'" @click="showModal('complete-course-date')"class='cursor-pointer'><button class="h-full bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border-l hover:border-transparent">Dokončit</button> </a>
                <button @click="toggleUpdateInputs()" class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border-l hover:border-transparent">Upravit</button> 
                <button @click="goBack()" class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border-l hover:border-transparent">Zpět</button> 
            </div>
        </div>
        <div class="w-full flex">
            <div class="w-1/3 h-full p-6 px-8 border-r">
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Kurz</div>
                    <div class="w-2/3">{{ actualCourseDate.course.name }}</div>
                </div> 
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Začátek</div>
                    <div v-show="!updating" class="w-2/3">{{ actualCourseDate.from_date_date }} {{ actualCourseDate.from_date_time }}</div>
                    <div v-show="updating" class="w-2/3 flex flex-col">
                        <input class="p-2 border" type="date" v-model="updatedCourseDate.from_date_date">
                        <input class="p-2 border" type="time" v-model="updatedCourseDate.from_date_time">
                    </div>
                </div>
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Konec</div>
                    <div v-show="!updating" class="w-2/3">{{ actualCourseDate.to_date_date }} {{ actualCourseDate.to_date_time }}</div>
                    <div v-show="updating" class="w-2/3 flex flex-col">
                        <input class="p-2 border" type="date" v-model="updatedCourseDate.to_date_date">
                        <input class="p-2 border" type="time" v-model="updatedCourseDate.to_date_time">
                    </div>
                </div>
                 <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Stav</div>
                    <div class="w-2/3">{{ actualCourseDate.status }}</div>
                </div>
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Místo konání</div>
                    <div v-show="!updating" class="w-2/3">{{ actualCourseDate.venue }}</div>
                    <input v-show="updating" class="w-2/3 p-2 border" type="text" v-model="updatedCourseDate.venue">
                </div>
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Limit</div>
                    <div v-show="!updating" class="w-2/3">{{ actualCourseDate.limit }}</div>
                    <input v-show="updating" class="w-2/3 p-2 border" type="text" v-model="updatedCourseDate.limit">
                </div>
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Zbývá míst</div>
                    <div class="w-2/3">{{ actualCourseDate.remaining }}</div>
                </div>
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Lektor</div>
                    <div v-show="!updating" class="w-2/3">{{ actualCourseDate.lecturer }}</div>
                    <input v-show="updating" class="w-2/3 p-2 border" type="text" v-model="updatedCourseDate.lecturer">
                </div>
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Popis</div>
                    <div v-show="!updating" class="w-2/3">{{ actualCourseDate.description }}</div>
                    <textarea v-show="updating" class="w-2/3 p-2 border" type="text" v-model="updatedCourseDate.description" rows="5"></textarea>
                </div>

                <button v-show="updating" @click="updateCourseDate()" class="border rounded shadow bg-purple-600 w-full py-2 px-4 mt-10 text-white hover:bg-purple-800">Uložit</button>
                <button v-show="updating" @click="toggleUpdateInputs()" class="border rounded shadow border border-purple-600 w-full py-2 px-4 mt-2 text-purple-600 hover:bg-purple-600 hover:text-white">Zrušit</button>
            </div>
            <div class="w-2/3 h-full p-6 px-8">
                <div class="text-2xl">Rezervace</div>
                <div class="mt-4">
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th class="px-2 py-2 text-left">Kód</th>
                                <th class="px-2 py-2 text-left">Zdroj</th>
                                <th class="px-2 py-2 text-left">Stav</th>
                                <th class="px-2 py-2 text-right">Akce</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(reservation, i) in actualCourseDate.reservations" :class="{'bg-gray-200': i % 2 == 0}">
                                <td class="border border-r-0 px-4 py-2 text-left"><a :href="'/admin/reservations/' + reservation.id">{{ reservation.source_code }}</a></td>
                                <td class="border border-r-0 px-4 py-2 text-left">{{ reservation.source_type }}</td>
                                <td class="border border-r-0 px-4 py-2 text-left">{{ reservation.status }}</td>
                                <td class="border border-l-0 px-4 py-4 text-right">
                                    <div class="inline-flex">
                                        <button v-show="reservation.status === 'APPROVED'" @click="showModal('complete-reservation-modal', () => { selectedReservation = reservation})" :class="{'bg-gray-100': i % 2 == 0, 'bg-gray-300': i % 2 != 0}" class="hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l cursor-pointer">Dokončit</button>
                                        <button v-show="reservation.status === 'UNAPPROVED'" @click="showModal('reject-reservation-modal', () => { selectedReservation = reservation})" :class="{'bg-gray-100': i % 2 == 0, 'bg-gray-300': i % 2 != 0}" class="hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 cursor-pointer">Zamítnout</button>
                                        <button v-show="reservation.status === 'UNAPPROVED'" @click="showModal('approve-reservation-modal', () => { selectedReservation = reservation})" :class="{'bg-gray-100': i % 2 == 0, 'bg-gray-300': i % 2 != 0}" class="hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 cursor-pointer">Schválit</button>
                                        <button @click="showModal('delete-reservation-modal', () => { selectedReservation = reservation; })" :class="{'bg-gray-100': i % 2 == 0, 'bg-gray-300': i % 2 != 0}" class="hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r cursor-pointer">Odstranit</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <modal name="approve-reservation-modal" width="480" height="auto">
            <div v-if="selectedReservation" class="flex flex-col px-6 py-8">
                <h1 class="font-bold text-xl mb-2">Schválení rezervace</h1>
                <p class="mt-4">Opravdu chcete schválit rezervaci s ID "{{ selectedReservation.id }}"</p>
                <div class="flex justify-end mt-5">
                    <button @click="hideModal('approve-reservation-modal', () => { selectedReservation = null })" class="px-4 py-2 block border border-gray-600 rounded shadow text-gray-600 hover:bg-red-600 hover:text-white">Zrušit</button>
                    <button @click="hideModal('approve-reservation-modal', approveReservation(selectedReservation.id))" class="px-4 py-2 block border border-purple-600 rounded shadow text-purple-600 hover:bg-purple-600 hover:text-white ml-2">Schválit</button>
                </div>
            </div>
        </modal>

        <modal name="reject-reservation-modal" width="480" height="auto">
            <div v-if="selectedReservation" class="flex flex-col px-6 py-8">
                <h1 class="font-bold text-xl mb-2">Zamítnutí rezervace</h1>
                <p class="mt-4">Opravdu chcete zamítnout rezervaci s ID "{{ selectedReservation.id }}"</p>
                <div class="flex justify-end mt-5">
                    <button @click="hideModal('reject-reservation-modal', () => { selectedReservation = null })" class="px-4 py-2 block border border-gray-600 rounded shadow text-gray-600 hover:bg-red-600 hover:text-white">Zrušit</button>
                    <button @click="hideModal('reject-reservation-modal', rejectReservation(selectedReservation.id))" class="px-4 py-2 block border border-purple-600 rounded shadow text-purple-600 hover:bg-purple-600 hover:text-white ml-2">Zamítnout</button>
                </div>
            </div>
        </modal>

        <modal name="complete-reservation-modal" width="480" height="auto">
            <div v-if="selectedReservation" class="flex flex-col px-6 py-8">
                <h1 class="font-bold text-xl mb-2">Dokončení rezervace</h1>
                <p class="mt-4">Opravdu chcete dokončit rezervaci s ID "{{ selectedReservation.id }}"</p>
                <div class="flex justify-end mt-5">
                    <a href="#" @click="hideModal('complete-reservation-modal', () => { selectedReservation = null })" class="px-4 py-2 block border border-gray-600 rounded shadow text-gray-600 hover:bg-red-600 hover:text-white">Zrušit</a>
                    <a href="#" @click="hideModal('complete-reservation-modal', completeReservation(selectedReservation.id))" class="px-4 py-2 block border border-purple-600 rounded shadow text-purple-600 hover:bg-purple-600 hover:text-white ml-2">Dokončit</a>
                </div>
            </div>
        </modal>
        
        <modal name="delete-reservation-modal" width="480" height="auto">
            <div v-if="selectedReservation" class="flex flex-col px-6 py-8">
                <h1 class="font-bold text-xl mb-2">Odstranění rezervace</h1>
                <p class="mt-4">Opravdu chcete odstranit rezervaci s ID "{{ selectedReservation.id }}"</p>
                <div class="flex justify-end mt-5">
                    <a @click="hideModal('delete-reservation-modal', () => { selectedReservation = null })" class="px-3 py-2 block border border-gray-600 rounded shadow text-gray-600 hover:bg-red-600 hover:text-white cursor-pointer">Zrušit</a>
                    <a @click="hideModal('delete-reservation-modal', deleteReservation(selectedReservation.id))" class="px-3 py-2 block border border-purple-600 rounded shadow text-purple-600 hover:bg-purple-600 hover:text-white ml-2 cursor-pointer">Odstranit</a>
                </div>
            </div>
        </modal>

        <modal name="complete-course-date" width="480" height="auto">
            <div class="flex flex-col px-6 py-8">
               <h1 class="font-bold text-xl mb-2">Dokončení termínu</h1>
                <p class="mt-4">Zaškrtejte účastníky kteří byli přítomni na termínu.</p>
                <div class="p-6">
                    <label v-for="reservation in actualCourseDate.reservations" class="flex justify-start items-start mt-2">
                        <div class="bg-white border-2 rounded border-gray-400 w-6 h-6 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
                            <input @change="toggleCourseDateCompletionAttendee(reservation.id)" type="checkbox" class="opacity-0 absolute">
                            <svg class="fill-current hidden w-4 h-4 text-green-500 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                        </div>
                        <div class="select-none">{{ reservation.id }}</div>
                    </label>
                </div>
                <div class="flex justify-end">
                   <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-3 rounded" @click="showModal('complete-course-date-confirmation')">Dokončit</button>
                   <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-3 ml-1 rounded" @click="hideModal('complete-course-date')">Zrušit</button>
                </div>
            </div>
        </modal>

        <modal name="complete-course-date-confirmation" width="480" height="auto">
            <div class="flex flex-col">
                <div class="p-6">Opravdu chcete dokončit tento termín?</div>
                <div class="flex justify-end py-4 px-4">
                   <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-3 rounded" @click="completeCourseDate()">Ano</button>
                   <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-3 ml-1 rounded" @click="hideModal('complete-course-date-confirmation')">Ne</button>
                </div>
            </div>
        </modal>

        <div v-show="successMessage !== null" class="fixed bottom-0 left-0 ml-4 mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
            <p class="font-bold">Úspěch</p>
            <p>{{ successMessage }}</p>
        </div>
        <div v-show="errorMessage !== null" class="fixed bottom-0 left-0 ml-4 mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
            <p class="font-bold">Chyba</p>
            <p>{{ errorMessage }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: ['courseDate', 'backUrl'],

    data() {
        return {
            selectedReservation: null,

            updating: false,

            actualCourseDate: this.courseDate,
            updatedCourseDate: this.courseDate,

            errorMessage: null,
            successMessage: null,

            attendedReservationIds: [],
        };
    },

    methods: {
        showModal (name, callback = null) {
            if (callback != null) {
                callback();
            }
            this.$modal.show(name);
        },

        hideModal (name, callback = null) {
            if (callback != null) {
                callback();
            }
            this.$modal.hide(name);
        },

        deleteCourseDate() {
            if (confirm('Opravdu chcete odstranit tento termín? (Všechny rezervace budou zrušeny)')) {
                axios.delete('/admin/course-dates/' + this.actualCourseDate.id)
                    .then((response) => {
                        window.location.href = '/admin/course-dates';
                    });
            }
        },

        goBack() {
            window.location.href = this.backUrl[0];
        },

        toggleUpdateInputs() {
            this.updating = !this.updating;
        },

        refreshCourseDate() {
            axios.get('/admin/course-dates/' + this.actualCourseDate.id)
                .then((response) => {
                    this.actualCourseDate = response.data.courseDate;
                }); 
        },

        updateCourseDate() {
            axios.put('/admin/course-dates/' + this.actualCourseDate.id, {
                course_id: this.actualCourseDate.course_id,
                from_date_date: this.updatedCourseDate.from_date_date,
                from_date_time: this.updatedCourseDate.from_date_time,
                to_date_date: this.updatedCourseDate.to_date_date,
                to_date_time: this.updatedCourseDate.to_date_time,
                venue: this.updatedCourseDate.venue,
                limit: this.updatedCourseDate.limit,
                lecturer: this.updatedCourseDate.lecturer,
                description: this.updatedCourseDate.description
            }).then((response) => {
                this.actualCourseDate = response.data.courseDate;
                this.updatedCourseDate = this.actualCourseDate;
                this.updating = false;
                this.displayMessageFromResponse(response);
            });
        },

        approveReservation(id) {
            axios.post('/admin/reservations/' + id + '/approve')
                .then((response) => {
                    this.actualCourseDate.reservations.forEach((reservation, index) => {
                        if (reservation.id == id) {
                            this.actualCourseDate.reservations[index].status = 'Schváleno';
                            return;
                        }
                    });
                    this.displayMessageFromResponse(response);
                });
        },

        rejectReservation(id) {
            axios.post('/admin/reservations/' + id + '/reject')
                .then((response) => {
                    this.actualCourseDate.reservations.forEach((reservation, index) => {
                        if (reservation.id == id) {
                            this.actualCourseDate.reservations[index].status = 'REJECTED';
                            return;
                        }
                    });
                    this.displayMessageFromResponse(response);
                });
        },

        completeReservation(id) {
            axios.post('/admin/reservations/' + id + '/complete')
                .then((response) => {
                    this.actualCourseDate.reservations.forEach((reservation, index) => {
                        if (reservation.id == id) {
                            this.actualCourseDate.reservations[index].status = 'COMPLETED';
                            return;
                        }
                    });
                    this.displayMessageFromResponse(response);
                });
        },

        deleteReservation(id) {
            axios.delete('/admin/reservations/' + id)
                .then((response) => {
                    this.refreshCourseDate();
                    this.displayMessageFromResponse(response);
                });
        },

        displayMessageFromResponse(response) {
            if (response.data.success == true) {
                this.displaySuccessMessage(response.data.message);
            } else {
                this.displayErrorMessage(response.data.message);
            }
        },

        displaySuccessMessage(message) {
            this.successMessage = message;
            setTimeout(() => {
                this.successMessage = null;
            }, 4000);
        },

        displayErrorMessage(message) {
            this.errorMessage = message;
            setTimeout(() => {
                this.errorMessage = null;
            }, 4000);
        },

        toggleCourseDateCompletionAttendee(id) {
            if (this.attendedReservationIds.includes(id)) {
                this.attendedReservationIds = this.attendedReservationIds.filter((attendeeId) => {
                    return attendeeId != id;
                });
            } else {
                this.attendedReservationIds.push(id);
            }
        },

        completeCourseDate() {
            axios.post('/admin/course-dates/' + this.actualCourseDate.id + '/complete', { attendedReservationIds: this.attendedReservationIds })
                .then((response) => {
                    this.attendedReservationIds = [];
                    this.refreshCourseDate();
                    this.displayMessageFromResponse(response);
                    this.hideModal('complete-course-date-confirmation');
                    this.hideModal('complete-course-date');
                });
        }
    }
}
</script>

<style>
    input:checked + svg {
        display: block;
    }
</style>