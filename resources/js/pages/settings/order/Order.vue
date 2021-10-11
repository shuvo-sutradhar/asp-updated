<template>
	<div>
        <div class="breadcrumb flex  border-b bg-gray-200 px-6 py-3 md:py-4 justify-between items-center">
		    <h1 class="text-md md:text-xl text-gray-600">Orders</h1>
            <nav aria-label="Breadcrumb">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                        <router-link :to="{ name: 'home' }" class="text-indigo-600">
                            <i class="fad fa-home"></i>
                        </router-link>
                        <svg class="fill-current w-3 h-3 mx-3 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                    </li>
                    <li class="flex items-center">
                        <router-link :to="{ name: 'settings' }" class="text-indigo-600">
                           Settings
                        </router-link>
                        <svg class="fill-current w-3 h-3 mx-3 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                    </li>
                    <li>
                        <a href="#" class="text-gray-500" aria-current="page">Orders</a>
                    </li>
                </ol>
            </nav>
        </div><!-- BreadCrumn end -->

        <div class="main-content">
            <div class="container mx-auto max-w-3xl">
                <form @submit.prevent="update" @keydown="form.onKeydown($event)">
                    <!-- @csrf -->
                    <div class="w-full bg-white rounded-lg mx-auto overflow-hidden rounded-b-none shadow">
                        <div class="py-8 px-16">
                            <label for="name" class="text-lg text-gray-600">Order status</label>
                            <ul class="mt-2 border-2 bg-gray-100 border-gray-200 rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500">
                                <li class="px-3 py-2 border-b-2 border-gray-200">
                                    <span class="inline-block bg-yellow-200 text-yellow-700 text-xs font-semibold px-2 py-1 rounded-full tracking-wide capitalize">pending</span>
                                    <p class="text-xs text-gray-500 mt-2 ml-2 font-medium">Waiting for client to submit project details</p>
                                </li>
                                <li class="px-3 py-2 border-b-2 border-gray-200">
                                    <span class="inline-block bg-pink-200 text-pink-500 text-xs font-semibold px-2 py-1 rounded-full tracking-wide capitalize">Submitted</span>
                                    <p class="text-xs text-gray-500 mt-2 ml-2 font-medium">Client has submitted project details</p>
                                </li>
                                <li class="px-3 py-2 border-b-2 border-gray-200">
                                    <span class="inline-block bg-indigo-200 text-indigo-500 text-xs font-semibold px-2 py-1 rounded-full tracking-wide capitalize">Working</span>
                                    <p class="text-xs text-gray-500 mt-2 ml-2 font-medium">Order is in progress</p>
                                </li>
                                <li class="px-3 py-2 border-b-2 border-gray-200">
                                    <span class="inline-block bg-green-200 text-green-500 text-xs font-semibold px-2 py-1 rounded-full tracking-wide capitalize">completed</span>
                                    <p class="text-xs text-gray-500 mt-2 ml-2 font-medium">Order has been delivered</p>
                                </li>
                                <li class="px-3 py-2">
                                    <span class="inline-block bg-red-200 text-red-500 text-xs font-semibold px-2 py-1 rounded-full tracking-wide capitalize">Canceled</span>
                                    <p class="text-xs text-gray-500 mt-2 ml-2 font-medium">Order stopped due to a refund</p>
                                </li>
                            </ul>
                        </div>

                        <hr class="border-gray-200">
                        <div class="py-8 px-16">
                            <label for="initialOrderStatus" class="text-lg text-gray-600"> Initial order status</label>
                            <div class="flex items-start mt-4">
                                <label for="submitted" class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 p-1 rounded-full cursor-pointer">
                                    <input v-model="form.initialOrderStatus" value="submitted" type="radio" class="form-checkbox checkbox-sm focus:outline-none focus:shadow-outline">
                                </label>
                                <div>
                                    <span id="submitted" class="ml-1 text-md text-gray-600">Submitted</span>
                                    <p class="help-block text-xs font-medium text-gray-600 ml-1">New orders will show as <span class="bg-pink-400 text-white p-1 rounded-full">Submitted</span> and you can set them to <span class="bg-indigo-400 text-white p-1 rounded-full">Working</span> when work has been started.</p>
                                </div>
                            </div>
                            <div class="flex items-start mt-4">
                                <label for="submitted2" class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 p-1 rounded-full cursor-pointer">
                                    <input v-model="form.initialOrderStatus" value="working" id="submitted2" type="radio" class="form-checkbox checkbox-sm focus:outline-none focus:shadow-outline">
                                </label>
                                <div>
                                    <span id="submitted2" class="ml-1 text-md text-gray-600">Working</span>
                                    <p class="help-block text-xs font-medium text-gray-600 ml-1">Skip the  <span class=" bg-pink-400 text-white p-1 rounded-full leading-6">Submitted</span> status and set orders to <span class="bg-indigo-400 text-white p-1 rounded-full">Working</span> automaticaly.</p>
                                </div>
                            </div>
                        </div>

                        <hr class="border-gray-200">
                        <div class="py-8 px-16">
                            <checkbox v-model="form.revision" name="remember" class="flex items-start mb-3">
                                <label for="email" class="text-lg text-gray-600">Allow Order Request Revision<a href="#"><i class="fad fa-question-circle text-indigo-500"></i></a></label>
                                <p class="text-xs text-gray-500">Make test payments without transferring real money.</p>
                            </checkbox>                            
                        </div>
                        <hr class="border-gray-200">
                        <div class="py-8 px-16" v-if="form.revision">
                            <div>
                                <label for="email" class="text-lg text-gray-600">Change status of completed orders when client sends a message or requests a revision <a href="#"><i class="fad fa-question-circle text-indigo-500"></i></a></label>
                                <div class="w-full">
                                    <select v-model="form.revisionOrderStatus"  class="text-gray-600 border-2 border-gray-300 rounded mt-2 p-2 w-full focus:outline-none focus:border-indigo-500">
                                        <option value="working">Working</option>
                                        <option value="pending">Pending</option>
                                        <option value="submitted">Submitted</option>
                                        <option value="canceled">Canceled</option>
                                    </select>                               
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-16 py-8 bg-gray-300 clearfix rounded-b-lg border-t border-gray-200">
                        <router-link :to="{ name: 'settings'  }" v-ripple class="text-sm rounded-lg shadow inline-flex items-center bg-pink-500 focus:outline-none focus:shadow-outline text-white py-2 px-4">
                            <i class="fad fa-undo-alt"></i>
                            <span class="ml-1">Go back</span>
                        </router-link>
                        <v-button :loading="form.busy" v-ripple class="float-right cursor-pointer w-full sm:w-auto bg-indigo-500 text-indigo-100 py-2 px-4 rounded-lg hover:bg-indigo-600 focus:outline-none cursor-pointer">
                            <span class="mr-1">Save</span>
                            <i class="fad fa-forward"></i>
                        </v-button>
                    </div>
                </form>
            </div>
        </div>
	</div>
</template>

<script>

import { mapGetters } from 'vuex'
import Form from 'vform'

export default {  
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('General Settings') }
  },

  data: () => ({
      form: new Form({
          initialOrderStatus:'',
          revision:null,
          revisionOrderStatus:'',
      })
  }),



  methods: {
    async orderSettings() {
        // Fetch the account settings.
        await this.$store.dispatch('orderSettings/fetchOrderSetting');
        this.form.initialOrderStatus  = this.settings[0].value;
        this.form.revision            = Boolean(this.settings[1].value);
        this.form.revisionOrderStatus = this.settings[2].value;
    },

    // update role and permission
    async update(){
        await this.form.post(window.location.origin+'/api/order-settings')
            .then(()=>{
                toast.fire({type: 'success',title: 'Order settings updated.'})
            }).catch(()=>{
                toast.fire({type: 'error',title: 'Opps...something is wrong 😔'})
            });
    }

  },


  // Map Getters
  computed: mapGetters({
    settings: 'orderSettings/getSettings',
  }),

  mounted() {
      this.orderSettings();
  },

}

</script>