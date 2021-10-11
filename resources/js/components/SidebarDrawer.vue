<template>
    <div name="sidebar-drawer" 
         class="drawer-wrap shadow fixed h-full bg-white top-0 right-0 z-30 transition bg-gray-200"
         :class="{'drawer-open' :isActive}" >
        <div class="absolute bg-gray-200 w-full h-100 t-0 flex justify-between border-b border-gray-100 p-4 shadow-xs md:flex-row md:p-6 z-30">
            <slot name="header">
                <h2 class="text-md font-bold text-gray-600">This is page title</h2>
            </slot>
            <div @click="close()">
                <span class="w-8 leading-6 h-8 bg-white inline-block text-center rounded-full border border-pink-200 text-pink-500 cursor-pointer flex justify-center items-center">&times;</span>
            </div>
        </div>
        <div class="drawer-body overflow-auto h-full p-6 pt-24">
            <slot name="body">
                This is body...
            </slot>
        </div>
        <div class="drawer-footer">
            This is footer...
        </div>
    </div>
</template>



<script>
	export default {
        name: "sidebar-drawer",

		props: {
			name: { type: String, required: true }
		},

		computed: {
			isActive() {
				return this.$store.getters["sidebarDrawer/active"] === this.name
			},
			isOpen() {
				return this.$store.getters["sidebarDrawer/allOpen"].includes(this.name)
			}
        },
    
		methods: {
			close() {
				this.$store.dispatch("sidebarDrawer/close", this.name)
			}
        },
    
		beforeDestroy() {
			if (this.isOpen) this.close()
		}
	}
</script>


<style >

.drawer-wrap {
    width: 80%;
    right: -80%;
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
}
.drawer-open {
    right: 0;
}

</style>