<template>
    <div>
        <div class="md:pb-0 mb-4 flex justify-between items-center relative">
            <h2 class="text-xl text-gray-600">{{ $t('roles') }}</h2>
            <div class="flex">
                <router-link :to="{ name: 'role.create'  }" v-ripple class="text-sm rounded-lg shadow inline-flex items-center bg-indigo-500 focus:outline-none focus:shadow-outline text-white py-2 px-4">
                    <i class="fal fa-plus"></i>
                    <span class="ml-1">{{ $t('add_new') }}</span>
                </router-link>
            </div>
        </div> <!-- tbl-header -->
        
        <div class="relative">

            <table-loading v-show="loading" />
            <ul class="mt-2 border-2 bg-white border-gray-200 rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500">
                <li v-show="roles.length" v-for="(data, key) in roles" :key="key" class="px-3 py-2 border-b border-gray-200 flex justify-between items-center">
                    <router-link :to="{ name: 'role.edit', params: { slug: data.slug } }" class="block text-indigo-500">{{ data.name }}</router-link>
                    <base-dropdown tag="div" class="md:relative animated py-1 md:py-0">
                        <button slot="title" content="Options" v-tippy='{ placement : "top", arrow : true }' class="w-8 h-8 text-indigo-500 rounded-full bg-white shadow border-2 border-indigo-500 cursor-pointer relative z-10 focus:outline-none focus:shadow-outline focus:bg-blue-100">
                            <i class="fad fa-ellipsis-v font-lg "></i>
                        </button>
                        <template>
                            <div class="text-left text-gray-500 menu rounded bg-white shadow-2xl absolute z-20 right-0 w-32 mt-2 py-2 -mt-10 mr-12 md:border-t md:border-b md:border-gray-200 animated faster">

                                <!-- item -->
                                <router-link :to="{ name: 'role.edit', params: { slug: data.slug } }" class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-100 hover:text-gray-900 transition-all duration-300 ease-in-out">
                                    <i class="fad fa-user-edit text-xs mr-1"></i>
                                    Edit
                                </router-link>     
                                <!-- end item -->


                                <!-- item -->
                                <a @click="deleteData(data.slug)" class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-100 hover:text-gray-900 transition-all duration-300 ease-in-out" href="#">
                                    <i class="fad fa-inbox-in text-xs mr-1"></i>
                                    Delete
                                </a>     
                                <!-- end item -->

                            </div>
                        </template>
                    </base-dropdown>
                </li>
                <li v-show="!loading && !roles.length">
                    <div class="text-center py-8">
                        <img class="m-auto" src="/img/empty.svg" alt="test" />
                        <p class="font-bold text-lg text-gray-600">{{ $t('sorry') }} :( {{ $t('no_data_found') }}</p>
                    </div>
                </li>
            </ul>
        </div>

        <!-- pegination-start -->
        <!-- <pagination v-if="pagination.last_page > 1"
                :pagination="pagination"
                :offset="5"
                class="justify-flex-end"
                @paginate="paginate">
        </pagination> -->
        <!-- pegination-end -->
    </div>
</template>


<script>
import { mapGetters } from "vuex"
export default {
    data: () => ({
 
    }),

    methods: {

        // get data 
        async getData() {
            this.$store.state.role.loading=true;
            await this.$store.dispatch('role/fetchRoles');
        },

        // Pagination
        async paginate(){
            this.getData();
        },

        //delete data
        async deleteData(roleSlug) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will not be able to return to this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete it!'
                }).then((result) => {
                    // Send request to the server
                    if (result.value) {
                        this.$store.dispatch('role/deleteRoles', roleSlug)
                        .then((response)=>{
                           if(response==true) {
                               Swal.fire('Deleted!','Your file has been deleted.','success' )
                           } else {
                               Swal.fire("Failed! "," There was something wrong.", "warning");
                           }
                        })
                    }
                })
        }
    },

    // Map Getters
    computed: {
        ...mapGetters('role', ['roles','loading','deleted']),
    },
    

    created() {
        this.getData();
    }
}
</script>