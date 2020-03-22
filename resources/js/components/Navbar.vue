<template>
    <header class="flex flex-col sm:flex-row items-center justify-between py-6 relative">
        <h3 class="text-2xl font-bold uppercase text-blue-900">Logo</h3>
        <nav class="hidden md:flex text-lg">
            <a href="/#" :class="isActive('/') ? 'text-purple-600' : ''" class="text-gray-800 hover:text-purple-300 py-3 px-6">Home</a>
            <a href="/#kurzy" class="text-gray-800 hover:text-purple-300 py-3 px-6">Kurzy</a>
            <a href="#" class="text-gray-800 hover:text-purple-300 py-3 px-6">Koupit</a>
            <a href="/rezervace" :class="isActive('/rezervace') ? 'text-purple-600' : ''" class="text-gray-800 hover:text-purple-300 py-3 px-6">Rezervace</a>
            <a href="/cenik" :class="isActive('/cenik') ? 'text-purple-600' : ''" class="text-gray-800 hover:text-purple-300 py-3 px-6">Ceník</a>
            <a href="#" class="text-gray-800 hover:text-purple-300 py-3 px-6">Termíny</a>
            <a href="#" class="text-gray-800 hover:text-purple-300 py-3 px-6">Galerie</a>
            <a href="/#reference" class="text-gray-800 hover:text-purple-300 py-3 px-6">Reference</a>
            <a href="/kontakty" :class="isActive('/kontakty') ? 'text-purple-600' : ''" class="text-gray-800 hover:text-purple-300 py-3 px-6">Kontakty</a>
            <!-- <a href="#" class="bg-purple-200 hover:bg-purple-300 rounded-full uppercase text-purple-700 py-3 px-6">Sign Up</a> -->
        </nav>
        <button class="flex md:hidden flex-col absolute top-0 right-0 p-4 mt-5">
            <span class="w-5 h-px mb-1 bg-orange-500"></span>
            <span class="w-5 h-px mb-1 bg-orange-500"></span>
            <span class="w-5 h-px mb-1 bg-orange-500"></span>
        </button>
    </header>
</template>

<script>
export default {
        methods: {
            isActive (value) {
                return window.location.pathname == value;
            }
        }
}
</script>

<style>

</style>