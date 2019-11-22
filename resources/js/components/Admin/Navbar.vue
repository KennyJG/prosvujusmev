<template>
    <div :class="hideMenu ? 'w-12' : 'w-full absolute sm:relative sm:w-1/4'" class="h-screen bg-gray-200">
        <div v-if="!hideMenu" class="w-full h-12 bg-gray-400 flex items-center justify-end">
            <div @click="hideMenu = !hideMenu" class="h-full flex items-center mr-2">
                <svg class="fill-current text-teal-500 inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
                    <g xmlns="http://www.w3.org/2000/svg"><polygon fill="black" points="123.5429688,11.59375 116.4765625,4.5185547 64.0019531,56.9306641 11.5595703,4.4882813     4.4882813,11.5595703 56.9272461,63.9970703 4.4570313,116.4052734 11.5244141,123.4814453 63.9985352,71.0683594     116.4423828,123.5117188 123.5126953,116.4414063 71.0732422,64.0019531   "/></g>
                </svg>
            </div>
        </div>

        <div v-else class="w-full h-12 bg-gray-400 flex items-center justify-center">
            <div @click="hideMenu = !hideMenu" class="h-full w-full flex items-center justify-center">
                <svg class="fill-current text-teal-500 inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                    <polygon xmlns="http://www.w3.org/2000/svg" fill="black" points="15,2.75 12.914,4.836 33.078,25 12.914,45.164 15,47.25 37.25,25 "/>
                </svg>
            </div>
        </div>

        <div :class="hideMenu ? 'hidden' : 'block'">
            <a href="/admin/courses">
                <div class="px-4 py-2 hover:bg-gray-300 bg-gray-300">Kurzy</div>
            </a>
            <div class="px-4 py-2 hover:bg-gray-300">Menu 2</div>
            <div class="px-4 py-2 hover:bg-gray-300">Menu 3</div>
            <div class="px-4 py-2 hover:bg-gray-300">Menu 4</div>
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
        }
    }
</script>