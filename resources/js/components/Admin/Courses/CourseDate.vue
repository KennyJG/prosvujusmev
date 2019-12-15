<template>
    <div class="w-full">
        <div class="w-full h-12 border-b flex justify-between">
            <div class="flex align-middle content-center text-gray-600">
                <div class="flex content-center items-center pl-6">
                    <a class="mr-4" href="/admin/course-dates">Termíny</a>/
                    <div class="ml-4 text-black">{{ courseDate.course.name }} {{ courseDate.from_date }} </div>
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
                    <div class="w-2/3">{{ courseDate.from_date }}</div>
                </div>
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Konec</div>
                    <div class="w-2/3">{{ courseDate.to_date }}</div>
                </div>
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Místo konání</div>
                    <div class="w-2/3">{{ courseDate.venue }}</div>
                </div>
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Limit</div>
                    <div class="w-2/3">{{ courseDate.limit }}</div>
                </div>
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Zbývá míst</div>
                    <div class="w-2/3">{{ courseDate.actual_limit }}</div>
                </div>
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Lektor</div>
                    <div class="w-2/3">{{ courseDate.lecturer }}</div>
                </div>
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Popis</div>
                    <div class="w-2/3">{{ courseDate.description }}</div>
                </div>
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
                                        <div :class="{'bg-gray-100': i % 2 == 0, 'bg-gray-300': i % 2 != 0}" class="hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l cursor-pointer">
                                            Potvrdit
                                        </div>
                                        <div :class="{'bg-gray-100': i % 2 == 0, 'bg-gray-300': i % 2 != 0}" class="hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 cursor-pointer">
                                            Schválit 
                                        </div>
                                        <div @click="deleteReservation(reservation.id)" :class="{'bg-gray-100': i % 2 == 0, 'bg-gray-300': i % 2 != 0}" class="hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r cursor-pointer">
                                            Odstranit
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['courseDate'],

    data() {
        return {

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
        }
    }
}
</script>

<style>

</style>