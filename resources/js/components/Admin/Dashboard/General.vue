<template>
    <div class="flex flex-wrap">
        <div v-for="(courseDateGroup, date) in courseDateGroups" class="w-full mb-4 lg:w-1/2 flex px-2 flex-col text-gray-700">
            <div class="w-full flex bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                <div class="w-full">
                    <div class="border-b">
                        <div class="flex justify-between px-3 -mb-px">
                            <div class="py-3 px-2 font-normal text-blue-600">{{ date }}</div>
                        </div>
                    </div>
                    <a :href="'/admin/course-dates/' + courseDate.id" v-for="courseDate in courseDateGroup" class="flex px-6 py-2 text-gray-600er items-center border-b -mx-4 course-pointer hover:bg-gray-200">
                        <div class="w-1/4">
                            <div class="px-4">{{ courseDate.courseName }}</div>
                        </div>
                        <div class="w-1/4 text-right">
                            <div class="px-4">{{ courseDate.venue }}</div>
                        </div>
                        <div class="w-1/4 text-right">
                            <div class="px-4">{{ courseDate.lecturer }}</div>
                        </div>
                        <div class="w-1/4 text-right">
                            <div class="px-4">{{ courseDate.limit - courseDate.remaining }} / {{ courseDate.limit }}</div>
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
            courseDateGroups: []
        };
    },

    methods: {
        getCouseDatesGroupedByWeekend() {
            axios.get('/api/course-dates?group_by=weekend&scopes[]=future')
                .then(response => {
                    this.courseDateGroups = response.data.data;
                });
        }
    },

    mounted() {
        this.getCouseDatesGroupedByWeekend();
    }
}
</script>

<style>

</style>