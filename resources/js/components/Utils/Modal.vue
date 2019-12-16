<template>
    <div :id="name" class="overlay">
        <a href="#" class="cancel"></a>

        <div class="modal">
            <slot></slot>

            <footer class="flex justify-end mt-8">
                <slot name="footer"></slot>
            </footer>

            <a href="#" class="close text-gray-600 hover:text-purple-600">&times;</a>
        </div>
    </div>
</template>

<script>
export default {
    props: ['name'],

    data() {
        return {

        };
    },

    methods: {

    }
}
</script>

<style>
    .overlay {
        visibility: hidden;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, .7);
        transition: opacity .3s;
        opacity: 0;
    }

    .overlay:target {
        visibility: visible;
        opacity: 1;
    }

    .modal {
        position: relative;
        width: 600px;
        max-width: 80%;
        background: white;
        border-radius: 8px;
        padding: 1em 2em;
    }

    .modal .close {
        position: absolute;
        top: 15px;
        right: 15px;
        text-decoration: none;
    }

    .overlay .cancel {
        position: absolute;
        width: 100%;
        height: 100%;
    }
</style>