<template>
    <div class="h-screen w-full bg-gray-100">
        <div class="w-full flex flex-col text-gray-700 pt-4 pr-4">
            <div class="w-full flex bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                <div class="w-full font-regular text-blue-600 flex justify-end">
                    <div class="hidden lg:flex text-gray-800 ">
                        <a href="/admin/courses/create" class="focus:outline-none appearance-none py-4 px-2 border-b border-transparent hover:border-blue-600 hover:text-blue-600 mr-4">Vytvořit kurz</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="w-full mb-4 flex flex-col text-gray-700 pt-4 pr-4">
            <div class="w-full flex bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                <div class="w-full">
                    <!-- <div class="border-b">
                        <div class="flex justify-between px-3 -mb-px">
                            <div class="py-3 px-2 font-normal text-blue-600">{{ date }}</div>
                        </div>
                    </div> -->
                    <a :href="'/admin/course-dates/' + course.id" v-for="(course, i) in localCourses" class="flex px-6 py-2 text-gray-600er items-center border-b -mx-4 course-pointer hover:bg-gray-200">
                        <div class="w-full">
                            <div class="px-4">{{ course.name }}</div>
                        </div>
                        <!-- <div class="w-1/2 text-right">
                            <div class="px-4 flex justify-end">
                                <a :href="'/admin/courses/' + course.id + '/edit'" class="focus:outline-none appearance-none px-2 border-b border-transparent hover:border-blue-600 hover:text-blue-600 mr-4">
                                    Editovat
                                </a>
                                <a @click.prevent="deleteCourse(course.id)" class="focus:outline-none appearance-none px-2 border-b border-transparent hover:border-blue-600 hover:text-blue-600 mr-4">
                                    Odstranit
                                </a>
                            </div>
                        </div> -->
                    </a>
                    <!-- <div class="px-6 py-2">
                        <div class="text-center text-gray font-bold">test</div>
                    </div> -->

                        
                </div>
            </div>
        </div>
        <confirmation-modal></confirmation-modal>
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