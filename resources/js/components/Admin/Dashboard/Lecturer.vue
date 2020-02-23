<template>
    <div class="flex">
        <div class="flex flex-wrap w-3/5">
            <div v-if="lecturer != null && lecturer != ''" v-for="(monthStats, lecturer) in lecturers" class="w-1/3 mb-4 text-gray-700 px-2">
                <div class="w-full bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                    <div>
                        <div class="border-b">
                            <div class="flex justify-between px-3 -mb-px">
                                <div class="py-3 px-2 font-normal text-blue-600">{{ lecturer }}</div>
                            </div>
                        </div>
                        <div v-for="(countOfCourseDatesInMonth, month)  in monthStats" class="flex px-6 py-2 text-gray-600er items-center border-b -mx-4 course-pointer hover:bg-gray-200">
                            <div class="w-1/2">
                                <div class="px-4">{{ month }}</div>
                            </div>
                            <div class="w-1/2 text-right">
                                <div class="px-4">{{ countOfCourseDatesInMonth }} / {{ getCourseDatesCountInMonth(month) }} ({{ getLecturerCoverageOfMonthCourseDates(lecturer, month) }}%)</div>
                            </div>
                        </div>
                        <div class="px-6 py-2 flex font-bold">
                            <div class="w-full py-4">
                                <div class="text-center text-gray font-bold">
                                    Celkově {{ getLecturerCourseDatesCount(lecturer) }} / {{ getCourseDatesCount() }} ({{ getLecturerCoverageOfCourseDates(lecturer) }}%)
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="lecturer == '' || lecturer == null" v-for="(monthStats, lecturer) in lecturers" class="w-2/5 mb-4 text-gray-700 px-2">
            <div class="w-full bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                <div>
                    <div class="border-b">
                        <div class="flex justify-between px-3 -mb-px">
                            <div class="py-3 px-2 font-normal text-red-600">Bez lektora</div>
                        </div>
                    </div>
                    <div v-for="(countOfCourseDatesInMonth, month)  in monthStats" class="flex px-6 py-2 text-gray-600er items-center border-b -mx-4 course-pointer hover:bg-gray-200">
                        <div class="w-1/2">
                            <div class="px-4">{{ month }}</div>
                        </div>
                        <div class="w-1/2 text-right">
                            <div class="px-4">{{ countOfCourseDatesInMonth }} / {{ getCourseDatesCountInMonth(month) }} ({{ getLecturerCoverageOfMonthCourseDates(lecturer, month) }}%)</div>
                        </div>
                    </div>
                    <div class="px-6 py-2 flex font-bold">
                        <div class="w-full py-4">
                            <div class="text-center text-gray font-bold">
                                Celkově {{ getLecturerCourseDatesCount(lecturer) }} / {{ getCourseDatesCount() }} ({{ getLecturerCoverageOfCourseDates(lecturer) }}%)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            lecturers: [],
            courseDateGroupedByMonth: [],
        }
    },

    methods: {
        getCourseDates() {
            axios.get('/api/course-dates?group_by=month&scopes[]=future')
                .then(response => {
                    this.courseDateGroupedByMonth = response.data.data;
                });
        },

        getLecturers() {
            axios.get('/admin/lecturers')
                .then(response => {
                    this.lecturers = response.data.data;
                });
        },

        getLecturerCourseDatesCount(lecturerName) {
            let lecturerMonths = this.lecturers[lecturerName];
            let courseDatesCount = 0;
            Object.keys(lecturerMonths).forEach(month => {
                courseDatesCount += lecturerMonths[month];
            });
            return courseDatesCount;
        },

        getLecturerCoverageOfMonthCourseDates(lecturerName, month) {
            return this.lecturers[lecturerName][month] / this.getCourseDatesCountInMonth(month) * 100;
        },

        getCourseDatesCountInMonth(month) {
            return this.courseDateGroupedByMonth[month].length;
        },

        getCourseDatesCount() {
            let courseDatesCount = 0;
            Object.keys(this.courseDateGroupedByMonth).forEach(month => {
                courseDatesCount += this.courseDateGroupedByMonth[month].length;
            });
            return courseDatesCount;
        },

        getLecturerCoverageOfCourseDates(lecturerName) {
            return this.getLecturerCourseDatesCount(lecturerName) / this.getCourseDatesCount() * 100;
        },
    },

    mounted() {
        this.getCourseDates();
        this.getLecturers();
    }
}
</script>

<style>

</style>