<template>
    <div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 py-3 md:py-6 animated fadeIn">
            <div class="order-single opt-hover" v-for="(data, index) in services" :key="index" >
                <div class="bg-white shadow-xl rounded-lg  overflow-hidden">
                    <div class="bg-cover bg-center h-56 p-4 relative">
                        <img class="absolute inset-0 w-full h-full object-cover" src="https://images.unsplash.com/photo-1475855581690-80accde3ae2b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="img" />
                        
                        <!-- order top btn start -->
                        <label class="text-teal-500 absolute top-0 left-0 z-10  ml-3 mt-4 inline-flex justify-between items-center hover:bg-indigo-200 px-2 py-2 rounded-full cursor-pointer">
                            <input type="checkbox" class="form-checkbox checkbox-lg focus:outline-none focus:shadow-outline">
                        </label>
                        <div class="flex justify-end">
                            <base-dropdown tag="div" class="md:relative bg-gray-200 md:bg-transparent animated py-1 md:py-0 tgl">
                                <button slot="title" content="Options" v-tippy='{ placement : "top", arrow : true }' class="w-10 h-10 text-indigo-500 rounded-full bg-white shadow py-2 px-2 border-2 border-indigo-500 cursor-pointer relative z-10 focus:outline-none focus:shadow-outline focus:bg-blue-100">
                                    <i class="fad fa-ellipsis-v font-2xl "></i>
                                </button>
                                <template>
                                    <div class="text-gray-500 menu rounded bg-white shadow-md absolute z-20 right-0 w-32 mt-12 mt-2 py-2 md:border-t md:border-b md:border-gray-200 animated faster">

                                        <!-- item -->
                                        <router-link :to="{ name: 'orderDetails', params: { orderNumber: 123 } }" class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out" href="#">
                                        <i class="fad fa-user-edit text-xs mr-1"></i>
                                            View
                                        </router-link>     
                                        <!-- end item -->

                                        <!-- item -->
                                        <a class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out" href="#">
                                            <i class="fad fa-inbox-in text-xs mr-1"></i>
                                            Edit
                                        </a>     
                                        <!-- end item -->

                                        <!-- item -->
                                        <a class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out" href="#">
                                            <i class="fad fa-inbox-in text-xs mr-1"></i>
                                            Delete
                                        </a>     
                                        <!-- end item -->

                                    </div>
                                </template>
                            </base-dropdown>
                        </div>
                        <!-- order top btn end -->

                        <div class="text-sm absolute bottom-0 left-0 z-10  px-3 py-1 mb-4 ml-2">
                            <span class="mt-2 bg-indigo-500 text-white text-sm px-3 py-1 rounded-full shadow uppercase font-medium tracking-wide">Active</span>
                        </div>
                        <!-- service status -->
                        
                    </div>
                    <div class="p-4 text-center">
                        <h3 class="text-xl text-gray-700">Police Unit K-9 Police Unit K-9 </h3>
                        <p class="text-gray-700 mt-1 mb-2 px-3 py-1 bg-gray-200 inline-block rounded-md">Price <a href="#" class="font-bold text-indigo-500">$100 / Month</a></p>
                        <p class="text-gray-500">Material: 4.3 oz., 13 colors are 100% combed ringspun cotton. Machine Wash Cold, Tumble Dry Low. Sizing offered: XS - 3XL</p>
                        <!-- <a href="" class="block px-3 py-2 bg-indigo-200 text-indigo-500 rounded text-center mt-3">Add to cart</a> -->
                    </div>
                </div>
            </div>
        </div>
        <div v-show="!this.$store.state.service.loading && !services.length">
            <div class="w-full bg-white p-10 shadow rounded">
                <div class="text-center py-8">
                    <img class="m-auto" src="/img/empty.svg" alt="test" />
                    <p class="font-bold text-lg text-gray-600">{{ $t('sorry') }} :( {{ $t('no_data_found') }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['services']
}
</script>