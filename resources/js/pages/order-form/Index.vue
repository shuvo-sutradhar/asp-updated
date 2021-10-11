<template>
	<div>
        <!-- breadcrumbs Start -->
        <breadcrumbs :items="breadcrumbs" :current="breadcrumbsCurrent" />
        <!-- breadcrumbs end -->

        <div class="main-content">
            <div class="pb-12 md:pb-0 flex justify-between items-center relative">
                <div class="flex">
                    <button @click="deleteSelected" v-if="this.$store.state.service.selected.length > 0" content="Delete selected" v-tippy='{ placement : "top", arrow : true }' class="rounded-lg shadow-sm inline-flex items-center bg-white hover:text-indigo-500 focus:outline-none focus:shadow-outline focus:border-indigo-200  text-gray-500 py-2 px-2 md:px-4 mr-2">
                        <i class="fas fa-trash-undo-alt"></i>
                    </button>

                    <div class="flex-1 absolute bottom-0 md:relative w-full md:w-1/4 focus-within:border-blue-500">
                         <search v-model="query" @reset-pagination="resetPagination()" @reload="reload" />
                    </div>
                </div>
                <div class="flex">
                    <router-link :to="{ name: 'form.create'}" v-ripple class="text-sm rounded-lg shadow inline-flex items-center bg-indigo-500 cursor-pointer focus:outline-none focus:shadow-outline text-white py-2 px-4">
                        <i class="fal fa-plus"></i>
                        <span class="ml-1">{{ $t('add_new') }}</span>
                    </router-link>
                    <button :content="layoutTbl ? 'Grid View' : 'Table View'" v-tippy='{ placement : "top", arrow : true }' 
                            @click="layoutTbl= !layoutTbl"
                            class="text-sm rounded-lg shadow inline-flex items-center bg-indigo-500 cursor-pointer focus:outline-none focus:shadow-outline text-white py-2 px-4 ml-2">
                        <i class="fad " :class="[ layoutTbl ? 'fa-th-large' :'fa-list-ul' ]"></i>
                    </button>
                </div>
            </div> <!-- table top search area -->


            <!-- Orders Grid Or Table Layout start -->
            <div>
                <service-table :services="services" :pagination="pagination" v-if="layoutTbl" class="py-3 md:py-6 animated fadeIn" />
                <service-card :services="services" v-else class="py-3 md:py-6 animated fadeIn" />
            </div> 
            <!-- Orders Grid Or Table Layout end -->
            
            <!-- pegination-start -->
            <pagination v-if="pagination.last_page > 1"
                    :pagination="pagination"
                    :offset="5"
                    class="justify-flex-end"
                    @paginate="paginate">
            </pagination>
            <!-- pegination-end -->
            
        </div>
	</div>
</template>

<script>
import ServiceCard from '~/components/Service/ServiceCard'
import ServiceTable from '~/components/Service/ServiceTable'
import { mapGetters } from "vuex"
export default {  
    middleware: ['auth','admin'],
    
    components: {
        ServiceCard, ServiceTable
    },

    metaInfo () {
        return { title: this.$t('Services') }
    },

    data: () => ({
        query:'',
        selected: [],
        selectAll:false,
        layoutTbl:true,
        breadcrumbsCurrent: 'Order Form',
        breadcrumbs:[
            {
                name:'Order Form',
                url: ''
            }
        ]
    }),

    watch:{
        // watch search data
        query: function(newQ, oldQ) {
            if(newQ==='') {
                console.log(newQ);
               this.getData();
            } else {
                console.log(oldQ);
                this.searchData();
            }
        }
    },

    // Map Getters
    computed: {
        ...mapGetters('service', ['services','pagination']),

    },
    

    // mounted
    mounted () {
       this.getData();
    },

    methods: {

        // get data 
        async getData() {
            this.$store.state.service.loading=true;
            await this.$store.dispatch('service/fetchService', this.pagination.current_page);
        },
        
        // search data
        async searchData() {
            this.$store.state.service.loading=true;
            await this.$store.dispatch('service/fetchSearchData', { query: this.query, current_page:this.pagination.current_page });
        },

        //Reload after search
        async reload() {
            this.query = '';
        },

        // Pagination
        async paginate(){
            this.query === '' ? this.getData() : this.searchData();
        },

        // Reset pagination
        async resetPagination() {
            this.pagination.current_page=1;
        },


        //Delete Selected data
        async deleteSelected() {
            Swal.fire({
                title: 'Are you sure to delete '+ this.$store.state.service.selected.length+' rows?',
                text: "You will not be able to return to this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.$store.dispatch('service/deleteServices')
                        .then((response)=>{
                           if(response==true) {
                               this.$store.state.service.selectAll = false;
                               Swal.fire('Deleted!','Your file has been deleted.','success' )
                           } else {
                               Swal.fire("Failed! "," There was something wrong.", "warning");
                           }
                        })
                    }
                })
        },


        // add tag modal
        open(name, tag=null) {
            this.$store.dispatch("modals/open", name);
            if(tag!=null){
                this.$store.state.tag.tagSlug=tag;
            }
        },


    },

}

</script>