<template>
    <div class="flex flex-wrap">
        <div class="w-1/2 mb-4 text-gray-700 pr-2">
            <div class="w-full bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                <div>
                    <div class="border-b">
                        <div class="flex justify-between px-3 -mb-px">
                            <div class="py-3 px-2 font-normal">Počet účastníků podle místa</div>
                        </div>
                    </div>
                    <div v-for="(attendees, venue) in attendeesGroupedByVenues" class="flex px-6 py-2 text-gray-600er items-center border-b -mx-4 course-pointer hover:bg-gray-200">
                        <div class="w-1/2">
                            <div class="px-4">{{ venue }}</div>
                        </div>
                        <div class="w-1/2 text-right">
                            <div class="px-4">{{ attendees.length }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-1/2 mb-4 text-gray-700 pl-2">
            <div class="bg-white border-t border-b sm:rounded sm:border shadow p-4">
                <doughnut-chart v-if="countOfAttendeesByVenue.length != 0" ref="venue-chart" key="venues" :chartdata="{
                    labels: venues,
                    datasets: [
                        {
                            label: 'Počet účastníků podle místa',
                            backgroundColor: ['#44337A', '#553C9A', '#6B46C1', '#805AD5', '#9F7AEA', '#B794F4', '#D6BCFA', '#E9D8FD', '#FAF5FF', '#3C366B', '#434190', '#4C51BF', '#5A67D8', '#667EEA', '#7F9CF5', '#A3BFFA', '#C3DAFE', '#EBF4FF', '#2A4365', '#2C5282', '#2B6CB0', '#3182CE', '#4299E1', '#63B3ED', '#90CDF4', '#BEE3F8', '#EBF8FF', '#234E52'],
                            data: countOfAttendeesByVenue
                        }
                    ]
                }"></doughnut-chart>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            attendeesGroupedByVenues: [],
        }
    },

    computed: {
        venues() {
            return Object.keys(this.attendeesGroupedByVenues);
        },

        countOfAttendeesByVenue() {
            let countOfAttendees = [];
            Object.keys(this.attendeesGroupedByVenues).forEach(venue => {
                countOfAttendees.push(this.attendeesGroupedByVenues[venue].length);
            });
            return countOfAttendees;
        }
    },

    methods: {
        getAttendessGroupedByVenues() {
            axios.get('/admin/attendees?group_by=venues')
                .then(response => {
                    this.attendeesGroupedByVenues = response.data.data;
                });
        },
    },

    mounted() {
        this.getAttendessGroupedByVenues();
    }
}
</script>

<style>

</style>