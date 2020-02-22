<template>
    <div class="h-screen w-full bg-gray-100">
        <div class="font-sans bg-gray-400er flex flex-col min-h-screen w-full">
            <div class="flex-grow w-full pt-4 pb-8 pr-4">
                <div class="bg-white border-t border-b sm:border-l sm:border-r sm:rounded shadow mb-4">
                    <div class="border-b px-6">
                        <div class="flex justify-between -mb-px">
                            <div class="hidden lg:flex text-gray-600 ">
                                <button @click="activeTab = 'COURSE_DATES'" :class="{'border-blue-600 text-blue-600 hover:border-blue-600': activeTab == 'COURSE_DATES'}" class="focus:outline-none appearance-none py-4 border-b border-transparent mr-6 hover:border-gray-600">Kurzy</button>
                                <button @click="activeTab = 'RESERVATIONS'" :class="{'border-blue-600 text-blue-600 hover:border-blue-600': activeTab == 'RESERVATIONS'}" class="focus:outline-none appearance-none py-4 border-b border-transparent hover:border-gray-600 mr-6">Rezervace</button>
                                <!-- <button type="button" class="appearance-none py-4 text-gray-600 border-b border-transparent hover:border-gray-600">Litecoin &middot; CA$358.24</button> -->
                            </div>
                            <div class="flex text-sm">
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
                                    <span v-if="timeRange == 'MONTH'" class="text-5xl">{{ courseDatesThisMonth }}</span>
                                    <span v-if="timeRange == 'YEAR'" class="text-5xl">{{ courseDatesThisYear }}</span>
                                </div>
                                <div class="text-sm uppercase text-gray tracking-wide">Kurzů tento měsíc</div>
                            </div>
                        </div>
                        <!-- Count of In progress Course Dates -->
                        <div class="w-1/4 text-center py-8">
                            <div class="border-r">
                                <div class="text-gray-600er mb-2">
                                    <span class="text-5xl">{{ courseDatesInProgress }}</span>
                                </div>
                                <div class="text-sm uppercase text-gray tracking-wide">Probíhajicí kurzy</div>
                            </div>
                        </div>
                        <!-- Count of Full Course Dates -->
                        <div class="w-1/4 text-center py-8">
                            <div class="border-r">
                                <div class="text-gray-600er mb-2">
                                    <span v-if="timeRange == 'MONTH'" class="text-5xl">{{ fullCourseDatesThisMonth }}</span>
                                    <span v-if="timeRange == 'YEAR'" class="text-5xl">{{ fullCourseDatesThisYear }}</span>
                                </div>
                            <div class="text-sm uppercase text-gray tracking-wide">Plně zaplněných kurzů</div>
                            </div>
                        </div>
                        <div class="w-1/4 text-center py-8">
                            <div>
                                <div class="text-gray-600er mb-2">
                                    <span class="text-5xl">8</span>
                                </div>
                                <div class="text-sm uppercase text-gray tracking-wide">Dokončených kurzů</div>
                            </div>
                        </div>
                    </div>
                    <div v-if="activeTab == 'RESERVATIONS'" class="hidden lg:flex">
                        <div class="w-1/2 text-center py-8">
                            <div class="border-r">
                                <div class="text-gray-600er mb-2">
                                    <span class="text-5xl">{{ stats.reservationsWaitingForApprovement.length }}</span>
                                </div>
                                <div class="text-sm uppercase text-gray tracking-wide">Rezervace čekající na schválení</div>
                            </div>
                        </div>
                        <div class="w-1/2 text-center py-8">
                            <div class="border-r">
                                <div class="text-gray-600er mb-2">
                                    <span class="text-5xl">{{ stats.queuedReservations.length }}</span>
                                </div>
                                <div class="text-sm uppercase text-gray tracking-wide">Počet náhradníků</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="activeTab == 'COURSE_DATES'" class="flex flex-wrap -mx-4">
                    <div class="w-full mb-6 lg:mb-0 lg:w-1/2 px-4 pr-2 flex flex-col text-gray-700">
                        <div class="flex-grow flex flex-col bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                            <div class="border-b">
                                <div class="flex justify-between px-6 -mb-px">
                                    <div @click="activeDetailsTab = 'COURSE_DATES_REMAINING_BY_VENUE'" :class="{'text-blue-600': activeDetailsTab == 'COURSE_DATES_REMAINING_BY_VENUE'}" class="py-4 px-2 font-normal cursor-pointer hover:text-gray-500">Zaplnění termínu podle místa</div>
                                    <div @click="activeDetailsTab = 'COURSE_DATES_FULL_BY_VENUE'" :class="{'text-blue-600': activeDetailsTab == 'COURSE_DATES_FULL_BY_VENUE'}" class="py-4 px-2 font-normal cursor-pointer hover:text-gray-500">Plných termínu podle místa</div>
                                    <div @click="activeDetailsTab = 'COURSE_DATES_REMAINING_BY_MONTH'" :class="{'text-blue-600': activeDetailsTab == 'COURSE_DATES_REMAINING_BY_MONTH'}" class="py-4 abnfpx-2 font-normal cursor-pointer hover:text-gray-500">Zbývajicí míst v měsícíc</div>
                                    <div @click="activeDetailsTab = 'COURSE_DATES_FULL_BY_MONTH'" :class="{'text-blue-600': activeDetailsTab == 'COURSE_DATES_FULL_BY_MONTH'}" class="py-4 px-2 font-normal cursor-pointer hover:text-gray-500">Plné kurzy v měsících</div>
                                    <!-- <div class="flex">
                                        <button type="button" class="appearance-none py-4 text-blue-600 border-b border-blue-600 mr-3">List</button>
                                        <button type="button" class="appearance-none py-4 text-gray-600 border-b border-transparent hover:border-gray-600">Chart</button>
                                    </div> -->
                                </div>
                            </div>
                            <div v-if="activeDetailsTab == 'COURSE_DATES_REMAINING_BY_VENUE'">
                              <div class="flex-grow flex px-6 py-6 text-gray-600er items-center border-b -mx-4">
                                  <div class="w-1/2">
                                      <div class="px-4">PRAHA (Komunitní centrum Hrubého, Praha 8 - Kobylisy)</div>
                                  </div>
                                  <div class="flex w-3/5">
                                      <div class="w-1/2 px-4">
                                          <div class="text-right">30/40</div>
                                      </div>
                                      <div class="w-1/2 px-4">
                                          <div class="text-right text-gray font-bold">75%</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="flex-grow flex px-6 py-6 text-gray-600er items-center border-b -mx-4">
                                  <div class="w-1/2">
                                      <div class="px-4">BRNO (Gymnázium Globe, s.r.o., Bzenecká 23, Brno)</div>
                                  </div>
                                  <div class="flex w-3/5">
                                      <div class="w-1/2 px-4">
                                          <div class="text-right">10/20</div>
                                      </div>
                                      <div class="w-1/2 px-4">
                                          <div class="text-right text-gray font-bold">50%</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="flex-grow flex px-6 py-6 text-gray-600er items-center border-b -mx-4">
                                  <div class="w-1/2">
                                      <div class="px-4">OSTRAVA (SŠ stavební a dřevozpracující, U Studia 33, Ostrava - Zábřeh) </div>
                                  </div>
                                  <div class="flex w-3/5">
                                      <div class="w-1/2 px-4">
                                          <div class="text-right">8/10</div>
                                      </div>
                                      <div class="w-1/2 px-4">
                                          <div class="text-right text-gray font-bold">80%</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="px-6 py-4">
                                  <div class="text-center text-gray font-bold">
                                      Celkově 48/70 → 68.6%
                                  </div>
                              </div>
                            </div>
                            <div v-if="activeDetailsTab == 'COURSE_DATES_FULL_BY_VENUE'">
                              <div class="flex-grow flex px-6 py-6 text-gray-600er items-center border-b -mx-4">
                                  <div class="w-1/2">
                                      <div class="px-4">PRAHA (Komunitní centrum Hrubého, Praha 8 - Kobylisy)</div>
                                  </div>
                                  <div class="flex w-3/5">
                                      <div class="w-1/2 px-4">
                                          <div class="text-right">0/4</div>
                                      </div>
                                      <div class="w-1/2 px-4">
                                          <div class="text-right text-gray font-bold">0%</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="flex-grow flex px-6 py-6 text-gray-600er items-center border-b -mx-4">
                                  <div class="w-1/2">
                                      <div class="px-4">BRNO (Gymnázium Globe, s.r.o., Bzenecká 23, Brno)</div>
                                  </div>
                                  <div class="flex w-3/5">
                                      <div class="w-1/2 px-4">
                                          <div class="text-right">2/4</div>
                                      </div>
                                      <div class="w-1/2 px-4">
                                          <div class="text-right text-gray font-bold">50%</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="flex-grow flex px-6 py-6 text-gray-600er items-center border-b -mx-4">
                                  <div class="w-1/2">
                                      <div class="px-4">OSTRAVA (SŠ stavební a dřevozpracující, U Studia 33, Ostrava - Zábřeh) </div>
                                  </div>
                                  <div class="flex w-3/5">
                                      <div class="w-1/2 px-4">
                                          <div class="text-right">1/1</div>
                                      </div>
                                      <div class="w-1/2 px-4">
                                          <div class="text-right text-gray font-bold text-red-600">100%</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="px-6 py-4">
                                  <div class="text-center text-gray font-bold">
                                      Celkově 3/9 → 33.33%
                                  </div>
                              </div>
                            </div>
                            <div v-if="activeDetailsTab == 'COURSE_DATES_REMAINING_BY_MONTH'">
                              <div class="flex-grow flex px-6 py-6 text-gray-600er items-center border-b -mx-4">
                                  <div class="w-1/2">
                                      <div class="px-4">Leden</div>
                                  </div>
                                  <div class="flex w-3/5">
                                      <div class="w-1/2 px-4">
                                          <div class="text-right">2/40</div>
                                      </div>
                                      <div class="w-1/2 px-4">
                                          <div class="text-right text-gray font-bold text-red-600">5%</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="flex-grow flex px-6 py-6 text-gray-600er items-center border-b -mx-4">
                                  <div class="w-1/2">
                                      <div class="px-4">Únor</div>
                                  </div>
                                  <div class="flex w-3/5">
                                      <div class="w-1/2 px-4">
                                          <div class="text-right">8/20</div>
                                      </div>
                                      <div class="w-1/2 px-4">
                                          <div class="text-right text-gray font-bold">40%</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="flex-grow flex px-6 py-6 text-gray-600er items-center border-b -mx-4">
                                  <div class="w-1/2">
                                      <div class="px-4">Březen</div>
                                  </div>
                                  <div class="flex w-3/5">
                                      <div class="w-1/2 px-4">
                                          <div class="text-right">20/20</div>
                                      </div>
                                      <div class="w-1/2 px-4">
                                          <div class="text-right text-gray font-bold">100%</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="px-6 py-4">
                                  <div class="text-center text-gray font-bold">
                                      Celkově 30/80 → 37.5%
                                  </div>
                              </div>
                            </div>
                            <div v-if="activeDetailsTab == 'COURSE_DATES_FULL_BY_MONTH'">
                              <div class="flex-grow flex px-6 py-6 text-gray-600er items-center border-b -mx-4">
                                  <div class="w-1/2">
                                      <div class="px-4">Leden</div>
                                  </div>
                                  <div class="flex w-3/5">
                                      <div class="w-1/2 px-4">
                                          <div class="text-right">4/5</div>
                                      </div>
                                      <div class="w-1/2 px-4">
                                          <div class="text-right text-gray font-bold">80%</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="flex-grow flex px-6 py-6 text-gray-600er items-center border-b -mx-4">
                                  <div class="w-1/2">
                                      <div class="px-4">Únor</div>
                                  </div>
                                  <div class="flex w-3/5">
                                      <div class="w-1/2 px-4">
                                          <div class="text-right">1/4</div>
                                      </div>
                                      <div class="w-1/2 px-4">
                                          <div class="text-right text-gray font-bold">25%</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="flex-grow flex px-6 py-6 text-gray-600er items-center border-b -mx-4">
                                  <div class="w-1/2">
                                      <div class="px-4">Březen</div>
                                  </div>
                                  <div class="flex w-3/5">
                                      <div class="w-1/2 px-4">
                                          <div class="text-right">0/5</div>
                                      </div>
                                      <div class="w-1/2 px-4">
                                          <div class="text-right text-gray font-bold">0%</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="px-6 py-4">
                                  <div class="text-center text-gray font-bold">
                                      Celkově 5/14 → 35.7%
                                  </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2 pl-2 px-4">
                      <div v-if="activeDetailsTab == 'COURSE_DATES_REMAINING_BY_VENUE'" class="bg-white border-t border-b sm:rounded sm:border shadow p-4">
                          <pie-chart :chartdata="{
                              labels: [
                                  'PRAHA (Komunitní centrum Hrubého, Praha 8 - Kobylisy)', 
                                  'BRNO (Gymnázium Globe, s.r.o., Bzenecká 23, Brno)',
                                  'OSTRAVA (SŠ stavební a dřevozpracující, U Studia 33, Ostrava - Zábřeh)'
                              ],
                              datasets: [
                                  {
                                      label: 'Zaplnění termínu podle místa',
                                      backgroundColor: ['#49306B', '#635380', '#90708C'],
                                      data: [30, 10, 8]
                                  }
                              ]
                          }"></pie-chart>
                      </div>
                      <div v-if="activeDetailsTab == 'COURSE_DATES_FULL_BY_VENUE'" class="bg-white border-t border-b sm:rounded sm:border shadow p-4">
                          <doughnut-chart :chartdata="{
                              labels: [
                                  'PRAHA (Komunitní centrum Hrubého, Praha 8 - Kobylisy)', 
                                  'BRNO (Gymnázium Globe, s.r.o., Bzenecká 23, Brno)',
                                  'OSTRAVA (SŠ stavební a dřevozpracující, U Studia 33, Ostrava - Zábřeh)'
                              ],
                              datasets: [
                                  {
                                      label: 'Plných termínu podle místa',
                                      backgroundColor: ['#49306B', '#635380', '#90708C'],
                                      data: [0, 2, 1]
                                  }
                              ]
                          }"></doughnut-chart>
                      </div>
                      <div v-if="activeDetailsTab == 'COURSE_DATES_REMAINING_BY_MONTH'" class="bg-white border-t border-b sm:rounded sm:border shadow p-4">
                          <line-chart :chartdata="{
                              labels: [
                                  'Leden', 
                                  'Únor',
                                  'Březen'
                              ],
                              datasets: [
                                  {
                                      label: 'Zbývajicí míst v měsících',
                                      backgroundColor: ['#49306B', '#635380', '#90708C'],
                                      data: [2, 8, 20]
                                  }
                              ]
                          }"></line-chart>
                      </div>
                      <div v-if="activeDetailsTab == 'COURSE_DATES_FULL_BY_MONTH'" class="bg-white border-t border-b sm:rounded sm:border shadow p-4">
                          <bar-chart :chartdata="{
                              labels: [
                                  'Leden', 
                                  'Únor',
                                  'Březen'
                              ],
                              datasets: [
                                  {
                                      label: 'Plné kurzy v měsících',
                                      backgroundColor: ['#49306B', '#635380', '#90708C'],
                                      data: [4, 1, 0]
                                  }
                              ]
                          }"></bar-chart>
                      </div>
                    </div>
                </div>
                <div v-if="activeTab == 'RESERVATIONS'" class="flex flex-wrap -mx-4">
                  <div class="w-full mb-6 lg:mb-0 lg:w-1/2 px-4 pr-2 flex flex-col text-gray-700">
                      <div class="flex-grow flex flex-col bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                          <div class="border-b">
                              <div class="flex justify-between px-6 -mb-px">
                                  <div class="py-4 px-2 font-normal cursor-pointer text-blue-600">Rezervace čekající na schválení</div>
                              </div>
                          </div>
                          <div>
                            <a :href="'/admin/reservations/' + reservation.id" v-for="reservation in stats.reservationsWaitingForApprovement" class="flex-grow flex px-6 py-6 text-gray-600er items-center border-b -mx-4 hover:bg-gray-100 cursor-pointer">
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
                      <div class="flex-grow flex flex-col bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                          <div class="border-b">
                              <div class="flex justify-between px-6 -mb-px">
                                  <div class="py-4 px-2 font-normal cursor-pointer text-blue-600">Rezervace náhradníků</div>
                              </div>
                          </div>
                          <div>
                            <a :href="'/admin/reservations/' + reservation.id" v-for="reservation in stats.queuedReservations" class="flex-grow flex px-6 py-6 text-gray-600er items-center border-b -mx-4 hover:bg-gray-100 cursor-pointer">
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
            activeTab: 'COURSE_DATES', // RESERVATIIONS
            activeDetailsTab: 'COURSE_DATES_REMAINING_BY_VENUE', //COURSE_DATES_FULL_BY_VENUE, COURSE_DATES_REMAINING_BY_MONTH, COURSE_DATES_FULL_BY_MONTH

            courseDatesThisMonth: null,
            courseDatesThisYear: null,
            courseDatesInProgress: null,
            fullCourseDatesThisMonth: null,
            fullCourseDatesThisYear: null,
        }
    },

    methods: {
        getStats() {
            axios.get('/admin/stats')
                .then((response) => {
                    this.courseDatesThisMonth = response.data.data.courseDatesThisMonth;
                    this.courseDatesThisYear = response.data.data.courseDatesThisYear;
                    this.courseDatesInProgress = response.data.data.courseDatesInProgress;
                    this.fullCourseDatesThisMonth = response.data.data.fullCourseDatesThisMonth;
                    this.fullCourseDatesThisYear = response.data.data.fullCourseDatesThisYear;
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