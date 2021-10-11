<template>
    <div>
        <div class="px-6 py-10 text-center">
            <i class="fad fa-sticky-note text-4xl text-indigo-500"></i>
            <h2 class="text-xl font-semibold text-gray-600">Tell your buyer what you need to get started.</h2>
            <p class="text-gray-600">Structure your Buyer Instructions as free text, a multiple choice question or file upload.</p>
            <button @click="open('service-data')" class="text-white bg-indigo-500 px-4 py-2 rounded mt-2">Click Here</button>
        </div>
        <sidebar-drawer name="service-data"></sidebar-drawer>
    </div>
</template>

<script>
export default {
    methods: {

        // add tag modal
        open(name) {
            this.$store.dispatch("sidebarDrawer/open", name);
        }
    }
}
</script>