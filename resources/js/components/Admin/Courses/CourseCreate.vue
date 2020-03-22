<template>
    <div class="h-screen w-full bg-gray-100">
        <div class="w-full flex flex-col text-gray-700 pt-4 pr-4">
            <div class="w-full flex bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                <div class="w-full font-regular text-blue-600 flex justify-end">
                    <div class="hidden lg:flex text-gray-800 ">
                        <a href="/admin/courses" class="focus:outline-none appearance-none py-4 px-2 border-b border-transparent hover:border-blue-600 hover:text-blue-600 mr-4">Zpět</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="w-full mb-4 flex flex-col text-gray-700 pt-4 pr-4">
            <div class="w-full flex bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                <div class="w-full">
                    <div class="flex px-4 py-4 text-gray-600er items-center border-b course-pointer">
                        <div class="w-full">
                            <div class="flex items-center border-b border-b-2 border-blue-500 py-2">
                                <input v-model="name" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Název kurzu" aria-label="Název kurzu">
                            </div>
                            <div class="flex items-center border-b border-b-2 border-blue-500 py-2 mt-4">
                                <textarea v-model="description" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" placeholder="Popis kurzu..." aria-label="Popis kurzu"></textarea>
                            </div>
                            <div class="mt-4 flex justify-end">
                                <button @click="createCourse" class="bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-sm border-4 text-white py-1 px-2 rounded" type="button">Vytvořit</button>
                                <a href="/admin/courses" class="border-transparent border-4 text-blue-500 hover:text-blue-800 text-sm py-1 px-2 rounded" type="button">Zrušit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
    ],
    data() {
        return {
            name: null,
            description: null,
        }
    },
    methods: {
        createCourse() {
            axios.post('/admin/courses', {
                name: this.name,
                description: this.description,
            }).then(response => {
                window.location.href = '/admin/courses';
            });
        }
    },

    mounted() {
    }
}
</script>

<style>

</style>