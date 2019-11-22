<template>
    <div class="bg-white shadow">
        <div class="container mx-auto px-4">
            <div class="flex py-4 aling-center">
                <div class="flex-1">
                    <a href="/">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-purple-600" viewBox="0 0 496 512">
                                <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm80 168c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32zm-160 0c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32zm194.8 170.2C334.3 380.4 292.5 400 248 400s-86.3-19.6-114.8-53.8c-13.6-16.3 11-36.7 24.6-20.5 22.4 26.9 55.2 42.2 90.2 42.2s67.8-15.4 90.2-42.2c13.4-16.2 38.1 4.2 24.6 20.5z"/>
                            </svg>
                        </div>
                    </a>
                </div>
                <div class="flex-1 flex content-center">
                    <div class="hidden sm:flex sm:items-center">
                        <a href="/reservations" class="text-gray-800 text-sm font-semibold hover:text-purple-600 mr-4">Rezervace</a>
                        <a href="#" class="text-gray-800 text-sm font-semibold hover:text-purple-600 mr-4">Termíny</a>
                        <a href="#" class="text-gray-800 text-sm font-semibold hover:text-purple-600 mr-4">Ceník</a>                    
                        <a href="#" class="text-gray-800 text-sm font-semibold hover:text-purple-600 mr-4">Galerie</a>
                        <a href="#" class="text-gray-800 text-sm font-semibold hover:text-purple-600 mr-4">Reference</a>
                        <a href="#" class="text-gray-800 text-sm font-semibold hover:text-purple-600">Kontakt</a>
                    </div>
                </div>

                <div class="flex-1 hidden sm:flex sm:items-center justify-end">
                    <!-- <a href="#" class="text-gray-800 text-sm font-semibold hover:text-purple-600 mr-4">Příhlášení</a>
                    <a href="#" class="text-gray-800 text-sm font-semibold border px-4 py-2 rounded-lg hover:text-purple-600 hover:border-purple-600">Registrace</a> -->
                </div>

                <div @click="hideMenu()" class="sm:hidden cursor-pointer flex items-center">
                    <svg class="fill-current text-teal-500 inline-block h-6 w-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path xmlns="http://www.w3.org/2000/svg" fill="currentColor" d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"/>
                    </svg>
                </div>
            </div>
            
            <div :class="showMenu ? 'block' : 'hidden'" class="sm:hidden bg-white border-t-2 py-2">
                <div class="flex flex-col">
                    <a href="/reservations" class="text-gray-800 text-sm font-semibold hover:text-purple-600 mb-1">Rezervace</a>
                    <a href="#" class="text-gray-800 text-sm font-semibold hover:text-purple-600 mb-1">Termíny</a>
                    <a href="#" class="text-gray-800 text-sm font-semibold hover:text-purple-600 mb-1">Ceník</a>
                    <a href="#" class="text-gray-800 text-sm font-semibold hover:text-purple-600 mb-1">Galerie</a>
                    <a href="#" class="text-gray-800 text-sm font-semibold hover:text-purple-600 mb-1">Reference</a>
                    <a href="#" class="text-gray-800 text-sm font-semibold hover:text-purple-600 mb-1">Kontakt</a>
                    <div class="flex justify-between items-center border-t-2 pt-2">
                        <!-- <a href="#" class="text-gray-800 text-sm font-semibold hover:text-purple-600 mr-4">Příhlášení</a>
                        <a href="#" class="text-gray-800 text-sm font-semibold border px-4 py-1 rounded-lg hover:text-purple-600 hover:border-purple-600">Registrace</a> -->
                    </div>
                </div>
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
            showMenu: false,
        }
    },

    methods: {
        hideMenu: function() {
            this.showMenu = !this.showMenu;
        }
    }
}
</script>

<style>

</style>