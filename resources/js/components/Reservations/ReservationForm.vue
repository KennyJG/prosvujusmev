<template>
    <div class="container w-full md:w-1/2 h-full m-auto flex justify-center items-center md:mt-4">
        <div class="leading-loose mb-12">
            <div class="max-w-xl p-10 bg-white rounded shadow-xl mt-4">
                <p class="text-gray-800 font-medium mb-2">Rezervace</p>
              
                <div class='flex'>
                    <div @click="toggleOrderForm()" :class="showOrderForm ? 'border border-purple-300 bg-purple-200' : '' " class="w-1/2 m-2 bg-gray-200 text-center flex justify-center items-center cursor-pointer rounded shadow"><div class="m-2">Mám číslo objednávky</div></div>
                    <div @click="toggleSlevomatForm()" :class="showSlevomatForm ? 'border border-purple-300 bg-purple-200' : ''" class="w-1/2 m-2 bg-gray-200 text-center flex justify-center items-center cursor-pointer rounded shadow"><div class="m-2">Mám kupón ze slevomat.cz</div></div>
                </div>

                <div :class="(showOrderForm || showSlevomatForm) ? 'block' : 'hidden'" class="mt-6">
                    <div class="">
                        <label class="block text-sm text-gray-600" for="cus_name">Kurz</label>
                        <div class="w-full block relative w-64">
                            <select @change="courseSelected($event)" v-model="course" class="w-full px-5 py-1 block appearance-none w-full bg-gray-200 text-gray-700 border hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                                <option value="-">-</option>
                                <option v-for="localCourse in courses" :value="localCourse.id">{{ localCourse.name }}</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>

                    <div :class="course === '-' ? 'hidden' : 'block'" class="mt-2">
                        <label class="block text-sm text-gray-600" for="cus_name">Termín</label>
                        <div class="w-full block relative w-64">
                            <select v-model="courseDate" class="w-full px-5 py-1 block appearance-none w-full bg-gray-200 text-gray-700 border hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline" name="courseDateId">
                                <option value="-">-</option>
                                <option v-for="localCourseDate in courseDates" :value="localCourseDate.id">Od {{ localCourseDate.from_date }} do {{ localCourseDate.to_date }} - {{ localCourseDate.venue }}</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>

                    <div :class="courseDate === '-' ? 'hidden' : 'block'" class="mt-12 border p-4">
                        <div class="">
                            <label class="block text-sm text-gray-600" for="sourceCode">{{ showOrderForm ? 'Číslo objednávky' : 'Kód Slevomat kupónu' }}</label>
                            <input v-model="form.sourceCode" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="sourceCode" name="sourceCode" type="text" required :aria-label="showOrderForm ? 'Číslo objednávky' : 'Kód Slevomat kupónu'">
                        </div>

                        <div class="mt-12">
                            <label class="block text-sm text-gray-600" for="first_name">Jméno</label>
                            <input v-model="form.firstName" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="first_name" name="first_name" type="text" required placeholder="Jan" aria-label="Jméno">
                        </div>
                        <div class="">
                            <label class="block text-sm text-gray-600" for="last_name">Přijmení</label>
                            <input v-model="form.lastName" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="last_name" name="last_name" type="text" required placeholder="Novák" aria-label="Přijmení">
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="email">Email</label>
                            <input v-model="form.email" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="email" name="email" type="email" required placeholder="jan.novak@priklad.cz" aria-label="Email">
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="phone">Telefon</label>
                            <input v-model="form.phone" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="phone" name="phone" type="text" required="" placeholder="+420 777 888 999" aria-label="Telefon">
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="street">Adresa</label>
                            <input v-model="form.street" class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="street" name="street" type="text" required="" placeholder="Ulice" aria-label="Ulice">
                        </div>
                        <div class="mt-2">
                            <label class="hidden text-sm block text-gray-600" for="city">Město</label>
                            <input v-model="form.city" class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="city" name="city" type="text" required="" placeholder="Město" aria-label="Město">
                        </div>
                        <div class="inline-block mt-2 w-1/2 pr-1">
                            <label class="hidden block text-sm text-gray-600" for="country">Stát</label>
                            <input v-model="form.country" class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="country" name="country" type="text" required="" placeholder="Stát" aria-label="Stát">
                        </div>
                        <div class="inline-block mt-2 -mx-1 pl-1 w-1/2">
                            <label class="hidden block text-sm text-gray-600" for="zip">PSČ</label>
                            <input v-model="form.zip" class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="zip"  name="zip" type="text" required="" placeholder="PSČ" aria-label="PSČ">
                        </div>
                        <!-- <p class="mt-4 text-gray-800 font-medium">Payment information</p>
                        <div class="">
                            <label class="block text-sm text-gray-600" for="cus_name">Card</label>
                            <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="cus_name" name="cus_name" type="text" required="" placeholder="Card Number MM/YY CVC" aria-label="Name">
                        </div>
                        <div class="mt-4">
                            <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">$3.00</button>
                        </div> -->
                    </div>
                    <div :class="courseDate !== '-' && course !== '-' ? 'block' : 'hidden'" class="mt-12 w-full">
                        <button @click="createReservation()" class="px-4 w-full py-1 text-white font-light tracking-wider bg-gray-900 rounded">REZERVOVAT</button>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="showCreateReservationSuccessMessage" class="fixed bottom-0 left-0 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 md:mb-6 md:ml-6 w-full md:w-auto" role="alert">
            <p class="font-bold">Rezervace vytvořena</p>
            <p>Děkujume za Váš zájem</p>
        </div>

        <div v-if="showCreateReservationFailedMessage" class="fixed bottom-0 left-0 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 md:mb-6 md:ml-6 w-full md:w-auto" role="alert">
            <p class="font-bold">Vytvoření rezervace se nezdařilo</p>
            <p>Zkontrolujte prosím zadané údaje, v případě pokračujících potíží nás prosím kontaktujte.</p>
        </div>
    </div>  
</template>

<script>
export default {
    data() {
        return {
            showOrderForm: false,
            showSlevomatForm: false,
            
            course: '-',
            courseDate: '-',

            courses: [],
            courseDates: [],

            form: {
                sourceCode: '',
                firstName: '',
                lastName: '',
                email: '',
                phone: '',
                street: '',
                city: '',
                country: '',
                zip: '',
            },
            
            showCreateReservationSuccessMessage: false,
            showCreateReservationFailedMessage: false,
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
            axios.get('/api/course-dates?courseId=' + id)
                .then((response) => {
                    this.courseDates = response.data.data;
                })
        },

        toggleOrderForm: function() {
            this.showSlevomatForm = false;
            this.showOrderForm = !this.showOrderForm;
        },

        toggleSlevomatForm: function() {
            this.showOrderForm = false;
            this.showSlevomatForm = !this.showSlevomatForm;
        },

        createReservation() {
            axios.post('/reservations', {
                courseDateId: this.courseDate,
                sourceType: this.showOrderForm ? 'ORDER' : 'SLEVOMAT',
                sourceCode: this.form.sourceCode,
                firstName: this.form.firstName,
                lastName: this.form.lastName,
                email: this.form.email,
                phone: this.form.phone,
                street: this.form.street,
                city: this.form.city,
                country: this.form.country,
                zip: this.form.zip,
            }).then((response) => {
                this.showOrderForm = false;
                this.showSlevomatForm = false;
                this.course = null;
                this.courseDate = null;
                this.form.sourceCode = null;
                this.form.firstName = null;
                this.form.lastName = null;
                this.form.email = null;
                this.form.phone = null;
                this.form.street = null;
                this.form.city = null;
                this.form.country = null;
                this.form.zip = null;

                this.showCreateReservationSuccessMessage = true;
                setTimeout(() => {
                    this.showCreateReservationSuccessMessage = false;
                }, 8000);
            }).catch((er) => {
                this.showCreateReservationFailedMessage = true;
                setTimeout(() => {
                    this.showCreateReservationFailedMessage = false;
                }, 8000);
            });
        }
    },

    mounted() {
        this.getCourses();
    }
}
</script>

<style>

</style>