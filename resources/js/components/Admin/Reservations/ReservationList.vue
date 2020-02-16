<template>
    <div class="h-screen w-full bg-gray-100">
        <div class="flex-grow w-full pt-4 pb-8 pr-4">
            <div class="bg-white border-t border-b sm:border-l sm:border-r sm:rounded shadow mb-4">
                <div class="w-full h-full p-6">
                    <div class="w-full border-b pb-2 flex items-end justify-between">
                        <div class="text-3xl">Rezervace</div>
                        <!-- <a class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-500 hover:border-transparent rounded"
                            href="/admin/reservations/create">Přidat
                        </a> -->
                    </div>
                    <div class="w-full h-full mt-6">
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th class="px-1 py-1 text-left">ID</th>
                                    <th class="px-1 py-1 text-left">Kurz</th>
                                    <th class="px-1 py-1 text-left">Termín</th>
                                    <th class="px-1 py-1 text-left">Místo</th>
                                    <th class="px-1 py-1 text-left">Zdroj</th>
                                    <th class="px-1 py-1 text-left">Kód</th>
                                    <th class="px-1 py-1 text-left">Stav</th>
                                    <th class="px-1 py-1 text-left">Vytvořeno</th>
                                    <th class="px-1 py-1 text-right">Akce</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(reservation, i) in reservations" :class="{'bg-gray-200': i % 2 == 0}">
                                    <td class="border border-r-0 px-1 py-1 text-left text-blue-400"><a :href="'/admin/reservations/' + reservation.id">{{ reservation.id }}</a></td>
                                    <td class="border border-r-0 px-1 py-1 text-left">{{ reservation.course_date.course.name }}</td>
                                    <td class="border border-r-0 px-1 py-1 text-left">{{ reservation.course_date.fullDateForHumans }}</td>
                                    <td class="border border-r-0 px-1 py-1 text-left">{{ reservation.course_date.venue }}</td>
                                    <td class="border border-r-0 px-1 py-1 text-left">{{ reservation.source_type }}</td>
                                    <td class="border border-r-0 px-1 py-1 text-left">{{ reservation.source_code }}</td>
                                    <td class="border border-r-0 px-1 py-1 text-left">{{ reservation.status }}</td>
                                    <td class="border px-4 py-2 text-left">{{ reservation.createdAtForHumans }}</td>
                                    <td class="border border-l-0">
                                        <div class="inline-flex w-full">
                                            <!-- <a :href="'/admin/reservations/' + reservation.id + '/edit'" :class="{'bg-gray-100': i % 2 == 0, 'bg-gray-300': i % 2 != 0}" class="hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l">
                                                Editovat
                                            </a> -->
                                            <a @click="deleteReservation(reservation.id)" href="#" :class="{'bg-gray-100': i % 2 == 0, 'bg-gray-300': i % 2 != 0}" class="w-full text-center hover:bg-gray-400 text-gray-800 font-bold py-1">
                                                Odstranit
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div v-if="showDeleteSuccessMessage" class="fixed bottom-0 right-0 mb-4 mr-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded cursor-pointer" role="alert" @click="showDeleteSuccessMessage = false">
                    <strong class="font-bold">Úspěch!</strong>
                    <span class="block sm:inline pr-6">Termín byl odstraňěn.</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
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