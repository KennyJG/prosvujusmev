<template>
    <div class="h-full w-full">
        <div class="w-full h-12 bg-gray-200">
        </div>
        <div class="w-full h-full p-6">
            <div class="w-full border-b pb-2 flex items-end justify-between">
                <div class="text-3xl">Kurzy</div>
                <a class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-500 hover:border-transparent rounded"
                    href="/admin/courses/create">Přidat
                </a>
            </div>
            <div class="w-full h-full mt-6">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th class="px-2 py-2 text-left">Jméno</th>
                            <th class="px-2 py-2 text-right">Akce</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(course, i) in localCourses" :class="{'bg-gray-200': i % 2 == 0}">
                            <td class="border border-r-0 px-4 py-2">{{ course.name }}</td>
                            <td class="border border-l-0 px-4 py-4 text-right">
                                <div class="inline-flex">
                                    <a :href="'/admin/courses/' + course.id + '/edit'" :class="{'bg-gray-100': i % 2 == 0,'bg-gray-300': i % 2 != 0}" class="hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l">
                                        Editovat
                                    </a>
                                    <a @click="deleteCourse(course.id)" :class="{'bg-gray-100': i % 2 == 0,'bg-gray-300': i % 2 != 0}" class="hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r cursor-pointer">
                                        Odstranit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <confirmation-modal></confirmation-modal>
            </div>
        </div>
        <div v-if="showDeleteSuccessMessage" class="fixed bottom-0 right-0 mb-4 mr-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded cursor-pointer" role="alert" @click="showDeleteSuccessMessage = false">
            <strong class="font-bold">Úspěch!</strong>
            <span class="block sm:inline pr-6">Kurz byl odstraňěn.</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'courses'
    ],
    data() {
        return {
            localCourses: this.courses,
            showDeleteSuccessMessage: false,
        }
    },
    methods: {
        deleteCourse(id) {
            if (window.confirm('Opravdu chcete odstranit tento kurz?')) {
                axios.delete('/admin/courses/' + id)
                    .then((response) => {
                        this.localCourses = this.localCourses.filter(course => course.id !== id);
                        this.showDeleteSuccessMessage = true;

                        setTimeout(() => {
                            this.showDeleteSuccessMessage = false;
                        }, 4000);
                    });
            }
        }
    },

    mounted() {
    }
}
</script>

<style>

</style>