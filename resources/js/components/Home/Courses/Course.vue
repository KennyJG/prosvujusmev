<template>
   <div class="w-full lg:w-1/3 md:px-4 mb-4 md:mb-0">
        <div class="bg-white overflow-hidden relative" 
            @mouseover="hovered = true"
            @mouseleave="hovered = false">
            <a :href="link">
                <img
                    :class="{'inactive': !hovered}" 
                    class="h-56 w-full object-cover object-center rounded cursor-pointer" 
                    :src="imageSource" 
                    alt="">
            </a>
            <div class="p-4 h-auto md:h-40 lg:h-48">
                <a 
                    :href="link" 
                    :class="{'text-purple-300': hovered}"
                    class="block text-gray-800 font-semibold mb-2 text-lg md:text-base lg:text-lg">
                    {{ title }}
                </a>
                <div class="text-gray-600 text-sm leading-relaxed block md:text-xs lg:text-sm">
                    {{ description }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'title',
        'link',
        'description',
        'imageSource'
    ], 

    data() {
        return {
            hovered: false,
        }
    }
}
</script>

<style scoped>
    img.inactive {
        -webkit-filter: grayscale(1); /* Webkit */ 
        filter: gray; /* IE6-9 */ 
        filter: grayscale(1); /* W3C */
    }
</style>