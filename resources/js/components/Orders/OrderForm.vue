<template>
    <div>
        <div class="w-2/3 flex flex-col mx-auto mt-12">
            <div class="flex w-full">
                <div class="w-1/5 flex flex-col text-center">
                    <div class="flex justify-center text-center">
                        <div @click="activeTab = 'SELECT_COURSE'" :class="{'bg-purple-600 text-white': activeTab == 'SELECT_COURSE'}" class="rounded-full border h-12 w-12 shadow-md flex justify-center items-center bg-white text-purple-300 cursor-pointer">
                            <div class="font-bold">1</div>
                        </div>
                    </div>
                    <div :class="{'text-purple-600': activeTab == 'SELECT_COURSE'}" class="mt-2 font-bold h-12 text-purple-300">Zvolit kurz</div>
                </div>
                <div class="w-1/5 flex flex-col text-center">
                    <div class="flex justify-center text-center">
                        <div @click="activeTab = 'SELECT_COURSE_VENUE'" :class="{'bg-purple-600 text-white': activeTab == 'SELECT_COURSE_VENUE'}" class="rounded-full border h-12 w-12 shadow-md flex justify-center items-center bg-white text-purple-300 cursor-pointer">
                            <div class="font-bold">2</div>
                        </div>
                    </div>
                    <div :class="{'text-purple-600': activeTab == 'SELECT_COURSE_VENUE'}" class="mt-2 text-purple-300 font-bold h-12">Zvolit místo</div>
                </div>
                <div class="w-1/5 flex flex-col text-center">
                    <div class="flex justify-center text-center">
                        <div @click="activeTab = 'SELECT_COURSE_DATE'" :class="{'bg-purple-600 text-white': activeTab == 'SELECT_COURSE_DATE'}" class="rounded-full border h-12 w-12 shadow-md flex justify-center items-center bg-white text-purple-300 cursor-pointer">
                            <div class="font-bold">3</div>
                        </div>
                    </div>
                    <div :class="{'text-purple-600': activeTab == 'SELECT_COURSE_DATE'}" class="mt-2 text-purple-300 font-bold h-12">Zvolit termín</div>
                </div>
                <div class="w-1/5 flex flex-col text-center">
                    <div class="flex justify-center text-center">
                        <div @click="activeTab = 'FILL_INFORMATION'" :class="{'bg-purple-600 text-white': activeTab == 'FILL_INFORMATION'}" class="rounded-full border h-12 w-12 shadow-md flex justify-center items-center bg-white text-purple-300 cursor-pointer">
                            <div class="font-bold">4</div>
                        </div>
                    </div>
                    <div :class="{'text-purple-600': activeTab == 'FILL_INFORMATION'}" class="mt-2 text-purple-300 font-bold h-12">Vyplnění údajů</div>
                </div>
                <div class="w-1/5 flex flex-col text-center">
                    <div class="flex justify-center text-center">
                        <div @click="activeTab = 'RESERVATION_SUMMARY'" :class="{'bg-purple-600 text-white': activeTab == 'RESERVATION_SUMMARY'}" class="rounded-full border h-12 w-12 shadow-md flex justify-center items-center bg-white text-purple-300 cursor-pointer">
                            <div class="font-bold">5</div>
                        </div>
                    </div>
                    <div :class="{'text-purple-600': activeTab == 'RESERVATION_SUMMARY'}" class="mt-2 text-purple-300 font-bold h-12">Shrnutí</div>
                </div>
            </div>
            <div v-if="activeTab == 'SELECT_COURSE'">
                <div class="w-full flex flex-wrap my-6">
                    <div class="w-1/4 px-2 mt-4" v-for="course in courses">
                        <div :class="{'bg-purple-600 hover:bg-purple-700 text-white': selectedCourse == course}" @click="selectCourse(course)" class="text-center shadow rounded border px-2 py-4 hover:bg-gray-100 cursor-pointer">{{ course.name }}</div>
                    </div>
                </div>
                <div class="w-full flex justify-end p-6 mt-6">
                    <button 
                        :disabled="selectedCourse == null" 
                        :class="{'opacity-50': selectedCourse == null}" 
                        class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-full"
                        @click="activeTab = 'SELECT_COURSE_VENUE';"
                        style="outline: none;">
                        Pokračovat
                    </button>
                </div>
            </div>
            <div v-if="activeTab == 'SELECT_COURSE_VENUE'">
                <div class="w-full flex flex-wrap my-6">
                    <div class="w-1/4 px-2 mt-4" v-for="venue in getCourseVenues(selectedCourse)">
                        <div :class="{'bg-purple-600 hover:bg-purple-700 text-white': selectedCourseVenue == venue}" @click="selectVenue(venue)" class="text-center shadow rounded border px-2 py-4 hover:bg-gray-100 cursor-pointer">{{ venue }}</div>
                    </div>
                </div>
                <div class="w-full flex justify-end p-6 mt-6">
                    <button 
                        class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-full mr-2"
                        @click="activeTab = 'SELECT_COURSE';"
                        style="outline: none;">
                        Zpět
                    </button>
                    <button 
                        :disabled="selectedCourseVenue == null" 
                        :class="{'opacity-50': selectedCourseVenue == null}" 
                        class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-full"
                        @click="activeTab = 'SELECT_COURSE_DATE'"
                        style="outline: none;">
                        Pokračovat
                    </button>
                </div>
            </div>
            <div v-if="activeTab == 'SELECT_COURSE_DATE'">
                <div class="w-full flex flex-wrap my-6">
                    <div class="w-1/4 px-2 mt-4" v-for="courseDate in getCourseVenueDates(selectedCourse, selectedCourseVenue)">
                        <div :class="{'bg-purple-600 hover:bg-purple-700 text-white': selectedCourseDate == courseDate}" @click="selectCourseDate(courseDate)" class="text-center shadow rounded border px-2 py-4 hover:bg-gray-100 cursor-pointer">{{ courseDate.fullDateForHumans }}</div>
                    </div>
                </div>
                <div class="w-full flex justify-end p-6 mt-6">
                    <button 
                        class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-full mr-2"
                        @click="activeTab = 'SELECT_COURSE_VENUE';"
                        style="outline: none;">
                        Zpět
                    </button>
                    <button 
                        :disabled="selectedCourseDate == null" 
                        :class="{'opacity-50': selectedCourseDate == null}" 
                        class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-full"
                        @click="activeTab = 'FILL_INFORMATION'"
                        style="outline: none;">
                        Pokračovat
                    </button>
                </div>
            </div>
            <div v-if="activeTab == 'FILL_INFORMATION'">
                <div>
                    <div v-for="(reservation, index) in reservations">
                        <div @click="toggleReservation(index)" v-if='!activeReservations.includes(index)' class='p-3 border mt-12 flex justify-between cursor-pointer content-center items-center'>
                            <div class="text-sm text-gray-600 pl-4">{{ reservation.sourceCode }} - {{ reservation.firstName }} {{ reservation.lastName }}</div>
                            <div class="align-middle">
                                <svg class="text-orange-500 hover:text-orange-600 fill-current fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                    <path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"/>
                                </svg>
                            </div>
                        </div>
                        <div v-else class="mt-12 border p-4"> 
                            <div :class="{ 'justify-between': index !== 0, 'justify-end': index === 0 }" class="w-full flex">
                                <div v-if="index !== 0" class="align-middle">
                                    <div @click="removeReservation(index)" class="text-sm text-gray-600 flex content-center cursor-pointer">
                                        <div class="mr-2">
                                            <svg class="text-orange-500 hover:text-orange-600 fill-current inline-block h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                <path d="M108 284c-6.6 0-12-5.4-12-12v-32c0-6.6 5.4-12 12-12h232c6.6 0 12 5.4 12 12v32c0 6.6-5.4 12-12 12H108zM448 80v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48zm-48 346V86c0-3.3-2.7-6-6-6H54c-3.3 0-6 2.7-6 6v340c0 3.3 2.7 6 6 6h340c3.3 0 6-2.7 6-6z"/>
                                            </svg>
                                        </div>
                                        <div>Odebrat osobu</div>
                                    </div>
                                </div>
                                <div class="align-middle">
                                    <svg @click='toggleReservation(index)' class="text-orange-500 hover:text-orange-600 fill-current h-5 w-5 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                        <path d="M288.662 352H31.338c-17.818 0-26.741-21.543-14.142-34.142l128.662-128.662c7.81-7.81 20.474-7.81 28.284 0l128.662 128.662c12.6 12.599 3.676 34.142-14.142 34.142z"/>
                                    </svg>
                                </div>
                            </div>
                            <div v-if="selectedCourseDate.remaining == 0" class="mt-6">
                                <div :class="selectedCourse === '-' ? 'hidden' : 'block'" class="mt-2">
                                    <label class="block text-sm text-gray-600" for="cus_name">Místo</label>
                                    <div class="w-full block relative w-64">
                                        <select :class="{ 'border border-red-600': courseDateErrors.length !== 0 }" v-model="mainCourseDateVenue" class="w-full px-5 py-1 block appearance-none bg-gray-200 text-gray-700 border hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline" name="courseDateId">
                                            <option value="-">-</option>
                                            <option v-for="venue in getVenues()" :value="venue">{{ venue }}</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                        </div>
                                    </div>
                                </div>
                                <div :class="selectedCourse === '-' || selectedCourseDateVenue === '-' ? 'hidden' : 'block'" class="mt-2 mb-2">
                                    <label class="block text-sm text-gray-600" for="cus_name">Termín</label>
                                    <div class="w-full block relative w-64">
                                        <select :class="{ 'border border-red-600': courseDateErrors.length !== 0 }" v-model="mainCourseDate" class="w-full px-5 py-1 block appearance-none bg-gray-200 text-gray-700 border hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline" name="courseDateId">
                                            <option value="-">-</option>
                                            <option v-if="localCourseDate.remaining !== 0" v-for="localCourseDate in filterCourseDatesForVenue(mainCourseDateVenue)" :value="localCourseDate">
                                                {{ localCourseDate.fullDateForHumans }}
                                                <span class="italic" v-if="localCourseDate.remaining <= 5 && localCourseDate.remaining > 2">Poslední volná místa</span>
                                                <span class="italic font-bold" v-if="localCourseDate.remaining == 2">Poslední dvě volná místa</span>
                                                <span class="italic font-bold" v-if="localCourseDate.remaining == 1">Poslední 1 volné místo</span>
                                            </option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class=" text-xs italic text-gray-600 mt-1">
                                    Zvolený termín je plný, bude zapsán jako náhradník. Zvolte prosím termín který je volný, pro případ že by se termín ve kterém jste náhradník neuvolnil.
                                </div>
                            </div>
                            <div class="mt-2 relative">
                                <label class="block text-sm text-gray-600" for="sourceCode">Číslo objednávky</label>
                                <input @focus="focus = 'sourceCode'" @blur="focus = null" v-model="reservation.sourceCode" :class="{ 'border border-red-600': reservation.errors.sourceCode.length !== 0 }" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="sourceCode" name="sourceCode" type="text" required aria-label="Číslo objednávky">
                                <div class="text-sm italic text-red-600" v-show="reservation.errors.sourceCode.length !== 0" v-for="error in reservation.errors.sourceCode">{{ error }}</div>
                                <div class="absolute right-0 top-0 rounded shadow bg-yellow-100 w-64 p-4 border mt-6" v-show="focus == 'sourceCode'" style="right: -17rem;">Cislo kuponu naleznete na vasi fakture objednavky, nebo na vasem kuponu ze Slevomatu.</div>
                            </div>
                    

                            <div class="mt-6">
                                <label class="block text-sm text-gray-600" for="first_name">Jméno</label>
                                <input v-model="reservation.firstName" :class="{ 'border border-red-600': reservation.errors.firstName.length !== 0 }"class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="first_name" name="first_name" type="text" required placeholder="Jan" aria-label="Jméno">
                                <div class="text-sm italic text-red-600" v-show="reservation.errors.firstName.length !== 0" v-for="error in reservation.errors.firstName">{{ error }}</div>
                            </div>
                            <div class="">
                                <label class="block text-sm text-gray-600" for="last_name">Přijmení</label>
                                <input v-model="reservation.lastName" :class="{ 'border border-red-600': reservation.errors.lastName.length !== 0 }" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="last_name" name="last_name" type="text" required placeholder="Novák" aria-label="Přijmení">
                                <div class="text-sm italic text-red-600" v-show="reservation.errors.lastName.length !== 0" v-for="error in reservation.errors.lastName">{{ error }}</div>
                            </div>
                            <div class="mt-2">
                                <label class="block text-sm text-gray-600" for="email">Email</label>
                                <input v-model="reservation.email" :class="{ 'border border-red-600': reservation.errors.email.length !== 0 }" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="email" name="email" type="email" required placeholder="jan.novak@priklad.cz" aria-label="Email">
                                <div class="text-sm italic text-red-600" v-show="reservation.errors.email.length !== 0" v-for="error in reservation.errors.email">{{ error }}</div>
                            </div>
                            <div class="mt-2">
                                <label class="block text-sm text-gray-600" for="phone">Telefon</label>
                                <input v-model="reservation.phone" :class="{ 'border border-red-600': reservation.errors.phone.length !== 0 }" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="phone" name="phone" type="text" required="" placeholder="+420 777 888 999" aria-label="Telefon">
                                <div class="text-sm italic text-red-600" v-show="reservation.errors.phone.length !== 0" v-for="error in reservation.errors.phone">{{ error }}</div>
                            </div>
                            <div class="mt-2">
                                <label class="block text-sm text-gray-600" for="street">Adresa</label>
                                <input v-model="reservation.street" :class="{ 'border border-red-600': reservation.errors.street.length !== 0 }" class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="street" name="street" type="text" required="" placeholder="Ulice" aria-label="Ulice">
                                <div class="text-sm italic text-red-600" v-show="reservation.errors.street.length !== 0" v-for="error in reservation.errors.street">{{ error }}</div>
                            </div>
                            <div class="mt-2">
                                <label class="hidden text-sm block text-gray-600" for="city">Město</label>
                                <input v-model="reservation.city" :class="{ 'border border-red-600': reservation.errors.city.length !== 0 }" class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="city" name="city" type="text" required="" placeholder="Město" aria-label="Město">
                                <div class="text-sm italic text-red-600" v-show="reservation.errors.city.length !== 0" v-for="error in reservation.errors.city">{{ error }}</div>
                            </div>
                            <div class="inline-block mt-2 w-1/2 pr-1">
                                <label class="hidden block text-sm text-gray-600" for="country">Stát</label>
                                <input v-model="reservation.country" :class="{ 'border border-red-600': reservation.errors.country.length !== 0 }" class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="country" name="country" type="text" required="" placeholder="Stát" aria-label="Stát">
                                <div class="text-sm italic text-red-600" v-show="reservation.errors.country.length !== 0" v-for="error in reservation.errors.country">{{ error }}</div>
                            </div>
                            <div class="inline-block mt-2 -mx-1 pl-1 w-1/2">
                                <label class="hidden block text-sm text-gray-600">PSČ</label>
                                <input v-model="reservation.zip" :class="{ 'border border-red-600': reservation.errors.zip.length !== 0 }" class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" name="zip" type="text" required="" placeholder="PSČ" aria-label="PSČ">
                                <div class="text-sm italic text-red-600" v-show="reservation.errors.zip.length !== 0" v-for="error in reservation.errors.zip">{{ error }}</div>
                            </div>
                        </div>
                    </div>
                    <a @click="addReservation()"> 
                        <div class="mt-4 text-sm text-gray-600 flex content-center cursor-pointer">
                            <div class="mr-2">
                                <svg class="fill-current text-gray-500 inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M352 240v32c0 6.6-5.4 12-12 12h-88v88c0 6.6-5.4 12-12 12h-32c-6.6 0-12-5.4-12-12v-88h-88c-6.6 0-12-5.4-12-12v-32c0-6.6 5.4-12 12-12h88v-88c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v88h88c6.6 0 12 5.4 12 12zm96-160v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48zm-48 346V86c0-3.3-2.7-6-6-6H54c-3.3 0-6 2.7-6 6v340c0 3.3 2.7 6 6 6h340c3.3 0 6-2.7 6-6z"/>
                                </svg>
                            </div>
                            <div>Přidat další osobu</div>
                        </div>
                    </a>
                </div>
                <div class="w-full flex justify-end p-6 mt-6">
                    <button 
                        class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-full mr-2"
                        @click="activeTab = 'SELECT_COURSE_DATE';"
                        style="outline: none;">
                        Zpět
                    </button>
                    <button 
                        :disabled="true" 
                        :class="{'opacity-50': true}" 
                        class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-full"
                        @click="activeTab = 'RESERVATION_SUMMARY'"
                        style="outline: none;">
                        Pokračovat
                    </button>
                </div>
            </div>
            <div v-if="activeTab == 'RESERVATION_SUMMARY'">
                <div class="w-full flex flex-wrap my-6">
                </div>
                <div class="w-full flex justify-end p-6 mt-6">
                    <button 
                        class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-full mr-2"
                        @click="activeTab = 'SELECT_COURSE_VENUE';"
                        style="outline: none;">
                        Zpět
                    </button>
                    <button 
                        :disabled="selectedCourseDate == null" 
                        :class="{'opacity-50': selectedCourseDate == null}" 
                        class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-full"
                        @click="activeTab = 'FILL_INFORMATION'"
                        style="outline: none;">
                        Rezervovat
                    </button>
                </div>
            </div>
        </div>      
    </div>  
</template>

<script>
export default {
    data() {
        return {
            activeTab: 'SELECT_COURSE',

            selectedCourse: null,
            selectedCourseVenue: null,
            selectedCourseDateDate: null, 
            selectedCourseDate: null,
            mainCourseDate: null, 
            mainCourseDateVenue: null,

            courses: [],
            courseDates: [],

            reservations: [
                {
                    sourceCode: '',
                    firstName: '',
                    lastName: '',
                    email: '',
                    phone: '',
                    street: '',
                    city: '',
                    country: '',
                    zip: '',
                    courseDateId: null,
                    errors: {
                        sourceCode: [],
                        firstName: [],
                        lastName: [],
                        email: [],
                        phone: [],
                        street: [],
                        city: [],
                        country: [],
                        zip: [], 
                    },
                },
            ],
            activeReservations: [0],
            courseDateErrors: [],
            
            showCreateReservationSuccessMessage: false,
            showCreateReservationFailedMessage: false,

            focus: null,
        }
    },
    methods: {
        getCourses() {
            axios.get('/api/courses')
                .then((response) => {
                    this.courses = response.data.data;
                });
        },

        courseSelected(event) {
            let courseId = event.target.value;
            this.getCourseDates(courseId);
        },

        getCourseDates(id) {
            axios.get('/api/course-dates?courseId=' + id + '&status=ACTIVE')
                .then((response) => {
                    this.courseDates = response.data.data;
                })
        },

        createReservation() {
            let reservations = this.reservations;
            reservations = reservations.forEach((reservation) => {
                if (this.mainCourseDate !== '-') {
                    reservation.queuedCourseDateId = this.selectedCourseDate.id;
                    reservation.courseDateId = this.mainCourseDate.id;
                } else {
                    reservation.courseDateId = this.selectedCourseDate.id;
                    reservation.queuedCourseDateId = null;
                }
            });

            this.reservations.forEach((reservation, index) => {
                this.reservations[index].errors = {
                    sourceCode: [],
                    firstName: [],
                    lastName: [],
                    email: [],
                    phone: [],
                    street: [],
                    city: [],
                    country: [],
                    zip: [], 
                };
            });
            this.courseDateErrors = [];
            axios.post('/reservations', { reservations: this.reservations })
                .then((response) => {
                    this.selectedCourse = '-';
                    this.selectedCourseDate = '-';
                    this.reservations = [
                        {
                            sourceCode: '',
                            firstName: '',
                            lastName: '',
                            email: '',
                            phone: '',
                            street: '',
                            city: '',
                            country: '',
                            zip: '',
                            courseDateId: null,
                            errors: {
                                sourceCode: [],
                                firstName: [],
                                lastName: [],
                                email: [],
                                phone: [],
                                street: [],
                                city: [],
                                country: [],
                                zip: [], 
                            },
                        }, 
                    ];
                    this.activeReservations = [0];
                    this.showCreateReservationSuccessMessage = true;
                    setTimeout(() => {
                        this.showCreateReservationSuccessMessage = false;
                    }, 8000);
                }).catch((er) => {
                    let errors = er.response.data.errors;
                    for (let key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            let splittedKey = key.split('.');
                            let formReservationNumber = splittedKey[1];
                            let errorName = splittedKey[2];
                            let errorMessages = errors[key];
                            this.reservations[formReservationNumber].errors[errorName] = errorMessages;
                        }
                        if (key.includes('courseDateId')) { 
                            this.courseDateErrors = errors[key];
                        }
                    }
                    this.showCreateReservationFailedMessage = true;
                    setTimeout(() => {
                        this.showCreateReservationFailedMessage = false;
                    }, 8000);                    
                });
        },

        addReservation() {
            this.reservations.push(
                {
                    sourceCode: '',
                    firstName: '',
                    lastName: '',
                    email: '',
                    phone: '',
                    street: this.reservations[0].street,
                    city: this.reservations[0].city,
                    country: this.reservations[0].country,
                    zip: this.reservations[0].zip,
                    courseDateId: null,
                    errors: {
                        sourceCode: [],
                        firstName: [],
                        lastName: [],
                        email: [],
                        phone: [],
                        street: [],
                        city: [],
                        country: [],
                        zip: [], 
                    },
                }
            );
            this.activeReservations.push(this.reservations.length - 1);
        },

        removeReservation(index) {
            this.activeReservations = this.activeReservations.filter((activeReservation) => {
                return activeReservation != index;
            });

            this.reservations = this.reservations.filter((reservation, reservationIndex) => {
                return index != reservationIndex;
            });
        },

        toggleReservation(index) {
            if (this.activeReservations.includes(index)) {
                this.activeReservations = this.activeReservations.filter((activeReservation) => {
                    return activeReservation != index;
                });
            } else {
                this.activeReservations.push(index);
            }
        },

        filterCourseDatesForVenue(venue) {
            return this.courseDates.filter(courseDate => {
                return courseDate.venue == venue;
            });
        },

        getVenues() {
            let venues = [];
            this.courseDates.forEach(courseDate => {
                if (!venues.includes(courseDate.venue)) {
                    venues.push(courseDate.venue);
                }
            });
            return venues;
        },

        selectCourse(course) {
            if (course == this.selectedCourse) {
                this.selectedCourse = null;
            } else {
                this.selectedCourse = course;
            }
        },

        selectVenue(venue) {
            if (venue == this.selectedCourseVenue) {
                this.selectedCourseVenue = null;
            } else {
                this.selectedCourseVenue = venue;
            }
        },

        selectCourseDate(courseDate) {
            if (courseDate == this.selectedCourseDate) {
                this.selectedCourseDate = null;
            } else {
                this.selectedCourseDate = courseDate;
            }
        },

        getCourseVenues(course) {
            let venues = [];
            course.courseDates.forEach(courseDate => {
                if (!venues.includes(courseDate.venue)) {
                    venues.push(courseDate.venue);
                }
            });
            return venues;
        },

        getCourseVenueDates(course, venue) {
            let courseDates = [];
            return course.courseDates.filter(courseDate => {
                return courseDate.venue == venue;
            });
        },
    },

    mounted() {
        this.getCourses();
    }
}
</script>

<style>

</style>