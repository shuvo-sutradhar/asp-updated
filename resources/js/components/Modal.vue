<template>
	<div name="modal" v-if="isOpen" @click.self="close()">
		
	     <div id="switch-plans-modal" class="fixed w-full h-full inset-0 z-50 flex justify-center">
			<div class="fixed opacity-50 bg-black inset-0 w-full h-full"></div>
			<div class="absolute w-10/12 md:w-8/12 lg:w-5/12 xl:w-4/12 bg-white rounded-lg mt-32">

				<slot name="closeModal">
					<div @click="close" id="switch-plan-close" class="absolute right-0 top-0 -mt-4 -ml-4 h-8 w-8 rounded-full shadow bg-white text-xl flex justify-center align-center cursor-pointer">
						&times;
					</div>
				</slot>

				<div class="p-4 bg-gray-100 text-center rounded-t-full">
					<slot name="header">
						default header
					</slot>
				</div>

				<slot name="modal-form">
					<slot name="body" class="p-8">
						default body
					</slot>


					<slot name="footer">
						default footer
						<button class="modal-default-button" @click="$emit('close')">
							OK
						</button>
					</slot>
				</slot>
		
			</div>
	    </div>
	</div>


</template>


<script>
	export default {
		name: "Modal",
		props: {
			name: { type: String, required: true }
		},

		computed: {
			isActive() {
				return this.$store.getters["modals/active"] === this.name
			},
			isOpen() {
				return this.$store.getters["modals/allOpen"].includes(this.name)
			}
		},
		methods: {
			close() {
				this.$store.dispatch("modals/close", this.name)
			}
		},
		beforeDestroy() {
			if (this.isOpen) this.close()
		}
	}
</script>
