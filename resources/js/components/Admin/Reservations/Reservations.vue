<template>
    <div class="h-screen w-full bg-gray-100">
        <!-- <div class="w-full flex flex-col text-gray-700 pt-4 pr-4">
            <div class="w-full flex bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                <div class="w-full font-regular text-blue-600 flex justify-end">
                    <div class="hidden lg:flex text-gray-800 ">
                        <div class="focus:outline-none appearance-none py-4 px-2 border-b border-transparent hover:border-blue-600 hover:text-blue-600 mr-4">&zwnj;</div>
                    </div>
                </div>
            </div>
        </div>
         -->
        <div class="w-full mb-4 flex flex-col text-gray-700 pt-4 pr-4">
            <div class="w-full flex bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                <div class="w-full">
                    <div class="border-b">
                        <div class="flex justify-between px-3 -mb-px">
                            <div class="w-1/12 py-3 text-left px-2 font-normal text-blue-600">ID</div>
                            <div class="w-1/12 py-3 text-left px-2 font-normal text-blue-600">Kurz</div>
                            <div class="w-2/12 py-3 text-left px-2 font-normal text-blue-600">Termín</div>
                            <div class="w-1/12 py-3 text-left px-2 font-normal text-blue-600">Místo</div>
                            <div class="w-1/12 py-3 text-left px-2 font-normal text-blue-600">Zdroj</div>
                            <div class="w-2/12 py-3 text-left px-2 font-normal text-blue-600">Kód</div>
                            <div class="w-2/12 py-3 text-left px-2 font-normal text-blue-600">Stav</div>
                            <div class="w-2/12 py-3 text-left px-2 font-normal text-blue-600">Vytvořeno</div>
                        </div>
                    </div>
                    <a :href="'/admin/reservations/' + reservation.id" v-for="(reservation, i) in reservations" class="flex px-6 py-2 text-gray-600er items-center border-b -mx-4 course-pointer hover:bg-gray-200">
                        <div class="w-1/12">
                            <div class="px-2">{{ reservation.id }}</div>
                        </div>
                        <div class="w-1/12 text-left">
                            <div class="px-2">{{ reservation.course_date.course.name }}</div>
                        </div>
                        <div class="w-2/12 text-left">
                            <div class="px-2">{{ reservation.course_date.fullDateForHumans }}</div>
                        </div>
                        <div class="w-1/12 text-left">
                            <div class="px-2">{{ reservation.course_date.venue }}</div>
                        </div>
                        <div class="w-1/12 text-left">
                            <div class="px-2">{{ reservation.source_type }}</div>
                        </div>
                        <div class="w-2/12 text-left">
                            <div class="px-2">{{ reservation.source_code }}</div>
                        </div>
                        <div class="w-2/12 text-left">
                            <div class="px-2">{{ reservation.status }}</div>
                        </div>
                        <div class="w-2/12 text-left">
                            <div class="px-2">{{ reservation.createdAtForHumans }}</div>
                        </div>
                    </a>
                    <!-- <div class="px-6 py-2">
                        <div class="text-center text-gray font-bold">test</div>
                    </div> -->    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            reservations: [],
            showDeleteSuccessMessage: false,
        }
    },
    methods: {
        getReservations() {
            axios.get('/admin/reservations?json=true')
                .then((response) => {
                    this.reservations = response.data.data;
                });
        },

        deleteReservation(id) {
            if (window.confirm('Opravdu chcete odstranit tuto rezervaci?')) {
                axios.delete('/admin/reservations/' + id)
                    .then((response) => {
                        this.reservations = this.reservations.filter(reservation => reservation.id !== id);
                        this.showDeleteSuccessMessage = true;
                        setTimeout(() => {
                            this.showDeleteSuccessMessage = false;
                        }, 4000)
                    });
            }
        }
    },

    mounted() {
        this.getReservations();
    }
}
</script>

<style>

</style>