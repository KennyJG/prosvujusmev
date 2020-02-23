<template>
    <div class="h-screen w-full bg-gray-100">
        <div class="font-sans bg-gray-400er flex flex-col min-h-screen w-full">
            <div class="w-full pt-4 pb-8 pr-4">
                <div class="bg-white border-t border-b sm:border-l sm:border-r sm:rounded shadow mb-4">
                    <div class="border-b px-6">
                        <div class="flex justify-between -mb-px">
                            <div class="hidden lg:flex text-gray-600 ">
                                <button @click="activeTab = 'GENERAL'" :class="{'border-blue-600 text-blue-600 hover:border-blue-600': activeTab == 'GENERAL'}" class="focus:outline-none appearance-none py-4 border-b border-transparent hover:border-gray-600 mr-6">Obecné</button>
                                <button @click="activeTab = 'COURSE_DATES'" :class="{'border-blue-600 text-blue-600 hover:border-blue-600': activeTab == 'COURSE_DATES'}" class="focus:outline-none appearance-none py-4 border-b border-transparent mr-6 hover:border-gray-600">Kurzy</button>
                                <button @click="activeTab = 'RESERVATIONS'" :class="{'border-blue-600 text-blue-600 hover:border-blue-600': activeTab == 'RESERVATIONS'}" class="focus:outline-none appearance-none py-4 border-b border-transparent hover:border-gray-600 mr-6">Rezervace</button>
                                <button @click="activeTab = 'LECTURERS'" :class="{'border-blue-600 text-blue-600 hover:border-blue-600': activeTab == 'LECTURERS'}" class="focus:outline-none appearance-none py-4 border-b border-transparent hover:border-gray-600 mr-6">Lektoři</button>
                                <button @click="activeTab = 'ORDERS'" :class="{'border-blue-600 text-blue-600 hover:border-blue-600': activeTab == 'ORDERS'}" class="focus:outline-none appearance-none py-4 border-b border-transparent hover:border-gray-600 mr-6">Objednávky</button>
                                <!-- <button type="button" class="appearance-none py-4 text-gray-600 border-b border-transparent hover:border-gray-600">Litecoin &middot; CA$358.24</button> -->
                            </div>
                            <div class="flex text-sm" v-if="activeTab !== 'GENERAL' && activeTab !== 'LECTURERS'">
                                <button 
                                    @click="timeRange = 'MONTH'" 
                                    type="button"
                                    :class="{'border-blue-600 hover:border-gray-600 text-blue-600': timeRange == 'MONTH'}"
                                    class="appearance-none py-4 text-gray-600 border-b border-transparent hover:border-gray-600 mr-3" 
                                    style="outline: none">Měsíc
                                </button>
                                <button 
                                    @click="timeRange = 'YEAR'" 
                                    type="button" 
                                    :class="{'border-blue-600 hover:border-gray-600 text-blue-600': timeRange == 'YEAR'}"
                                    class="appearance-none py-4 text-gray-600 border-b border-transparent hover:border-gray-600 mr-3" 
                                    style="outline: none">Rok
                                </button>
                                <!-- <button type="button" class="appearance-none py-4 text-gray-600 border-b border-transparent hover:border-gray-600 mr-3">1W</button> -->
                                <!-- <button type="button" class="appearance-none py-4 text-blue-600 border-b border-blue-600 mr-3">1M</button> -->
                                <!-- <button type="button" class="appearance-none py-4 text-gray-600 border-b border-transparent hover:border-gray-600 mr-3">1Y</button> -->
                                <!-- <button type="button" class="appearance-none py-4 text-gray-600 border-b border-transparent hover:border-gray-600">AL</button> -->
                            </div>
                        </div>
                    </div>
                    <div v-if="activeTab == 'COURSE_DATES'" class="hidden lg:flex">
                        <!-- Count of Course Dates -->
                        <div class="w-1/4 text-center py-8">
                            <div class="border-r">
                                <div class="text-gray-600er mb-2">
                                    <span v-if="timeRange == 'MONTH'" class="text-5xl">{{ countOfCourseDatesThisMonth }}</span>
                                    <span v-if="timeRange == 'YEAR'" class="text-5xl">{{ countOfCourseDatesThisYear }}</span>
                                </div>
                                <div v-if="timeRange == 'MONTH'" class="text-sm uppercase text-gray tracking-wide">Kurzů tento měsíc</div>
                                <div v-if="timeRange == 'YEAR'" class="text-sm uppercase text-gray tracking-wide">Kurzů tento rok</div>
                            </div>
                        </div>
                        <!-- Count of In progress Course Dates -->
                        <div class="w-1/4 text-center py-8">
                            <div class="border-r">
                                <div class="text-gray-600er mb-2">
                                    <span class="text-5xl">{{ countOfCourseDatesInProgress }}</span>
                                </div>
                                <div class="text-sm uppercase text-gray tracking-wide">Probíhajicí kurzy</div>
                            </div>
                        </div>
                        <!-- Count of Full Course Dates -->
                        <div class="w-1/4 text-center py-8">
                            <div class="border-r">
                                <div class="text-gray-600er mb-2">
                                    <span v-if="timeRange == 'MONTH'" class="text-5xl">{{ countOfFullCourseDatesThisMonth }}</span>
                                    <span v-if="timeRange == 'YEAR'" class="text-5xl">{{ countOfFullCourseDatesThisYear }}</span>
                                </div>
                            <div class="text-sm uppercase text-gray tracking-wide">Plně zaplněných kurzů</div>
                            </div>
                        </div>
                        <!-- Count of Completed Course Dates -->
                        <div class="w-1/4 text-center py-8">
                            <div>
                                <div class="text-gray-600er mb-2">
                                    <span v-if="timeRange == 'MONTH'" class="text-5xl">{{ countOfCompletedCourseDatesThisMonth }}</span>
                                    <span v-if="timeRange == 'YEAR'" class="text-5xl">{{ countOfCompletedCourseDatesThisYear }}</span>
                                </div>
                                <div class="text-sm uppercase text-gray tracking-wide">Dokončených kurzů</div>
                            </div>
                        </div>
                    </div>
                    <div v-if="activeTab == 'RESERVATIONS'" class="hidden lg:flex">
                        <div class="w-1/2 text-center py-8">
                            <div class="border-r">
                                <div class="text-gray-600er mb-2">
                                    <span class="text-5xl">{{ waitingForApprovementReservations.length }}</span>
                                </div>
                                <div class="text-sm uppercase text-gray tracking-wide">Rezervace čekající na schválení</div>
                            </div>
                        </div>
                        <div class="w-1/2 text-center py-8">
                            <div class="border-r">
                                <div class="text-gray-600er mb-2">
                                    <span class="text-5xl">{{ queuedReservations.length }}</span>
                                </div>
                                <div class="text-sm uppercase text-gray tracking-wide">Počet náhradníků</div>
                            </div>
                        </div>
                    </div>
                    <div v-if="activeTab == 'LECTURERS'" class="hidden lg:flex">
                        <div class="w-1/3 text-center py-8">
                            <div class="border-r">
                                <div class="text-gray-600er mb-2">
                                    <span class="text-5xl">{{ countOfCourseDatesWithLectors }}</span>
                                </div>
                                <div class="text-sm uppercase text-gray tracking-wide">Terminy s lektory</div>
                            </div>
                        </div>
                        <div class="w-1/3 text-center py-8">
                            <div class="border-r">
                                <div class="text-gray-600er mb-2">
                                    <span class="text-5xl">{{ countOfCourseDatesWithoutLectors }}</span>
                                </div>
                                <div class="text-sm uppercase text-gray tracking-wide">Terminy bez lektoru</div>
                            </div>
                        </div>
                        <div class="w-1/3 text-center py-8">
                            <div class="border-r">
                                <div class="text-gray-600er mb-2">
                                    <span v-if="countOfCourseDatesWithoutLectors == 0" class="text-5xl">100%</span>
                                    <span v-else :class="{'text-red-600': lectorsCoverage < 50}" class="text-5xl">{{ lectorsCoverage }}%</span>
                                </div>
                                <div class="text-sm uppercase text-gray tracking-wide">Pokryti kurzu lektory</div>
                            </div>
                        </div>
                    </div>
                </div>

                <dashboard-general v-if="activeTab == 'GENERAL'"></dashboard-general>
                <div v-if="activeTab == 'COURSE_DATES'" class="flex flex-wrap -mx-4">
                    <div class="w-full mb-6 lg:mb-0 lg:w-1/2 px-4 pr-2 flex flex-col text-gray-700">
                        <div class="flex flex-col bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                            <div class="border-b">
                                <div class="flex justify-between px-6 -mb-px">
                                    <div @click="activeDetailsTab = 'COURSE_DATES_REMAINING_BY_VENUE'" :class="{'text-blue-600': activeDetailsTab == 'COURSE_DATES_REMAINING_BY_VENUE'}" class="py-4 px-2 font-normal cursor-pointer hover:text-gray-500">Zaplnění termínu podle místa</div>
                                    <div @click="activeDetailsTab = 'COURSE_DATES_FULL_BY_VENUE'" :class="{'text-blue-600': activeDetailsTab == 'COURSE_DATES_FULL_BY_VENUE'}" class="py-4 px-2 font-normal cursor-pointer hover:text-gray-500">Plných termínu podle místa</div>
                                    <div @click="activeDetailsTab = 'COURSE_DATES_REMAINING_BY_MONTH'" :class="{'text-blue-600': activeDetailsTab == 'COURSE_DATES_REMAINING_BY_MONTH'}" class="py-4 abnfpx-2 font-normal cursor-pointer hover:text-gray-500">Zbývajicí míst v měsících</div>
                                    <div @click="activeDetailsTab = 'COURSE_DATES_FULL_BY_MONTH'" :class="{'text-blue-600': activeDetailsTab == 'COURSE_DATES_FULL_BY_MONTH'}" class="py-4 px-2 font-normal cursor-pointer hover:text-gray-500">Plné kurzy v měsících</div>
                                    <!-- <div class="flex">
                                        <button type="button" class="appearance-none py-4 text-blue-600 border-b border-blue-600 mr-3">List</button>
                                        <button type="button" class="appearance-none py-4 text-gray-600 border-b border-transparent hover:border-gray-600">Chart</button>
                                    </div> -->
                                </div>
                            </div>

                            <div v-if="activeDetailsTab == 'COURSE_DATES_REMAINING_BY_VENUE' && timeRange == 'MONTH'">
                                <div v-for="(stats, venue) in spotTakenCourseDateStatsThisMonth" class="flex px-6 py-6 text-gray-600er items-center border-b -mx-4">
                                    <div class="w-1/2">
                                        <div class="px-4">{{ venue }}</div>
                                    </div>
                                    <div class="flex w-3/5">
                                        <div class="w-1/2 px-4">
                                            <div class="text-right">{{ stats.spotsTaken }}/{{ stats.limit }}</div>
                                        </div>
                                        <div class="w-1/2 px-4">
                                            <div :class="{'text-red-600': stats.percent >= 75}" class="text-right text-gray font-bold">{{ stats.percent }}%</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-6 py-4">
                                    <div :class="{'text-red-600': spotTakenCourseDateTotalStatsThisMonth.percent >= 75}" class="text-center text-gray font-bold">
                                        Celkově {{ spotTakenCourseDateTotalStatsThisMonth.spotsTaken }}/{{ spotTakenCourseDateTotalStatsThisMonth.limit }} → {{ spotTakenCourseDateTotalStatsThisMonth.percent }}%
                                    </div>
                                </div>
                            </div>
                            <div v-if="activeDetailsTab == 'COURSE_DATES_REMAINING_BY_VENUE' && timeRange == 'YEAR'">
                                <div v-for="(stats, venue) in spotTakenCourseDateStatsThisYear" class="flex px-6 py-6 text-gray-600er items-center border-b -mx-4">
                                    <div class="w-1/2">
                                        <div class="px-4">{{ venue }}</div>
                                    </div>
                                    <div class="flex w-3/5">
                                        <div class="w-1/2 px-4">
                                            <div class="text-right">{{ stats.spotsTaken }}/{{ stats.limit }}</div>
                                        </div>
                                        <div class="w-1/2 px-4">
                                            <div :class="{'text-red-600': stats.percent >= 75}" class="text-right text-gray font-bold">{{ stats.percent }}%</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-6 py-4">
                                    <div :class="{'text-red-600': spotTakenCourseDateTotalStatsThisYear.percent >= 75}" class="text-center text-gray font-bold">
                                        Celkově {{ spotTakenCourseDateTotalStatsThisYear.spotsTaken }}/{{ spotTakenCourseDateTotalStatsThisYear.limit }} → {{ spotTakenCourseDateTotalStatsThisYear.percent }}%
                                    </div>
                                </div>
                            </div>

                            <div v-if="activeDetailsTab == 'COURSE_DATES_FULL_BY_VENUE' && timeRange == 'MONTH'">
                                <div v-for="(stats, venue) in fullCourseDateStatsThisMonth" class="flex px-6 py-6 text-gray-600er items-center border-b -mx-4">
                                    <div class="w-1/2">
                                        <div class="px-4">{{ venue }}</div>
                                    </div>
                                    <div class="flex w-3/5">
                                        <div class="w-1/2 px-4">
                                            <div class="text-right">{{ stats.full }}/{{ stats.all }}</div>
                                        </div>
                                        <div class="w-1/2 px-4">
                                            <div :class="{'text-red-600': stats.percent >= 75}" class="text-right text-gray font-bold">{{ stats.percent }}%</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-6 py-4">
                                    <div :class="{'text-red-600': fullCourseDateTotalStatsThisMonth.percent >= 75}" class="text-center text-gray font-bold">
                                        Celkově {{ fullCourseDateTotalStatsThisMonth.full }}/{{ fullCourseDateTotalStatsThisMonth.all }} → {{ fullCourseDateTotalStatsThisMonth.percent }}%
                                    </div>
                                </div>
                            </div>
                            <div v-if="activeDetailsTab == 'COURSE_DATES_FULL_BY_VENUE' && timeRange == 'YEAR'">
                                <div v-for="(stats, venue) in fullCourseDateStatsThisYear" class="flex px-6 py-6 text-gray-600er items-center border-b -mx-4">
                                    <div class="w-1/2">
                                        <div class="px-4">{{ venue }}</div>
                                    </div>
                                    <div class="flex w-3/5">
                                        <div class="w-1/2 px-4">
                                            <div class="text-right">{{ stats.full }}/{{ stats.all }}</div>
                                        </div>
                                        <div class="w-1/2 px-4">
                                            <div :class="{'text-red-600': stats.percent >= 75}" class="text-right text-gray font-bold">{{ stats.percent }}%</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-6 py-4">
                                    <div :class="{'text-red-600': fullCourseDateTotalStatsThisYear.percent >= 75}" class="text-center text-gray font-bold">
                                        Celkově {{ fullCourseDateTotalStatsThisYear.full }}/{{ fullCourseDateTotalStatsThisYear.all }} → {{ fullCourseDateTotalStatsThisYear.percent }}%
                                    </div>
                                </div>
                            </div>

                            <div v-if="activeDetailsTab == 'COURSE_DATES_REMAINING_BY_MONTH'">
                                <div v-for="(stats, monthName) in remainingCourseDateSpotsStatsInMonths" class="flex px-6 py-6 text-gray-600er items-center border-b -mx-4">
                                    <div class="w-1/2">
                                        <div class="px-4">{{ monthName }}</div>
                                    </div>
                                    <div class="flex w-3/5">
                                        <div class="w-1/2 px-4">
                                            <div class="text-right">{{ stats.remaining }}/{{ stats.all }}</div>
                                        </div>
                                        <div class="w-1/2 px-4">
                                            <div :class="{'text-red-600': stats.percent <= 25}" class="text-right text-gray font-bold">{{ stats.percent }}%</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-6 py-4">
                                    <div :class="{'text-red-600': remainingCourseDateSpotsTotalStatsInMonths.percent <= 25}" class="text-center text-gray font-bold">
                                        Celkově {{ remainingCourseDateSpotsTotalStatsInMonths.remaining }}/{{ remainingCourseDateSpotsTotalStatsInMonths.all }} → {{ remainingCourseDateSpotsTotalStatsInMonths.percent }}%
                                    </div>
                                </div>
                            </div>

                            <div v-if="activeDetailsTab == 'COURSE_DATES_FULL_BY_MONTH'">
                                <div v-for="(stats, monthName) in fullCourseDatesStatsInMonths" class="flex px-6 py-6 text-gray-600er items-center border-b -mx-4">
                                    <div class="w-1/2">
                                        <div class="px-4">{{ monthName }}</div>
                                    </div>
                                    <div class="flex w-3/5">
                                        <div class="w-1/2 px-4">
                                            <div class="text-right">{{ stats.full }}/{{ stats.all }}</div>
                                        </div>
                                        <div class="w-1/2 px-4">
                                            <div :class="{'text-red-600': stats.percent >= 75}" class="text-right text-gray font-bold">{{ stats.percent }}%</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-6 py-4">
                                    <div :class="{'text-red-600': fullCourseDatesTotalStatsInMonths.percent >= 75}" class="text-center text-gray font-bold">
                                        Celkově {{ fullCourseDatesTotalStatsInMonths.full }}/{{ fullCourseDatesTotalStatsInMonths.all }} → {{ fullCourseDatesTotalStatsInMonths.percent }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2 pl-2 px-4">
                        <div v-if="activeDetailsTab == 'COURSE_DATES_REMAINING_BY_VENUE' && timeRange == 'MONTH'" class="bg-white border-t border-b sm:rounded sm:border shadow p-4">
                            <doughnut-chart key="spotTakenCourseDateStatsVenuesThisMonth" :chartdata="{
                                labels: spotTakenCourseDateStatsVenuesThisMonth,
                                datasets: [
                                    {
                                        label: 'Zaplnění termínu podle místa',
                                        backgroundColor: ['#44337A', '#553C9A', '#6B46C1', '#805AD5', '#9F7AEA', '#B794F4', '#D6BCFA', '#E9D8FD', '#FAF5FF', '#3C366B', '#434190', '#4C51BF', '#5A67D8', '#667EEA', '#7F9CF5', '#A3BFFA', '#C3DAFE', '#EBF4FF', '#2A4365', '#2C5282', '#2B6CB0', '#3182CE', '#4299E1', '#63B3ED', '#90CDF4', '#BEE3F8', '#EBF8FF', '#234E52'],
                                        data: spotTakenCourseDateStatsSpotTakenCountThisMonth
                                    }
                                ]
                            }"></doughnut-chart>
                        </div>
                        <div v-if="activeDetailsTab == 'COURSE_DATES_REMAINING_BY_VENUE' && timeRange == 'YEAR'" class="bg-white border-t border-b sm:rounded sm:border shadow p-4">
                            <doughnut-chart key="spotTakenCourseDateStatsVenuesThisYear" :chartdata="{
                                labels: spotTakenCourseDateStatsVenuesThisYear,
                                datasets: [
                                    {
                                        label: 'Zaplnění termínu podle místa',
                                        backgroundColor: ['#44337A', '#553C9A', '#6B46C1', '#805AD5', '#9F7AEA', '#B794F4', '#D6BCFA', '#E9D8FD', '#FAF5FF', '#3C366B', '#434190', '#4C51BF', '#5A67D8', '#667EEA', '#7F9CF5', '#A3BFFA', '#C3DAFE', '#EBF4FF', '#2A4365', '#2C5282', '#2B6CB0', '#3182CE', '#4299E1', '#63B3ED', '#90CDF4', '#BEE3F8', '#EBF8FF', '#234E52'],
                                        data: spotTakenCourseDateStatsSpotTakenCountThisYear
                                    }
                                ]
                            }"></doughnut-chart>
                        </div>

                        <div v-if="activeDetailsTab == 'COURSE_DATES_FULL_BY_VENUE' && timeRange == 'MONTH'" class="bg-white border-t border-b sm:rounded sm:border shadow p-4">
                            <doughnut-chart key="fullCourseDateStatsVenuesThisMonth" :chartdata="{
                                labels: fullCourseDateStatsVenuesThisMonth,
                                datasets: [
                                    {
                                        label: 'Zaplnění termínu podle místa',
                                        backgroundColor: ['#44337A', '#553C9A', '#6B46C1', '#805AD5', '#9F7AEA', '#B794F4', '#D6BCFA', '#E9D8FD', '#FAF5FF', '#3C366B', '#434190', '#4C51BF', '#5A67D8', '#667EEA', '#7F9CF5', '#A3BFFA', '#C3DAFE', '#EBF4FF', '#2A4365', '#2C5282', '#2B6CB0', '#3182CE', '#4299E1', '#63B3ED', '#90CDF4', '#BEE3F8', '#EBF8FF', '#234E52'],
                                        data: fullCourseDateStatsFullCountThisMonth
                                    }
                                ]
                            }"></doughnut-chart>
                        </div>
                        <div v-if="activeDetailsTab == 'COURSE_DATES_FULL_BY_VENUE' && timeRange == 'YEAR'" class="bg-white border-t border-b sm:rounded sm:border shadow p-4">
                            <doughnut-chart key="fullCourseDateStatsVenuesThisYear" :chartdata="{
                                labels: fullCourseDateStatsVenuesThisYear,
                                datasets: [
                                    {
                                        label: 'Zaplnění termínu podle místa',
                                        backgroundColor: ['#44337A', '#553C9A', '#6B46C1', '#805AD5', '#9F7AEA', '#B794F4', '#D6BCFA', '#E9D8FD', '#FAF5FF', '#3C366B', '#434190', '#4C51BF', '#5A67D8', '#667EEA', '#7F9CF5', '#A3BFFA', '#C3DAFE', '#EBF4FF', '#2A4365', '#2C5282', '#2B6CB0', '#3182CE', '#4299E1', '#63B3ED', '#90CDF4', '#BEE3F8', '#EBF8FF', '#234E52'],
                                        data: fullCourseDateStatsFullCountThisYear
                                    }
                                ]
                            }"></doughnut-chart>
                        </div>
 
                        <div v-if="activeDetailsTab == 'COURSE_DATES_REMAINING_BY_MONTH'" class="bg-white border-t border-b sm:rounded sm:border shadow p-4">
                            <doughnut-chart key="remainingCourseDateSpotsStatsMonthsInMonth" :chartdata="{
                                labels: remainingCourseDateSpotsStatsMonthsInMonth,
                                datasets: [
                                    {
                                        label: 'Zbývajicí míst v měsících',
                                        backgroundColor: ['#44337A', '#553C9A', '#6B46C1', '#805AD5', '#9F7AEA', '#B794F4', '#D6BCFA', '#E9D8FD', '#FAF5FF', '#3C366B', '#434190', '#4C51BF', '#5A67D8', '#667EEA', '#7F9CF5', '#A3BFFA', '#C3DAFE', '#EBF4FF', '#2A4365', '#2C5282', '#2B6CB0', '#3182CE', '#4299E1', '#63B3ED', '#90CDF4', '#BEE3F8', '#EBF8FF', '#234E52'],
                                        data: remainingCourseDateSpotsRemainingCountInMonth
                                    }
                                ]
                            }"></doughnut-chart>
                        </div>

                        <div v-if="activeDetailsTab == 'COURSE_DATES_FULL_BY_MONTH'" class="bg-white border-t border-b sm:rounded sm:border shadow p-4">
                            <doughnut-chart key="fullCourseDatesStatsMonthsInMonths" :chartdata="{
                                labels: fullCourseDatesStatsMonthsInMonths,
                                datasets: [
                                    {
                                        label: 'Plné kurzy v měsících',
                                        backgroundColor: ['#44337A', '#553C9A', '#6B46C1', '#805AD5', '#9F7AEA', '#B794F4', '#D6BCFA', '#E9D8FD', '#FAF5FF', '#3C366B', '#434190', '#4C51BF', '#5A67D8', '#667EEA', '#7F9CF5', '#A3BFFA', '#C3DAFE', '#EBF4FF', '#2A4365', '#2C5282', '#2B6CB0', '#3182CE', '#4299E1', '#63B3ED', '#90CDF4', '#BEE3F8', '#EBF8FF', '#234E52'],
                                        data: fullCourseDatesStatsFullCountInMonths
                                    }
                                ]
                            }"></doughnut-chart>
                        </div>
                    </div>
                </div>
                <div v-if="activeTab == 'RESERVATIONS'" class="flex flex-wrap -mx-4">
                  <div class="w-full mb-6 lg:mb-0 lg:w-1/2 px-4 pr-2 flex flex-col text-gray-700">
                      <div class="flex flex-col bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                          <div class="border-b">
                              <div class="flex justify-between px-6 -mb-px">
                                  <div class="py-4 px-2 font-normal cursor-pointer text-blue-600">Rezervace čekající na schválení</div>
                              </div>
                          </div>
                          <div>
                            <a :href="'/admin/reservations/' + reservation.id" v-for="reservation in waitingForApprovementReservations" class="flex px-6 py-6 text-gray-600er items-center border-b -mx-4 hover:bg-gray-100 cursor-pointer">
                                <div class="w-1/2">
                                    <div class="px-4">{{ reservation.id }}</div>
                                </div>
                                <div class="flex w-3/5">
                                    <div class="w-1/2 px-4">
                                        <div class="text-right font-bold">{{ reservation.source_code }}</div>
                                    </div>
                                    <div class="w-1/2 px-4">
                                        <div class="text-right text-gray">{{ reservation.source_type }}</div>
                                    </div>
                                </div>
                            </a>
                          </div>
                      </div>
                  </div>
                  <div class="w-full mb-6 lg:mb-0 lg:w-1/2 px-4 pr-2 flex flex-col text-gray-700">
                      <div class="flex flex-col bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                          <div class="border-b">
                              <div class="flex justify-between px-6 -mb-px">
                                  <div class="py-4 px-2 font-normal cursor-pointer text-blue-600">Rezervace náhradníků</div>
                              </div>
                          </div>
                          <div>
                            <a :href="'/admin/reservations/' + reservation.id" v-for="reservation in queuedReservations" class="flex px-6 py-6 text-gray-600er items-center border-b -mx-4 hover:bg-gray-100 cursor-pointer">
                                <div class="w-1/2">
                                    <div class="px-4">{{ reservation.id }}</div>
                                </div>
                                <div class="flex w-3/5">
                                    <div class="w-1/2 px-4">
                                        <div class="text-right font-bold">{{ reservation.source_code }}</div>
                                    </div>
                                    <div class="w-1/2 px-4">
                                        <div class="text-right text-gray">{{ reservation.source_type }}</div>
                                    </div>
                                </div>
                            </a>
                          </div>
                      </div>
                  </div>
                </div>
                <dashboard-lecturer v-if="activeTab == 'LECTURERS'"></dashboard-lecturer>
            </div>
            <!-- <div class="bg-white border-t">
                <div class="container mx-auto px-4">
                    <div class="md:flex justify-between items-center text-sm">
                        <div class="text-center md:text-left py-3 md:py-4 border-b md:border-b-0">
                            <a href="#" class="no-underline text-gray-600 mr-4">Home</a>
                            <a href="#" class="no-underline text-gray-600 mr-4">Careers</a>
                            <a href="#" class="no-underline text-gray-600">Legal &amp; Privacy</a>
                        </div>
                        <div class="md:flex md:flex-row-reverse items-center py-4">
                            <div class="text-center mb-4 md:mb-0 md:flex">
                                <div class="w-48 inline-block relative mb-4 md:mb-0 md:mr-4">
                                    <select class="leading-tight block appearance-none w-full bg-white border border-gray-400 px-3 py-2 pr-8 rounded">
                                        <option>English</option>
                                    </select>
                                    <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-gray">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="inline-block leading-tight bg-blue border border-blue-600 hover:bg-blue-600 px-3 py-2 text-white no-underline rounded">Need help?</a>
                                </div>
                            </div>
                            <div class="text-gray text-center md:mr-4">&copy; 2017 Cointoad</div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            stats: {},

            timeRange: 'MONTH', // YEAR
            activeTab: 'GENERAL', // RESERVATIIONS, LECTURERS
            activeDetailsTab: 'COURSE_DATES_REMAINING_BY_VENUE', //COURSE_DATES_FULL_BY_VENUE, COURSE_DATES_REMAINING_BY_MONTH, COURSE_DATES_FULL_BY_MONTH

            countOfCourseDatesThisMonth: null,
            countOfCourseDatesThisYear: null,
            countOfCourseDatesInProgress: null,
            countOfFullCourseDatesThisMonth: null,
            countOfFullCourseDatesThisYear: null,
            countOfCompletedCourseDatesThisMonth: null,
            countOfCompletedCourseDatesThisYear: null,

            waitingForApprovementReservations: [],
            queuedReservations: [],

            spotTakenCourseDateStatsThisMonth: [],
            spotTakenCourseDateTotalStatsThisMonth: null,

            spotTakenCourseDateStatsThisYear: [],
            spotTakenCourseDateTotalStatsThisYear: null,

            fullCourseDateStatsThisMonth: [],
            fullCourseDateTotalStatsThisMonth: null,
                    
            fullCourseDateStatsThisYear: [],
            fullCourseDateTotalStatsThisYear: null,

            remainingCourseDateSpotsStatsInMonths: [],
            remainingCourseDateSpotsTotalStatsInMonths: null,

            fullCourseDatesStatsInMonths: [],
            fullCourseDatesTotalStatsInMonths: null,

            countOfCourseDatesWithLectors: 0,
            countOfCourseDatesWithoutLectors: 0,
            countOfCourseDates: 0,
            lectorsCoverage: 0,
        }
    },

    computed: {
        spotTakenCourseDateStatsVenuesThisMonth() {
            return Object.keys(this.spotTakenCourseDateStatsThisMonth);
        },

        spotTakenCourseDateStatsSpotTakenCountThisMonth() {
            return Object.keys(this.spotTakenCourseDateStatsThisMonth).map(key => {
                return this.spotTakenCourseDateStatsThisMonth[key].spotsTaken;
            });
        },

        spotTakenCourseDateStatsVenuesThisYear() {
            return Object.keys(this.spotTakenCourseDateStatsThisYear);
        },

        spotTakenCourseDateStatsSpotTakenCountThisYear() {
            return Object.keys(this.spotTakenCourseDateStatsThisYear).map(key => {
                return this.spotTakenCourseDateStatsThisYear[key].spotsTaken;
            });
        },

        fullCourseDateStatsVenuesThisMonth() {
            return Object.keys(this.fullCourseDateStatsThisMonth);
        },

        fullCourseDateStatsFullCountThisMonth() {
            return Object.keys(this.fullCourseDateStatsThisMonth).map(key => {
                return this.fullCourseDateStatsThisMonth[key].full;
            });
        },

        fullCourseDateStatsVenuesThisYear() {
            return Object.keys(this.fullCourseDateStatsThisYear);
        },

        fullCourseDateStatsFullCountThisYear() {
            return Object.keys(this.fullCourseDateStatsThisYear).map(key => {
                return this.fullCourseDateStatsThisYear[key].full;
            });
        },

        remainingCourseDateSpotsStatsMonthsInMonth() {
            return Object.keys(this.remainingCourseDateSpotsStatsInMonths);
        },

        remainingCourseDateSpotsRemainingCountInMonth() {
            return Object.keys(this.remainingCourseDateSpotsStatsInMonths).map(key => {
                return this.remainingCourseDateSpotsStatsInMonths[key].remaining;
            });
        },

        fullCourseDatesStatsMonthsInMonths() {
            return Object.keys(this.fullCourseDatesStatsInMonths);
        },

        fullCourseDatesStatsFullCountInMonths() {
            return Object.keys(this.fullCourseDatesStatsInMonths).map(key => {
                return this.fullCourseDatesStatsInMonths[key].full;
            });
        },
    },

    methods: {
        getStats() {
            axios.get('/admin/stats')
                .then((response) => {
                    this.countOfCourseDatesThisMonth = response.data.data.countOfCourseDatesThisMonth;
                    this.countOfCourseDatesThisYear = response.data.data.countOfCourseDatesThisYear;
                    this.countOfCourseDatesInProgress = response.data.data.countOfCourseDatesInProgress;
                    this.countOfFullCourseDatesThisMonth = response.data.data.countOfFullCourseDatesThisMonth;
                    this.countOfFullCourseDatesThisYear = response.data.data.countOfFullCourseDatesThisYear;
                    this.countOfCompletedCourseDatesThisMonth = response.data.data.countOfCompletedCourseDatesThisMonth;
                    this.countOfCompletedCourseDatesThisYear = response.data.data.countOfCompletedCourseDatesThisYear;

                    this.waitingForApprovementReservations = response.data.data.waitingForApprovementReservations;
                    this.queuedReservations = response.data.data.queuedReservations;

                    this.spotTakenCourseDateStatsThisMonth = response.data.data.spotTakenCourseDateStatsThisMonth.data;
                    this.spotTakenCourseDateTotalStatsThisMonth = response.data.data.spotTakenCourseDateStatsThisMonth.total; 

                    this.spotTakenCourseDateStatsThisYear = response.data.data.spotTakenCourseDateStatsThisYear.data;
                    this.spotTakenCourseDateTotalStatsThisYear = response.data.data.spotTakenCourseDateStatsThisYear.total; 
                    
                    this.fullCourseDateStatsThisMonth = response.data.data.fullCourseDatesStatsThisMonth.data;
                    this.fullCourseDateTotalStatsThisMonth = response.data.data.fullCourseDatesStatsThisMonth.total; 

                    this.fullCourseDateStatsThisYear = response.data.data.fullCourseDatesStatsThisYear.data;
                    this.fullCourseDateTotalStatsThisYear = response.data.data.fullCourseDatesStatsThisYear.total; 

                    this.remainingCourseDateSpotsStatsInMonths = response.data.data.remainingCourseDateSpotsStatsInMonths.data;
                    this.remainingCourseDateSpotsTotalStatsInMonths = response.data.data.remainingCourseDateSpotsStatsInMonths.total; 

                    this.fullCourseDatesStatsInMonths = response.data.data.fullCourseDatesStatsInMonths.data;
                    this.fullCourseDatesTotalStatsInMonths = response.data.data.fullCourseDatesStatsInMonths.total;

                    this.countOfCourseDatesWithLectors = response.data.data.countOfCourseDatesWithLectors;
                    this.countOfCourseDatesWithoutLectors = response.data.data.countOfCourseDatesWithoutLectors;
                    this.countOfCourseDates = response.data.data.countOfCourseDates;
                    this.lectorsCoverage = response.data.data.lectorsCoverage;
                });
        }
    },

    mounted() {
        this.getStats();
    }
}
</script>

<style>

</style>