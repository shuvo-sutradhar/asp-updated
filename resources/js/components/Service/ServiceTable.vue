<template>
    <div class="grid">

        <div class="grid relative">

            <table-loading v-show="this.$store.state.service.loading" />
            <div class="overflow-x-auto shadow rounded-lg flex relative tbl-height">
                <table class="w-full whitespace-no-wrap bg-white table-striped">
                    <thead>
                        <tr class="text-left bg-gray-200">
                            <th class="py-2 px-2 sticky top-0 border-b border-r bg-gray-200 border-gray-300">
                                <checkbox v-model="selectAll" @click="select" class="text-center" />
                            </th>
                            <th class="sticky top-0 bg-gray-200 border-b border-r border-gray-300 text-left px-6 pl-8 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                <span>Name</span>
                            </th>
                            <th class="sticky top-0 bg-gray-200 border-b border-r border-gray-300 text-center px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center pr-4">Price</th>                    
                            <th class="sticky top-0 bg-gray-200 border-b border-r border-gray-300 text-center px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center pr-4">Orders</th>                    
                            <th class="sticky top-0 bg-gray-200 border-b border-r border-gray-300 text-center px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center pr-4">Status</th>                    
                            <th class="sticky top-0 bg-gray-200 border-b border-r border-gray-300 text-center px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center pr-4">Created At</th>                   
                            <th class="sticky z-20 top-0 bg-gray-200 border-b border-r border-gray-300 text-center px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-right pr-4">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-show="services.length" v-for="(data, index) in services" :key="index" class="hover:bg-gray-100">
                            <td class="border-dashed border-t border-r border-gray-300 px-2 text-center">
                                <label class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 p-1 -ml-1 rounded-lg cursor-pointer">
                                    <input type="checkbox" :value="data.slug" v-model="selected" class="form-checkbox focus:outline-none focus:shadow-outline w-4 h-4" >
                                </label>
                            </td>
                            <td class="border-dashed border-t border-r border-gray-300 py-5 pl-8 px-3 text-left">
                                <router-link to="">
                                    <span class="text-indigo-500">{{ data.name }}</span>
                                </router-link>
                            </td>
 
                            <td class="border-dashed border-t border-r border-gray-300 py-2 text-gray-600 px-6 text-center">
                                $12.00 for 1 month, then $15.00/month
                            </td>
 
                            <td class="border-dashed border-t border-r border-gray-300 py-2 text-gray-600 px-6 text-center">
                                <span content="10 orders complted" v-tippy='{ placement : "top", arrow : true }' class="mt-2 bg-gray-200 text-gray-600 text-sm px-3 py-1 rounded-full tracking-wide h-10 w-10 flex items-center content-center m-auto shadow">
                                    10
                                </span>
                            </td>
 
                            <td class="border-dashed border-t border-r border-gray-300 py-2 text-gray-600 px-6 text-center">
                                <span class="mt-2 bg-indigo-200 text-indigo-600 text-sm px-3 py-1 rounded-full tracking-wide">Active</span>
                            </td>
                            <td class="border-dashed border-t border-r border-gray-300 py-2 text-gray-600 px-6 text-center">
                                 <span>{{ data.created_at | moment("from","now") }}</span>
                            </td>

                            <td class="border-dashed border-t border-gray-300 text-right pr-4">
                                <base-dropdown tag="div" class="md:relative animated py-1 md:py-0">
                                    <button slot="title" content="Options" v-tippy='{ placement : "top", arrow : true }' class="w-10 h-10 text-gray-500 rounded-full bg-gray-200 shadow py-2 px-2 cursor-pointer relative focus:outline-none hover:bg-gray-300 focus:shadow-outline focus:bg-gray-100">
                                        <em class="far fa-ellipsis-h text-lg font-bold"></em>
                                    </button>
                                    <template>
                                        <div class="text-left text-gray-500 menu rounded bg-white shadow-2xl absolute z-20 right-0 w-32 mt-2 py-2 -mt-10 mr-12 md:border-t md:border-b md:border-gray-200 animated faster">

                                            <!-- item -->
                                            <router-link :to="{ name: 'team.edit', params: { slug: data.slug } }" class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-100 hover:text-gray-900 transition-all duration-300 ease-in-out" href="#">
                                                <em class="fad fa-eye text-xs mr-1"></em>
                                                View
                                            </router-link>     
                                            <!-- end item -->

                                            <!-- item -->
                                            <a @click="open('editTag', data)" class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-100 hover:text-gray-900 transition-all duration-300 ease-in-out" href="#">
                                                <em class="fad fa-user-edit text-xs mr-1"></em>
                                                Edit
                                            </a>     
                                            <!-- end item -->

                                            <!-- item -->
                                            <a @click="deleteData(data.slug)" class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-100 hover:text-gray-900 transition-all duration-300 ease-in-out" href="#">
                                                <em class="fad fa-inbox-in text-xs mr-1"></em>
                                                Delete
                                            </a>     
                                            <!-- end item -->
                                        </div>
                                    </template>
                                </base-dropdown>
                            </td>
                        </tr>
                        <tr v-show="!this.$store.state.service.loading && !services.length">
                            <td colspan="6">
                                <div class="text-center py-8">
                                    <img class="m-auto" src="/img/empty.svg" alt="test" />
                                    <p class="font-bold text-lg text-gray-600">{{ $t('sorry') }} :( {{ $t('no_data_found') }}</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions , mapGetters } from "vuex"
    export default {
        props:['services'],

        data: () => ({ 

        }),

        computed: {
            ...mapGetters('service', ['getSelectedArray']),
            ...mapActions('service', ['setSelectedArray']),

            selected: {
                get () { 
                    return this.getSelectedArray 
                },
                set (val) {
                    this.$store.dispatch('service/setSelectedArray', val)
                }
            },

            selectAll: {
                get () { 
                    return this.$store.state.service.selectAll
                },
                set (val) {
                    this.$store.dispatch('service/selectedCkbox', val)
                }
            }

        },

        methods: {

            async select() {
                if (!this.selectAll) {
                    for (let i in this.services) {
                        this.$store.state.service.selected.push(this.services[i].slug);
                    }
                } else {
                    this.$store.state.service.selected = [];
                }
            },


        //delete data
        async deleteData(slug) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will not be able to return to this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.$store.dispatch('service/deleteService', slug)
                        .then((response)=>{
                           if(response==true) {
                               Swal.fire('Deleted!','Your file has been deleted.','success' )
                           } else {
                               Swal.fire("Failed! "," There was something wrong.", "warning");
                           }
                        })
                    }
                })
        },

        }
    }
</script>