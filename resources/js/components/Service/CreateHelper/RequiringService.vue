<template>
    <div>
        <div class="py-6 px-10">
            <label for="price" class="block uppercase tracking-wide text-gray-600 text-xs font-bold">Price</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                <div class="relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 flex items-center">
                        <select v-model="currency" class="mt-2 ml-2px focus:outline-none h-10 py-0 pl-2 pr-2 border-transparent bg-gray-200 text-gray-500 sm:text-sm sm:leading-5 rounded-l-lg">
                            <option v-for="(data , index) in getCurrency" 
                                :key="index" :value="data">{{ data.name }}</option>
                        </select>
                    </div>
                    <input class="mt-2 border-2 border-gray-200 pl-20 pr-6 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" 
                            placeholder="0.00" 
                            id="price" 
                            @input="handleInput" 
                            v-model.number="price" >
                </div>
                <div class="relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                        <label for="period" class="mt-2 text-gray-500 h-10 sm:text-sm px-2 py-2 sm:leading-5 bg-gray-200 rounded-l-lg">
                            Every
                        </label>
                    </div>
                    <input id="period" type="number" v-model.number="period" class="mt-2 border-2 border-gray-200 pl-16 pr-20 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" placeholder="0.00">
                    <div class="absolute inset-y-0 right-0 flex items-center">
                        <select v-model="periodFor" class="mt-2 mr-2px focus:outline-none h-10 py-0 pl-2 pr-2 border-transparent bg-gray-200 text-gray-500 sm:text-sm sm:leading-5 rounded-r-lg">
                            <option selected value="month">Month</option>
                            <option value="year">Year</option>
                            <option value="week">Week</option>
                            <option value="day">Day</option>
                        </select>
                    </div>
                </div>
            </div>
            <button class="text-indigo-500 text-sm focus:outline-none hover:text-indigo-600 mt-2">Create multiple pricing options?</button>
        </div>
        <hr class="border-gray-200">
        <div class="py-6 px-10">
            <div class="flex -ml-2">
                <checkbox v-model="trail" class="flex items-center mb-2">
                    <span class="block uppercase tracking-wide text-gray-600 text-xs font-bold">With trial or setup fee <a href="#"><i class="fad fa-question-circle text-indigo-500"></i></a></span>
                </checkbox>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2" v-if="trail">
                <div class="relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 flex items-center">
                        <select v-model="currency" class="mt-2 ml-2px focus:outline-none h-10 py-0 pl-2 pr-2 border-transparent bg-gray-200 text-gray-500 sm:text-sm sm:leading-5 rounded-l-lg">
                            <option v-for="(data , index) in getCurrency" 
                                :key="index" :value="data">{{ data.name }}</option>
                        </select>
                    </div>
                    <input class="mt-2 border-2 border-gray-200 pl-20 pr-6 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" 
                            placeholder="0.00"
                            @input="handleTrailPrice" 
                            v-model.number="trailPrice">
                </div>
                <div class="relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                        <label for="period" class="mt-2 ml-2px text-gray-500 h-10 sm:text-sm px-2 py-2 sm:leading-5 bg-gray-200 rounded-l-lg">
                            Every
                        </label>
                    </div>
                    <input id="period" type="number" v-model="trailPeriod" class="mt-2 border-2 border-gray-200 pl-16 pr-20 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" placeholder="1">
                    <div class="absolute inset-y-0 right-0 flex items-center">
                        <select v-model="trailFor" class="mt-2 mr-2px focus:outline-none h-10 py-0 pl-2 pr-2 border-transparent bg-gray-200 text-gray-500 sm:text-sm sm:leading-5 rounded-r-lg">
                            <option selected value="month">Month</option>
                            <option value="year">Year</option>
                            <option value="week">Week</option>
                            <option value="day">Day</option>
                        </select>
                    </div>
                </div>
            </div>
            
        </div>
        <hr class="border-gray-200">
        <div class="py-6 px-10">
            <label for="email" class="block uppercase tracking-wide text-gray-600 text-xs font-bold ml-1">When a recurring payment is received…</label>
            <div class="flex items-start mt-4">
                <label for="submitted" class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 p-1 rounded-full cursor-pointer">
                    <input type="radio" v-model="requiring_status" value="0" class="form-checkbox checkbox-sm focus:outline-none focus:shadow-outline">
                </label>
                <div>
                    <span id="submitted" class="ml-1 text-md text-gray-600">Do nothing</span>
                    <p class="help-block text-xs text-gray-600 ml-1">Order status and due date will not change.</p>
                </div>
            </div>
            <div class="flex items-start mt-4">
                <label for="submitted" class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 p-1 rounded-full cursor-pointer">
                    <input type="radio" v-model="requiring_status" value="1" class="form-checkbox checkbox-sm focus:outline-none focus:shadow-outline">
                </label>
                <div>
                    <span id="submitted" class="ml-1 text-md text-gray-600">Reopen order</span>
                    <p class="help-block text-xs text-gray-600 ml-1">Order will go back into <span class="text-indigo-500">Working</span> status with a new due date.</p>
                </div>
            </div>
            <div>
                <div class="flex items-start mt-4">
                    <label for="submitted" class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 p-1 rounded-full cursor-pointer">
                        <input type="radio" v-model="requiring_status" value="2" class="form-checkbox checkbox-sm focus:outline-none focus:shadow-outline">
                    </label>
                    <div>
                        <span id="submitted" class="ml-1 text-md text-gray-600">Let clients request up to 2 new orders / tasks as they need them</span>
                        <p class="help-block text-xs text-gray-600 ml-1">If you offer task-based services.</p>
                    </div>
                </div>
                <div class="row" v-if="requiring_status == 2">
                    <div class="ml-6 w-1/2 relative rounded-md shadow-sm">
                        <input type="number" v-model="request_quantity" class="mt-2 border-2 border-gray-200 pl-4 pr-16 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" placeholder="2">
                        <div class="absolute inset-y-0 right-0 flex items-center">
                            <div class="mr-2px focus:outline-none h-10 py-0 pl-2 pr-2 pt-2 border-transparent bg-gray-200 text-gray-500 sm:text-sm sm:leading-5 rounded-r-lg">
                                Orders
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    data() {
        return {

        }
    },

    methods: {
        // verify regular price inptu
        handleInput (e) {
            let stringValue = e.target.value.toString()
            let regex = /^\d*(\.\d{1,2})?$/
            if(!stringValue.match(regex) && this.price!== '') {
                this.price= this.previousPrice
            }
            this.previousPrice = this.price
        },

        // verify trail price inptu
        handleTrailPrice (e) {
            let stringValue = e.target.value.toString()
            let regex = /^\d*(\.\d{1,2})?$/
            if(!stringValue.match(regex) && this.trailPrice!== '') {
                this.trailPrice= this.previousPrice
            }
            this.previousPrice = this.trailPrice
        },
    },

    computed: {
        ...mapGetters('service', ['getCurrency']),

        // all input field
        currency: {
            get() {
                return this.$store.state.service.form.currency
            },
            set(value) {
               this.$store.dispatch('service/serviceCurrency', value)
            }
        },

        // all input field
        price: {
            get() {
                return this.$store.state.service.form.requiring_service.price
            },
            set(value) {
               this.$store.dispatch('service/requiringServicePrice', value)
            }
        },

        // all input field
        period: {
            get() {
                return this.$store.state.service.form.requiring_service.requring_period
            },
            set(value) {
               this.$store.dispatch('service/requiringServicePeriod', value)
            }
        },

        // all input field
        periodFor: {
            get() {
                return this.$store.state.service.form.requiring_service.requring_for
            },
            set(value) {
               this.$store.dispatch('service/requiringServicePeriodFor', value)
            }
        },

        // all input field
        trail: {
            get() {
                return this.$store.state.service.form.requiring_service.is_trail
            },
            set(value) {
               this.$store.dispatch('service/requiringServiceIsTrail', value)
            }
        },

        // all input field
        trailPrice: {
            get() {
                return this.$store.state.service.form.requiring_service.trail.price
            },
            set(value) {
               this.$store.dispatch('service/serrviceTrailPrice', value)
            }
        },

        // all input field
        trailPeriod: {
            get() {
                return this.$store.state.service.form.requiring_service.trail.period
            },
            set(value) {
               this.$store.dispatch('service/serrviceTrailPeriod', value)
            }
        },

        // all input field
        trailFor: {
            get() {
                return this.$store.state.service.form.requiring_service.trail.for
            },
            set(value) {
               this.$store.dispatch('service/serrviceTrailFor', value)
            }
        },

        // requiring status
        requiring_status: {
            get() {
                return this.$store.state.service.form.requiring_service.requiring_status
            },
            set(value) {
               this.$store.dispatch('service/requiringServiceStatus', value)
            }
        },

        // requiring status
        request_quantity: {
            get() {
                return this.$store.state.service.form.requiring_service.request_quantity
            },
            set(value) {
               this.$store.dispatch('service/requiringRequestQty', value)
            }
        },
    },


}
</script>