<template>
    <div>
        <div class="px-6 py-10 text-center">
            <i class="far fa-question text-4xl text-indigo-500 mb-3"></i>
            <h2 class="text-xl font-semibold text-gray-600">What are FAQs?</h2>
            <p class="text-gray-600 leading-relaxed mb-3">Here you can add answers to the most commonly asked questions. Your FAQs will be displayed in your Gig page.</p>
            <button @click="open('service-faq')" class="text-white bg-indigo-500 px-4 py-2 rounded mt-2">Add FAQ</button>
        </div>
        <sidebar-drawer name="service-faq"></sidebar-drawer>
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