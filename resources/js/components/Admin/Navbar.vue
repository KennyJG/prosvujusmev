<template>
    <div class="p-4 pt-0 mx-auto flex flex-wrap ">
        <div class="pt-4 w-64">
            <div class="w-full py-4 px-2 text-gray-900 bg-white rounded-lg text-left capitalize font-medium shadow border-t border-b sm:rounded sm:border">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" class="w-8 h-8 mx-auto mb-5 text-blue-600"><path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm80 168c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32zm-160 0c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32zm194.8 170.2C334.3 380.4 292.5 400 248 400s-86.3-19.6-114.8-53.8c-13.6-16.3 11-36.7 24.6-20.5 22.4 26.9 55.2 42.2 90.2 42.2s67.8-15.4 90.2-42.2c13.4-16.2 38.1 4.2 24.6 20.5z"></path></svg>
                <!-- <img src="https://www.freepnglogos.com/uploads/spotify-logo-png/file-spotify-logo-png-4.png" alt="alt placeholder" class="w-8 h-8 mx-auto mb-5 "> -->
                <a href="/admin/dashboard" :class="isActive('/admin/dashboard') ? 'bg-gray-200' : ''"class="cursor-pointer px-2 py-1 hover:bg-gray-200 hover:text-gray-700 rounded block mb-3 flex items-center">
                    <div class="rounded-full bg-gray-200">
                        <svg class="fill-current inline-block h-8 w-8 rounded-full p-2 bg-gray-200"xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M3.889 3h6.222a.9.9 0 0 1 .889.91v8.18a.9.9 0 0 1-.889.91H3.89A.9.9 0 0 1 3 12.09V3.91A.9.9 0 0 1 3.889 3zM3.889 15h6.222c.491 0 .889.384.889.857v4.286c0 .473-.398.857-.889.857H3.89C3.398 21 3 20.616 3 20.143v-4.286c0-.473.398-.857.889-.857zM13.889 11h6.222a.9.9 0 0 1 .889.91v8.18a.9.9 0 0 1-.889.91H13.89a.9.9 0 0 1-.889-.91v-8.18a.9.9 0 0 1 .889-.91zM13.889 3h6.222c.491 0 .889.384.889.857v4.286c0 .473-.398.857-.889.857H13.89C13.398 9 13 8.616 13 8.143V3.857c0-.473.398-.857.889-.857z"/></svg>
                    </div>
                    <span class="mx-2">Přehled</span>
                </a>
                <a href="/admin/courses" :class="isActive('/admin/courses') ? 'bg-gray-200' : ''"  class="cursor-pointer px-2 py-1 hover:bg-gray-200 hover:text-gray-700 rounded block mb-3 flex items-center">
                    <div class="rounded-full bg-gray-200">
                        <svg class="fill-current inline-block h-8 w-8 rounded-full p-2 bg-gray-200"xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M204.3 5C104.9 24.4 24.8 104.3 5.2 203.4c-37 187 131.7 326.4 258.8 306.7 41.2-6.4 61.4-54.6 42.5-91.7-23.1-45.4 9.9-98.4 60.9-98.4h79.7c35.8 0 64.8-29.6 64.9-65.3C511.5 97.1 368.1-26.9 204.3 5zM96 320c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm32-128c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128-64c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128 64c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32z"/>
                        </svg>
                    </div>
                    <span class="mx-2">Kurzy</span>
                </a>
                <!-- With count of news -->
                <!-- <span class="cursor-pointer px-2 py-1 hover:bg-gray-200 hover:text-gray-700 rounded block mb-5">
                    <span class="w-8 mb-5 relative">
                        <svg class="fill-current inline-block h-8 w-8 rounded-full p-2 bg-gray-200"xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M3.889 3h6.222a.9.9 0 0 1 .889.91v8.18a.9.9 0 0 1-.889.91H3.89A.9.9 0 0 1 3 12.09V3.91A.9.9 0 0 1 3.889 3zM3.889 15h6.222c.491 0 .889.384.889.857v4.286c0 .473-.398.857-.889.857H3.89C3.398 21 3 20.616 3 20.143v-4.286c0-.473.398-.857.889-.857zM13.889 11h6.222a.9.9 0 0 1 .889.91v8.18a.9.9 0 0 1-.889.91H13.89a.9.9 0 0 1-.889-.91v-8.18a.9.9 0 0 1 .889-.91zM13.889 3h6.222c.491 0 .889.384.889.857v4.286c0 .473-.398.857-.889.857H13.89C13.398 9 13 8.616 13 8.143V3.857c0-.473.398-.857.889-.857z"/></svg>
                        <span class="absolute right-0 top-0 -mt-2 -mr-1 text-xs bg-yellow-500 text-black font-medium px-2 rounded-full">3</span>
                    </span>
                    <span class="mx-2">sign ups</span>
                </span> -->
                <a href="/admin/course-dates" :class="isActive('/admin/course-dates') ? 'bg-gray-200' : ''" class="cursor-pointer px-2 py-1 hover:bg-gray-200 hover:text-gray-700 rounded block mb-3 flex items-center">
                    <div class="rounded-full bg-gray-200">
                        <svg class="fill-current inline-block h-8 w-8 p-2"xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M148 288h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm108-12v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm96 0v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm-96 96v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm-96 0v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm192 0v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm96-260v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h48V12c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v52h128V12c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v52h48c26.5 0 48 21.5 48 48zm-48 346V160H48v298c0 3.3 2.7 6 6 6h340c3.3 0 6-2.7 6-6z"/>
                        </svg>
                    </div>
                    <span class="mx-2">Termíny</span>
                </a>
                <a href="/admin/reservations" :class="isActive('/admin/reservations') ? 'bg-gray-200' : ''" class="cursor-pointer px-2 py-1 hover:bg-gray-200 hover:text-gray-700 rounded block mb-3 flex items-center">
                    <div class="rounded-full bg-gray-200">
                        <svg class="fill-current inline-block h-8 w-8 p-2"xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path d="M528 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zm0 400H48V80h480v352zM208 256c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm-89.6 128h179.2c12.4 0 22.4-8.6 22.4-19.2v-19.2c0-31.8-30.1-57.6-67.2-57.6-10.8 0-18.7 8-44.8 8-26.9 0-33.4-8-44.8-8-37.1 0-67.2 25.8-67.2 57.6v19.2c0 10.6 10 19.2 22.4 19.2zM360 320h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8H360c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8zm0-64h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8H360c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8zm0-64h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8H360c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8z"/>
                        </svg>
                    </div>
                    <span class="mx-2">Rezervace</span>
                </a>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        mounted() {

        },

        data() {
            return {
                hideMenu: false,
            }
        },

        methods: {
            // hideMenu: function() {
            //     this.hideMenu =
            // }

            isActive: function(value) {
                return (window.location.href.indexOf(value) > -1);
            }
        }
    }
</script>