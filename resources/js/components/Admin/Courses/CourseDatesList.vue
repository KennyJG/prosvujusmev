<template>
    <div class="h-screen w-full bg-gray-100">
        <div class="w-full flex flex-col text-gray-700 pt-4 pr-4">
            <div class="w-full flex bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                <div class="w-full font-regular text-blue-600 flex justify-end">
                    <div class="hidden lg:flex text-gray-800 ">
                        <a href="/admin/course-dates/create" class="focus:outline-none appearance-none py-4 px-2 border-b border-transparent hover:border-blue-600 hover:text-blue-600 mr-4">Vytvořit termín</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="w-full mb-4 flex flex-col text-gray-700 pt-4 pr-4">
            <div class="w-full flex bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                <div class="w-full">
                    <div class="border-b">
                        <div class="flex justify-between px-3 -mb-px">
                            <div class="w-1/5 py-3 text-left px-2 font-normal text-blue-600">Datum</div>
                            <div class="w-1/5 py-3 text-left px-2 font-normal text-blue-600">Kurz</div>
                            <div class="w-1/5 py-3 text-left px-2 font-normal text-blue-600">Místo</div>
                            <div class="w-1/5 py-3 text-left px-2 font-normal text-blue-600">Lektor</div>
                            <div class="w-1/5 py-3 text-left px-2 font-normal text-blue-600">Volných </div>
                        </div>
                    </div>
                    <a :href="'/admin/course-dates/' + courseDate.id" v-for="(courseDate, i) in localCourseDates" class="flex px-6 py-2 text-gray-600er items-center border-b -mx-4 course-pointer hover:bg-gray-200">
                        <div class="w-1/5">
                            <div class="px-4">{{ courseDate.fullDateForHumans }}</div>
                        </div>
                        <div class="w-1/5 text-left">
                            <div class="px-4">{{ courseDate.course.name }}</div>
                        </div>
                        <div class="w-1/5 text-left">
                            <div class="px-4">{{ courseDate.venue }}</div>
                        </div>
                        <div class="w-1/5 text-left">
                            <div class="px-4">{{ courseDate.lecturer }}</div>
                        </div>
                        <div class="w-1/5 text-left">
                            <div class="px-4">{{ courseDate.remaining }}</div>
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
    props: [
        'courseDates'
    ],
    data() {
        return {
            isModalDisplayed: false,
            localCourseDates: this.courseDates,
            showDeleteSuccessMessage: false,
        }
    },
    methods: {
        deleteCourseDate(id) {
            if (window.confirm('Opravdu chcete odstranit tento termín?')) {
                axios.delete('/admin/course-dates/' + id)
                    .then((response) => {
                        this.localCourseDates = this.localCourseDates.filter(courseDate => courseDate.id !== id);
                        this.showDeleteSuccessMessage = true;

                         setTimeout(() => {
                            this.showDeleteSuccessMessage = false;
                        }, 4000)
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