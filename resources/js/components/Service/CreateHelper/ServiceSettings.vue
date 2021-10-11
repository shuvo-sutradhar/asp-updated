<template>
    <div>
        <div class="py-6 px-10">
            <checkbox id="review" v-model="review" class="flex items-center mb-2">
                <label for="review" class="block uppercase tracking-wide text-gray-600 text-xs font-bold">Allow client to review <a href="#"><i class="fad fa-question-circle text-indigo-500"></i></a></label>
                <p class="help-block text-xs font-medium text-gray-600">Client can review this service after finish the order of this service.</p>
            </checkbox>
        </div>
        <hr class="border-gray-200">
        <div class="py-6 px-10">
            <checkbox id="comment" v-model="comment" class="flex items-center mb-2">
                <label for="comment" class="block uppercase tracking-wide text-gray-600 text-xs font-bold">Allow client to comment <a href="#"><i class="fad fa-question-circle text-indigo-500"></i></a></label>
                <p class="help-block text-xs font-medium text-gray-600">Client can comment on this service from his panel.</p>
            </checkbox>
        </div>
        <hr class="border-gray-200">
        <div class="py-6 px-10">
            <checkbox id="group_quantity" v-model="group_quantities" class="flex items-center mb-2">
                <label for="group_quantity" class="block uppercase tracking-wide text-gray-600 text-xs font-bold">Group multiple quantities of this service into one order</label>
                <p class="help-block text-xs font-medium text-gray-600">By default purchases of multiple quantities are added as separate orders. Different services are always added separately.</p>
            </checkbox>
        </div>
        <hr class="border-gray-200">
        <div class="py-6 px-10">
            <checkbox id="hasDeadline" v-model="hasDeadline" class="flex items-center mb-2">
                <label for="hasDeadline" class="block uppercase tracking-wide text-gray-600 text-xs font-bold">Set a deadline</label>
                <p class="help-block text-xs font-medium text-gray-600">Helps your team see orders that are due soon, not visible to clients.</p>
            </checkbox>
            <div v-if="hasDeadline">
                <div class="ml-6 w-1/2 relative rounded-md shadow-sm">
                    <input type="number" v-model="deadline" class="mt-2 border-2 border-gray-200 pl-4 pr-20 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" placeholder="0">
                    <div class="absolute inset-y-0 right-0 flex items-center">
                        <select v-model="deadline_for" class="mr-2px focus:outline-none h-10 py-0 pl-2 pr-2 border-transparent bg-gray-200 text-gray-500 sm:text-sm sm:leading-5 rounded-r-lg">
                            <option selected value="hours">Hours</option>
                            <option value="days">Days</option>
                        </select>
                    </div>
                </div>
                
            </div>
        </div>
        <hr class="border-gray-200">
        <div class="py-6 px-10">
            <checkbox id="status" v-model="status" class="flex items-center mb-2">
                <label for="status" class="block uppercase tracking-wide text-gray-600 text-xs font-bold">Show in services page</label>
                <p class="help-block text-xs font-medium text-gray-600">Choose whether to list this service in your Client Portal's services page. Service can still be used in order forms.</p>
            </checkbox>
        </div>
    </div>
</template>

<script>
export default {
    
    data: () => ({
        hasDeadline: true
    }),

    computed: {

        // review
        review: {
            get() {
                return this.$store.state.service.form.can_review
            },
            set(value) {
               this.$store.dispatch('service/canReview', value)
            }
        },

        // comment
        comment: {
            get() {
                return this.$store.state.service.form.can_comment
            },
            set(value) {
               this.$store.dispatch('service/canComment', value)
            }
        },

        // group multiple quantity in same order
        group_quantities: {
            get() {
                return this.$store.state.service.form.group_quantities
            },
            set(value) {
               this.$store.dispatch('service/groupQuantities', value)
            }
        },

        // deadline (number)
        deadline: {
            get() {
                return this.$store.state.service.form.deadline
            },
            set(value) {
               this.$store.dispatch('service/serviceDeadline', value)
            }
        },

        // deadline for (hours, day)
        deadline_for: {
            get() {
                return this.$store.state.service.form.deadline_for
            },
            set(value) {
               this.$store.dispatch('service/serviceDeadlineFor', value)
            }
        },

        // service status is active or not
        status: {
            get() {
                return this.$store.state.service.form.status
            },
            set(value) {
               this.$store.dispatch('service/serviceStatus', value)
            }
        },

    },
}
</script>