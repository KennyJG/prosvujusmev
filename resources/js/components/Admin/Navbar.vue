<template>
    <div :class="hideMenu ? 'w-12' : 'w-full absolute sm:relative sm:w-1/4'" class="bg-gray-200">
        <div v-if="!hideMenu" class="w-full h-12 bg-gray-400 flex items-center justify-end">
            <div @click="hideMenu = !hideMenu" class="h-full flex items-center mr-2 cursor-pointer">
                <svg class="fill-current text-teal-500 inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
                    <path xmlns="http://www.w3.org/2000/svg" fill="black" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"/>
                </svg>
            </div>
        </div>

        <div v-else class="w-full h-12 bg-gray-400 flex items-center justify-center cursor-pointer">
            <div @click="hideMenu = !hideMenu" class="h-full w-full flex items-center justify-center ">
                <svg class="fill-current text-teal-500 inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path xmlns="http://www.w3.org/2000/svg" fill="black" d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"/>
                </svg>
            </div>
        </div>

        <div :class="hideMenu ? 'hidden' : 'block'">
            <a href="/admin/courses">
                <div :class="isActive('/admin/courses') ? 'bg-gray-300' : ''" class="px-4 py-2 hover:bg-gray-300">Kurzy</div>
            </a>

            <a href="/admin/course-dates">
                <div :class="isActive('/admin/course-dates') ? 'bg-gray-300' : ''" class="px-4 py-2 hover:bg-gray-300">Termíny</div>
            </a>

            <a href="/admin/reservations">
                <div :class="isActive('/admin/reservations') ? 'bg-gray-300' : ''" class="px-4 py-2 hover:bg-gray-300">Rezervace</div>
            </a>
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