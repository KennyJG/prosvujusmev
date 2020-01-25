<template>
    <div class="w-full">
        <div class="w-full h-12 border-b flex justify-between">
            <div class="flex align-middle content-center text-gray-600">
                <div class="flex content-center items-center pl-6">
                    <a class="mr-4" href="/admin/reservations">Rezervace</a>/
                    <div class="ml-4 text-black">{{ reservation.source_code }} - {{ reservation.attendee.first_name }} {{ reservation.attendee.last_name }}</div>
                </div>
            </div>
            <div class="flex align-middle">
                <button @click="deleteReservation()" class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border-l hover:border-transparent">Odstranit</button> 
                <button @click="goBack()" class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border-l hover:border-transparent">Zpět</button> 
            </div>
        </div>
        <div class="w-full flex">
            <div class="w-1/3 h-full p-6 px-8 border-r">
                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Kurz</div>
                    <div class="w-2/3">{{ reservation.course.name }}</div>
                </div>

                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Stav</div>
                    <div class="w-2/3">{{ reservation.status }}</div>
                </div>

                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">UUID</div>
                    <div class="w-2/3">{{ reservation.uuid }}</div>
                </div>

                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Jméno</div>
                    <div class="w-2/3">{{ reservation.attendee.first_name }}</div>
                </div> 

                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Příjmení</div>
                    <div class="w-2/3">{{ reservation.attendee.last_name }}</div>
                </div> 

                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Email</div>
                    <div class="w-2/3">{{ reservation.attendee.email }}</div>
                </div> 

                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Telefon</div>
                    <div class="w-2/3">{{ reservation.attendee.phone }}</div>
                </div> 

                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Stát</div>
                    <div class="w-2/3">{{ reservation.attendee.address.country }}</div>
                </div> 

                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Město</div>
                    <div class="w-2/3">{{ reservation.attendee.address.city }}</div>
                </div> 

                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">Ulice</div>
                    <div class="w-2/3">{{ reservation.attendee.address.street }}</div>
                </div> 

                <div class="flex mt-6">
                    <div class="w-1/3 font-bold">PSČ</div>
                    <div class="w-2/3">{{ reservation.attendee.address.zip }}</div>
                </div>   
            </div>
            <div class="w-2/3 h-full p-6 px-8">
                <div class="text-2xl">Historie</div>
                <div class="p-12">
                    <div class="flex w-full mt-3" v-for="statusRecord in reservation.statusRecords">
                        <div class="w-1/4 text-gray-600 italic content-center items-center flex justify-start">
                            <div class="h-auto">{{ statusRecord.created_at }}</div>
                        </div>
                        <div class="w-1/4 text-red-900 font-bold content-center items-center flex justify-end">
                            <div class="h-auto">{{ statusRecord.old_status }}</div>
                        </div>
                        <div v-if="statusRecord.old_status !== null" class="text-center w-1/4">
                            <svg class="fill-current text-gray-500 inline-block h-12 w-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z"/>
                            </svg>
                        </div>
                        <div v-else class="text-center w-1/4 h-12"></div>
                        <div class="w-1/3 text-right text-green-600 font-bold content-center items-center flex">
                            <div>{{ statusRecord.new_status }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['reservation', 'backUrl'],

    data() {
        return {
        };
    },

    methods: {
        goBack() {
            window.location.href = this.backUrl[0];
        },

        deleteReservation() {

        }
    }
}
</script>

<style>
</style>