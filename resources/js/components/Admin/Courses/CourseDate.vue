<template>
    <div class="w-full">
        <div class="w-full h-12 border-b flex justify-between">
            <div class="flex align-middle content-center text-gray-600">
                <div class="flex content-center items-center pl-6">
                    <a class="mr-4" href="/admin/course-dates">Termíny</a>/
                    <div class="ml-4 text-black">{{ courseDate.course.name }} {{ courseDate.from_date_date }}</div>
                </div>
            </div>
            <div class="flex align-middle">
                <button @click="deleteCourseDate()" class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border-l hover:border-transparent">Odstranit</button> 
                <button @click="toggleUpdateInputs()" class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border-l hover:border-transparent">Upravit</button> 
                <button @click="goBack()" class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border-l hover:border-transparent">Zpět</button> 
            </div>
        </div>
        <div class="w-full flex">
            <div class="w-1/3 h-full p-6 px-8 border-r">
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Kurz</div>
                    <div class="w-2/3">{{ courseDate.course.name }}</div>
                </div> 
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Začátek</div>
                    <div v-show="!updating" class="w-2/3">{{ courseDate.from_date_date }} {{ courseDate.from_date_time }}</div>
                    <div v-show="updating" class="w-2/3 flex flex-col">
                        <input class="p-2 border" type="date" v-model="updatedCourseDate.from_date_date">
                        <input class="p-2 border" type="time" v-model="updatedCourseDate.from_date_time">
                    </div>
                </div>
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Konec</div>
                    <div v-show="!updating" class="w-2/3">{{ courseDate.to_date_date }} {{ courseDate.to_date_time }}</div>
                    <div v-show="updating" class="w-2/3 flex flex-col">
                        <input class="p-2 border" type="date" v-model="updatedCourseDate.to_date_date">
                        <input class="p-2 border" type="time" v-model="updatedCourseDate.to_date_time">
                    </div>
                </div>
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Místo konání</div>
                    <div v-show="!updating" class="w-2/3">{{ courseDate.venue }}</div>
                    <input v-show="updating" class="w-2/3 p-2 border" type="text" v-model="updatedCourseDate.venue">
                </div>
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Limit</div>
                    <div v-show="!updating" class="w-2/3">{{ courseDate.limit }}</div>
                    <input v-show="updating" class="w-2/3 p-2 border" type="text" v-model="updatedCourseDate.limit">
                </div>
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Zbývá míst</div>
                    <div class="w-2/3">{{ courseDate.remaining }}</div>
                </div>
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Lektor</div>
                    <div v-show="!updating" class="w-2/3">{{ courseDate.lecturer }}</div>
                    <input v-show="updating" class="w-2/3 p-2 border" type="text" v-model="updatedCourseDate.lecturer">
                </div>
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Popis</div>
                    <div v-show="!updating" class="w-2/3">{{ courseDate.description }}</div>
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
                            <tr v-for="(reservation, i) in courseDate.reservations" :class="{'bg-gray-200': i % 2 == 0}">
                                <td class="border border-r-0 px-4 py-2 text-left"><a :href="'/admin/reservations/' + reservation.id">{{ reservation.source_code }}</a></td>
                                <td class="border border-r-0 px-4 py-2 text-left">{{ reservation.source_type }}</td>
                                <td class="border border-r-0 px-4 py-2 text-left">{{ reservation.status }}</td>
                                <td class="border border-l-0 px-4 py-4 text-right">
                                    <div class="inline-flex">
                                        <a v-show="reservation.status !== 'COMPLETED'" href="#complete-reservation-modal" @click="selectedReservation = reservation" :class="{'bg-gray-100': i % 2 == 0, 'bg-gray-300': i % 2 != 0}" class="hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l cursor-pointer">
                                            Dokončit
                                        </a>
                                        <a v-show="reservation.status !== 'Schváleno'" href="#approve-reservation-modal" @click="selectedReservation = reservation" :class="{'bg-gray-100': i % 2 == 0, 'bg-gray-300': i % 2 != 0}" class="hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 cursor-pointer">
                                            Schválit 
                                        </a>
                                        <a href="#delete-reservation-modal" @click="selectedReservation = reservation" :class="{'bg-gray-100': i % 2 == 0, 'bg-gray-300': i % 2 != 0}" class="hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r cursor-pointer">
                                            Odstranit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <modal v-if="selectedReservation !== null" name="approve-reservation-modal">
            <h1 class="font-bold text-xl mb-2">Schválení rezervace</h1>
            <p>Opravdu chcete schválit rezervaci s ID "{{ selectedReservation.id }}"</p>
            <template v-slot:footer>
                <a href="#" class="px-4 py-2 block border border-gray-600 rounded shadow text-gray-600 hover:bg-red-600 hover:text-white">Zrušit</a>
                <a href="#" @click="approveReservation(selectedReservation.id)" class="px-4 py-2 block border border-purple-600 rounded shadow text-purple-600 hover:bg-purple-600 hover:text-white ml-2">Schválit</a>
            </template>
        </modal>

        <modal v-if="selectedReservation !== null" name="complete-reservation-modal">
            <h1 class="font-bold text-xl mb-2">Dokončení rezervace</h1>
            <p>Opravdu chcete dokončit rezervaci s ID "{{ selectedReservation.id }}"</p>
            <template v-slot:footer>
                <a href="#" class="px-4 py-2 block border border-gray-600 rounded shadow text-gray-600 hover:bg-red-600 hover:text-white">Zrušit</a>
                <a href="#" @click="completeReservation(selectedReservation.id)" class="px-4 py-2 block border border-purple-600 rounded shadow text-purple-600 hover:bg-purple-600 hover:text-white ml-2">Dokončit</a>
            </template>
        </modal>
        
        <modal v-if="selectedReservation !== null" name="delete-reservation-modal">
            <h1 class="font-bold text-xl mb-2">Odstranění rezervace</h1>
            <p>Opravdu chcete odstranit rezervaci s ID "{{ selectedReservation.id }}"</p>
            <template v-slot:footer>
                <a href="#" class="px-4 py-2 block border border-gray-600 rounded shadow text-gray-600 hover:bg-red-600 hover:text-white">Zrušit</a>
                <a href="#" @click="deleteReservation(selectedReservation.id)" class="px-4 py-2 block border border-purple-600 rounded shadow text-purple-600 hover:bg-purple-600 hover:text-white ml-2">Odstranit</a>
            </template>
        </modal>

        <div v-show="successMessage !== null" class="absolute bottom-0 left-0 ml-4 mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
            <p class="font-bold">Úspěch</p>
            <p>{{ successMessage }}</p>
        </div>
        <div v-show="errorMessage !== null" class="absolute bottom-0 left-0 ml-4 mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
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

            updatedCourseDate: this.courseDate,

            errorMessage: null,
            successMessage: null,
        };
    },

    methods: {
        deleteCourseDate() {
            if (confirm('Opravdu chcete odstranit tento termin? (Všechny rezervace budou zrušeny)')) {
                axios.delete('/admin/course-dates/' + this.courseDate.id)
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

        updateCourseDate() {
            axios.put('/admin/course-dates/' + this.courseDate.id, {
                course_id: this.courseDate.course_id,
                from_date_date: this.updatedCourseDate.from_date_date,
                from_date_time: this.updatedCourseDate.from_date_time,
                to_date_date: this.updatedCourseDate.to_date_date,
                to_date_time: this.updatedCourseDate.to_date_time,
                venue: this.updatedCourseDate.venue,
                limit: this.updatedCourseDate.limit,
                lecturer: this.updatedCourseDate.lecturer,
                description: this.updatedCourseDate.description
            }).then((response) => {
                this.courseDate = response.data.courseDate;
                this.updatedCourseDate = this.courseDate;
                this.updating = false;
                this.displayMessageFromResponse(response);
            });
        },

        approveReservation(id) {
            axios.post('/admin/reservations/' + id + '/approve')
                .then((response) => {
                    this.courseDate.reservations.forEach((reservation, index) => {
                        if (reservation.id == id) {
                            this.courseDate.reservations[index].status = 'Schváleno';
                            return;
                        }
                    });
                    this.displayMessageFromResponse(response);
                });
        },

        completeReservation(id) {
            axios.post('/admin/reservations/' + id + '/complete')
                .then((response) => {
                    this.courseDate.reservations.forEach((reservation, index) => {
                        if (reservation.id == id) {
                            this.courseDate.reservations[index].status = 'COMPLETED';
                            return;
                        }
                    });
                    this.displayMessageFromResponse(response);
                });
        },

        deleteReservation(id) {
            axios.delete('/admin/reservations/' + id)
                .then((response) => {
                    this.courseDate.reservations = this.courseDate.reservations.filter((reservation) => {
                        return reservation != id;
                    });
                    this.displayMessageFromResponse(response);
                });
        },

        displayMessageFromResponse(response) {
            if (response.data.success) {
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
        }
    }
}
</script>

<style>

</style>