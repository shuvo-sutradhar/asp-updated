<template>
    <div>
        <div class="py-6 px-10">
            <label for="price" class="block uppercase tracking-wide text-gray-600 text-xs font-bold ml-1">Price</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                    <span class="ml-2px text-gray-500 h-10 sm:text-sm px-4 py-2 sm:leading-5 bg-gray-200 rounded-l-lg">
                        {{currency.symbol}}
                    </span>
                </div>
                <input type="number" @input="handleInput" v-model.number="price" class="mt-2 border-2 border-gray-200 pl-12 pr-16 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" placeholder="0.00">
                <div class="absolute inset-y-0 right-0 flex items-center">
                    <select v-model="currency" class="mr-2px focus:outline-none h-10 py-0 pl-2 pr-2 border-transparent bg-gray-200 text-gray-500 sm:text-sm sm:leading-5 rounded-r-lg">
                        <option v-for="(currency , index) in getCurrency" 
                                :key="index" :value="currency">{{ currency.name }}</option>
                    </select>
                </div>
            </div>
            <button @click="open('multiple-pricing')" class="text-indigo-500 text-sm focus:outline-none hover:text-indigo-600 mt-2">Create multiple pricing options?</button>
        </div>
        <hr class="border-gray-200">
        <div class="py-6 px-10">
            <div class="flex -ml-2">
                <checkbox v-model="isMultiOrder" @click="multi_order" class="flex items-center mb-2">
                    <span class="block uppercase tracking-wide text-gray-600 text-xs font-bold">Create multiple orders? <a href="#"><i class="fad fa-question-circle text-indigo-500"></i></a></span>
                </checkbox>
            </div>
            <div v-if="quantity > 1">
                <div class="ml-6 w-1/2 relative rounded-md shadow-sm">
                    <input type="number" v-model="quantity" class="mt-2 border-2 border-gray-200 pl-4 pr-16 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" placeholder="2">
                    <div class="absolute inset-y-0 right-0 flex items-center">
                        <div class="mr-2px focus:outline-none h-10 py-0 pl-2 pr-2 pt-2 border-transparent bg-gray-200 text-gray-500 sm:text-sm sm:leading-5 rounded-r-lg">
                            Orders
                        </div>
                    </div>
                </div>
                <p class="ml-6 mt-2 help-block text-xs font-medium text-gray-600 ml-1">{{quantity}} new orders will be created when this service is purchased.</p>
            </div>
        </div>
        <!-- Multiple pricing option start -->
        <multi-pricing></multi-pricing>
        <!-- Multiple pricing option end -->
    </div>
</template>

<script>
import MultiPricing from '~/components/Service/CreateHelper/MultiPricing'
import { mapGetters } from 'vuex'
export default {
    data() {
        return {
            isMultiOrder: false,
        }
    }, 


    components: {
        MultiPricing
    },

    computed: {
        ...mapGetters('service', ['getCurrency']),

        // all input field
        price: {
            get() {
                return this.$store.state.service.form.onetime_service.price
            },
            set(value) {
               this.$store.dispatch('service/oneTimeServicePrice', value)
            }
        },

        // all input field
        quantity: {
            get() {
                return this.$store.state.service.form.onetime_service.quantity
            },
            set(value) {
               this.isMultiOrder = value > 1 ? true : false;
               this.$store.dispatch('service/oneTimeServiceQty', value)
            }
        },

        // all input field
        currency: {
            get() {
                return this.$store.state.service.form.currency
            },
            set(value) {
               this.$store.dispatch('service/serviceCurrency', value)
            }
        },

    },

    methods:{
        
        multi_order() {
            if(this.isMultiOrder==false) {
                this.$store.dispatch('service/oneTimeServiceQty', 2);
            } else {
                this.$store.dispatch('service/oneTimeServiceQty', 1);
            }
            return this.isMultiOrder = !this.isMultiOrder;
        },

        setQuantity() {
            return  this.isMultiOrder = this.quantity > 1 ? true : false;
        },

        // add tag modal
        open(name) {
            this.$store.dispatch("sidebarDrawer/open", name);
        },

        handleInput (e) {
            let stringValue = e.target.value.toString()
            let regex = /^\d*(\.\d{1,2})?$/
            if(!stringValue.match(regex) && this.price!== '') {
                this.price= this.previousPrice
            }
            this.previousPrice = this.price
        }

    },

    created(){
        this.setQuantity();
    }
}
</script>