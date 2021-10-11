<template>
    <div class="container mx-auto max-w-4xl">
        <div class="pb-12 md:pb-0 mb-4 flex justify-between items-center relative">
            <div class="flex">
                <button @click="deleteSelected" v-if="selected.length > 0" content="Delete selected" v-tippy='{ placement : "top", arrow : true }' class="rounded-lg shadow-sm inline-flex items-center bg-white hover:text-indigo-500 focus:outline-none focus:shadow-outline focus:border-indigo-200  text-gray-500 py-2 px-2 md:px-4 mr-2">
                    <i class="fas fa-trash-undo-alt"></i>
                </button>

                <div class="flex-1 absolute bottom-0 md:relative w-full md:w-1/4 focus-within:border-blue-500">
                    <search v-model="query" @reset-pagination="resetPagination()" @reload="reload" />
                </div>
            </div>
            <div class="flex">
                <a @click="open('createTag')" v-ripple class="text-sm rounded-lg shadow inline-flex items-center bg-indigo-500 cursor-pointer focus:outline-none focus:shadow-outline text-white py-2 px-4">
                    <em class="fal fa-plus"></em>
                    <span class="ml-1">{{ $t('add_new') }}</span>
                </a>
            </div>
        </div> <!-- table top search area -->

        <div class="grid relative">
            <table-loading v-show="loading" />
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
                            <th class="sticky top-0 bg-gray-200 border-b border-r border-gray-300 text-center px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center pr-4">Orders</th>                   
                            <th class="sticky top-0 bg-gray-200 border-b border-r border-gray-300 text-center px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center pr-4">Created At</th>                   
                            <th class="sticky z-20 top-0 bg-gray-200 border-b border-r border-gray-300 text-center px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-right pr-4">Action</th>
                        </tr>
                    </thead>
                
                    <tbody>
                        <tr v-show="tags.length" v-for="(data, index) in tags" :key="index" class="hover:bg-gray-100">
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
                                10
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
                        <tr v-show="!loading && !tags.length">
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

        <!-- pegination-start -->
        <pagination v-if="pagination.last_page > 1"
                :pagination="pagination"
                :offset="5"
                class="justify-flex-end"
                @paginate="paginate">
        </pagination>
        <!-- pegination-end -->

        <tag-create />
        <tag-edit v-if="this.$store.state.tag.tagSlug" :data="this.$store.state.tag.tagSlug"></tag-edit>
    </div>
</template>


<script>
import TagCreate from '~/components/Tag/Create'
import TagEdit from '~/components/Tag/Edit'
import { mapGetters } from "vuex"
export default {
    data: () => ({ 
        remember:'',
        query:'',
        selected: [],
        selectAll:false,
    }),

    components: {
        TagCreate,
        TagEdit,
    },

    watch:{
        // watch search data
        query: function(newQ, oldQ) {
            if(newQ==='') {
               this.getData();
            } else {
                this.searchData();
            }
        }
    },

    // Map Getters
    computed: {
        ...mapGetters('tag', ['tags','loading','pagination']),
    },
    
    // mounted
    mounted () {
       this.getData();
    },

    // methods  
    methods: {
        
        // get data 
        async getData() {
            this.$store.state.tag.loading=true;
            await this.$store.dispatch('tag/fetchTag', this.pagination.current_page);
        },
        
        // search data
        async searchData() {
            this.$store.state.tag.loading=true;
            await this.$store.dispatch('tag/fetchSearchData', { query: this.query, current_page:this.pagination.current_page });
        },

        //Reload after search
        async reload() {
            this.query = '';
        },

        // Pagination
        async paginate(){
            this.query ==='' ? this.getData() : this.searchData();
        },

        // Reset pagination
        async resetPagination() {
            this.pagination.current_page=1;
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
                        this.$store.dispatch('tag/deleteTag', slug)
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

        //Delete Selected data
        async deleteSelected() {
            Swal.fire({
                title: 'Are you sure to delete '+ this.selected.length+' rows?',
                text: "You will not be able to return to this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.$store.dispatch('tag/deleteTags', this.selected)
                        .then((response)=>{
                           if(response==true) {
                               this.selectAll=false;
                               Swal.fire('Deleted!','Your file has been deleted.','success' )
                           } else {
                               Swal.fire("Failed! "," There was something wrong.", "warning");
                           }
                        })
                    }
                })
        },

        select() {
			this.selected = [];
			if (!this.selectAll) {
				for (let i in this.tags) {
					this.selected.push(this.tags[i].slug);
				}
			}
        },

        // add tag modal
        open(name, tag=null) {
            this.$store.dispatch("modals/open", name);
            if(tag!=null){
                this.$store.state.tag.tagSlug=tag;
            }
        }

    },

}
</script>
