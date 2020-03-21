<template>
    <section id="reference" class="py-12 my-12 flex justify-center">
        <div class="w-3/5">
            <div class=" flex flex-col items-center sm:items-start text-center sm:text-left mb-6 italic">
                <home-testamonial
                    v-for="(testamonial, key) in testamonials"
                    :key="testamonial"
                    v-show="key == activeTestamonial"
                    :text="testamonial">
                </home-testamonial>
            </div>
            <div class="flex justify-center pt-4">
                <svg v-for="(testamonial, key) in testamonials" @click="activeTestamonial = key" :class="{'bg-purple-300': activeTestamonial == key}" class="fill-current inline-block h-4 w-4 mb-10 text-purple-300 opacity-75 cursor-pointer mx-1 rounded-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200z"/>
                </svg>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            testamonials: [
                'Naprosto úšasná paní lektorka, milý výklad, vytvořila příjemnou pohodlnou atmosféru, naučila mě o moc víc neý jsem čekala a cítila jsem se při tom skvěle. Hodnotím největší jedničkou na světě.',
                'Na výbornou, velký zájem od vás obou naučit a moc hezky i lidem z ulice vysvětlit postupy a techniku. Moc chválím. Díky',
                'Naučili mě se znovu dívat + mě přesvědčili, že opravdu lze naučit kreslit každého. Děkuji za skvělé vedení a instrukce v celém kurzu.',
                'Načila jsem se novou techniku, jak vypracovat detaily a spostu zajímavých věcí. Poznala jsem nové lidi a ukázali mi, že člověk najde vždy něco nového i sám v sobě.',
            ],

            activeTestamonial: 0,
        }
    }
}
</script>

<style>
   /* Enter and leave animations can use different */
/* durations and timing functions.              */
.slide-fade-enter-active {
  transition: all .3s ease;
}
.slide-fade-leave-active {
  transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}
</style>