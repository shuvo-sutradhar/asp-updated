<template>
	<div>
        <div class="breadcrumb flex border-b bg-gray-200 px-6 py-3 md:py-4 justify-between items-center">
		    <h1 class="text-md md:text-xl text-gray-600">Payments</h1>
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
                        <a href="#" class="text-gray-500" aria-current="page">Payments</a>
                    </li>
                </ol>
            </nav>
        </div><!-- BreadCrumn end -->

        <div class="main-content">
            <div class="container mx-auto max-w-3xl">
                <form action="#" method="POST" enctype="multipart/form-data">
                    <!-- @csrf -->
                    <div class="w-full bg-white rounded-lg mx-auto overflow-hidden rounded-b-none shadow">
                        <div class="py-8 px-16">
                            <label for="name" class="text-lg text-gray-600">Payment integrations</label>
                            <ul class="mt-2 border-2 bg-gray-100 border-gray-200 rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500">
                                <li class="px-3 py-2 border-b-2 border-gray-200">
                                    <router-link to="/" class="block text-indigo-500">Paypal</router-link>
                                </li>
                                <li class="px-3 py-2 border-b-2 border-gray-200">
                                    <router-link to="/" class="block text-indigo-500">Stripe</router-link>
                                </li>
                                <li class="px-3 py-2">
                                    <router-link to="/" class="block text-indigo-500">Manual Payment</router-link>
                                </li>
                            </ul>
                            <div class="mt-2 text-right">
                                <router-link to="/" class="text-indigo-500 border px-2 py-1 rounded border-indigo-500 text-xs">
                                   <i class="fal fa-plus"></i> Add Payment
                                </router-link>
                            </div>
                        </div>
                        <hr class="border-gray-200">
                        <div class="py-8 px-16">
                            <label for="email" class="text-lg text-gray-600">Currency</label>
                            <input class="mt-2 border-2 border-gray-200 px-3 py-2 block rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" type="email" name="email" value="">
                            <span class="text-xs text-gray-500">You can set a service-level currency in service settings.</span>
                        </div>
                        <hr class="border-gray-200">
                        <div class="py-8 px-16">
                            <label for="name" class="text-lg text-gray-600">Invoicing</label>
                            <div class="mt-2 flex">
                                <div class="mr-1 w-1/2">
                                    <input class=" mr-1 w-full border-2 border-gray-200 px-3 py-2 block rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" type="text" value="" name="name">
                                    <label class="text-xs text-gray-500">Invoice number prefix</label>
                                </div>
                                <div class="ml-1 w-1/2">
                                    <input class="mr-1 w-full border-2 border-gray-200 px-3 py-2 block rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" type="text" value="" name="name">
                                    <label class="text-xs text-gray-500">Starting invoice number</label>
                                </div>
                            </div>
                            <div class="mt-4 w-full">
                                <input class="mt-2 mr-1 w-full border-2 border-gray-200 px-3 py-2 block rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" type="text" value="" name="name">
                                <label class="text-xs text-gray-500">Company details</label>
                            </div>
                        </div>
                        <hr class="border-gray-200">
                        <div class="py-8 px-16">
                            <label for="email" class="text-lg text-gray-600">Company name</label>
                            <input class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" type="email" name="email" value="">
                        </div>
                        <hr class="border-gray-200">
                        <div class="py-8 px-16">
                            <div class="flex items-center">
                                <label class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                                    <input type="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline">
                                </label>
                                <label for="email" class="text-lg text-gray-600">Test mode <a href="#"><i class="fad fa-question-circle text-indigo-500"></i></a></label>
                            </div>
                            <p class="ml-8 text-xs text-gray-500">Make test payments without transferring real money.</p>
                            <div class="ml-8 bg-pink-100 border-l-4 border-pink-500 text-pink-500 p-4 mt-3 rounded-lg" role="alert">
                                <p>Turn off test mode to start accepting client payments.</p>
                            </div>
                        </div>
                        <hr class="border-gray-200">
                        <div class="py-8 px-16">
                            <div class="flex items-center">
                                <label class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                                    <input type="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline" v-model="chargeTax">
                                </label>
                                <label for="email" class="text-lg text-gray-600">Charge tax <a href="#"><i class="fad fa-question-circle text-indigo-500"></i></a></label>
                            </div>
                            <div v-if="chargeTax">
                                <ul class="mt-2 ml-2 border border-gray-200 rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500">
                                    <li class="px-3 py-2 border-b border-gray-200 flex justify-between">
                                        <router-link to="/" class="block text-indigo-500">VAT</router-link>
                                        <span class="px-3 py-1 text-sm text-indigo-500 bg-indigo-100 rounded-full font-semibold">10%</span>
                                    </li>
                                    <li class="px-3 py-2 border-b border-gray-200 flex justify-between">
                                        <router-link to="/" class="block text-indigo-500">Rest of the world</router-link>
                                        <span class="px-3 py-1 text-sm text-indigo-500 bg-indigo-100 rounded-full font-semibold">10%</span>
                                    </li>
                                </ul>
                                <div class="mt-2 text-right">
                                    <router-link to="/" class="text-indigo-500 border px-2 py-1 rounded border-indigo-500 text-xs">
                                    <i class="fal fa-plus"></i> Add Rule
                                    </router-link>
                                </div>                                
                            </div>

                        </div>
                    </div>
                    <div class="p-16 py-8 bg-gray-300 clearfix rounded-b-lg border-t border-gray-200">
                        <p class="float-left text-xs text-gray-500 tracking-tight mt-2">Click on Save to update your Profile Info</p>
                        <input type="submit" class="bg-indigo-500 text-white text-sm font-medium px-6 py-2 rounded float-right uppercase cursor-pointer" value="Save">
                    </div>
                </form>
            </div>
        </div>
	</div>
</template>

<script>


export default {  
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('General Settings') }
  },

  data: () => ({
      chargeTax:true
  }),
}

</script>