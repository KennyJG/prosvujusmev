<template>
    <section id="kurzy" class="py-12">
        <div class="sm:w-full flex flex-col items-center sm:items-start text-center sm:text-left mb-6">
            <h2 class="uppercase text-4xl text-gray-800 font-bold leading-none tracking-wide mb-2">Naše kurzy</h2>
        </div>
        <div class="block md:flex justify-between lg:justify-start md:-mx-2 flex-wrap">
            <home-course 
                v-for="course in courses"
                :key="course.title"
                :link="course.link"
                :title="course.title" 
                :description="course.description"
                :image-source="course.imageSource">
            </home-course>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            courses: [
                {
                    title: 'Tužka I.',
                    link: '/kurzy/tuzka-i',
                    description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo quidem blanditiis unde asperiores? Officia amet perspiciatis ad quibusdam incidunt eaque, nobis, eveniet neque porro id commodi quisquam debitis!',
                    imageSource: '/images/tuzka1_1.jpg',
                },
                {
                    title: 'Tužka II.',
                    link: '/kurzy/tuzka-ii',
                    description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo quidem blanditiis unde asperiores? Officia amet perspiciatis ad quibusdam incidunt eaque, nobis, eveniet neque porro id commodi quisquam debitis!',
                    imageSource: '/images/tuzka2_1.jpg',
                },
                {
                    title: 'Pastel-křída',
                    link: '/kurzy/pastel-krida',
                    description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo quidem blanditiis unde asperiores? Officia amet perspiciatis ad quibusdam incidunt eaque, nobis, eveniet neque porro id commodi quisquam debitis!',
                    imageSource: '/images/pastel_krida_1.jpg',
                },
                {
                    title: 'Pastelka',
                    link: '/kurzy/pastelka',
                    description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo quidem blanditiis unde asperiores? Officia amet perspiciatis ad quibusdam incidunt eaque, nobis, eveniet neque porro id commodi quisquam debitis!',
                    imageSource: '/images/pastelka_1.jpg',
                },
                {
                    title: 'Akryl', 
                    link: '/kurzy/akryl',
                    description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo quidem blanditiis unde asperiores? Officia amet perspiciatis ad quibusdam incidunt eaque, nobis, eveniet neque porro id commodi quisquam debitis!',
                    imageSource: '/images/akryl_1.jpg',
                },
                {
                    title: 'Olejomalba', 
                    link: '/kurzy/olejomalba',
                    description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo quidem blanditiis unde asperiores? Officia amet perspiciatis ad quibusdam incidunt eaque, nobis, eveniet neque porro id commodi quisquam debitis!',
                    imageSource: '/images/olejomalba_1.jpg',
                },
            ]
        }
    }
}
</script>

<style>

</style>