<template>
	<div>
        <div class="breadcrumb flex  border-b bg-gray-200 px-6 py-3 md:py-4 justify-between items-center">
		    <h1 class="text-md md:text-xl text-gray-600">Logs</h1>
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
                        <a href="#" class="text-gray-500" aria-current="page">Logs</a>
                    </li>
                </ol>
            </nav>
        </div><!-- BreadCrumn end -->

        <div class="main-content">
            <div class="container mx-auto max-w-3xl">
                <div class="py-6 flex justify-between items-center sticky bg-gray-100 z-10 top-80">
                        <h2 class="text-xl text-gray-600">Activity log</h2>
                    <div class="flex">
                        <button @click="clear" v-ripple class="text-sm rounded-lg shadow inline-flex items-center bg-indigo-500 focus:outline-none focus:shadow-outline text-white py-2 px-4">
                            <i class="fad fa-trash mr-2"></i>
                            <span class="ml-1">Clear All</span>
                        </button>
                    </div>
                </div> <!-- table top search area -->

                <div>
                    <div class="rounded-r-md overflow-hidden">
                        <div v-for="(log, index) in logs" :key="index" class="relative bg-white overflow-hidden rounded-l-md border-l-2 border-indigo-400 cursor-pointer hover:bg-gray-100">
                            <div class="flex p-4 flex justify-between logs" :class="[logs.length-1 != index ? 'border-b border-gray-100 ' : '']">
                                <div>
                                    <p class="text-gray-600 text-md">{{ log.description }}</p>
                                    <p class="text-gray-500 text-xs">
                                        By 
                                        <router-link to="" v-if="log.causer!='Unknown'">{{ log.causer }}</router-link>
                                        <span v-else>Unknown</span>
                                        | <span class="text-gray-700">{{ log.created_at | moment('from','now') }}</span>
                                    </p>
                                </div>
                                <button v-ripple class="w-8 h-8 shadow rounded" @click="deleteData(log.id, index)"><i class="fad fa-trash text-pink-500"></i></button>
                            </div>
                        </div>
                        <hr class="border-gray-200">
                    </div>

                    <infinite-loading @infinite="infiniteHandler" class="mt-32">
                        <span slot="no-more">
                        There is no more notification...
                        </span>
                    </infinite-loading>
                </div>

 
            </div>
        </div>
	</div>
</template>

<script>
import axios from 'axios'
export default {  
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('General Settings') }
  },

  data: () => ({
      logs:[],
      page: 1,
  }),

  methods:{

        infiniteHandler($state) {
            axios.get('/api/activity-log', {
                params: {
                    page: this.page,
                },
            }).then(({ data }) => {
                if (data.data.length) {
                    this.page += 1;
                    this.logs = this.logs.concat(data.data);
                    $state.loaded();
                } else {
                    $state.complete();
                }
            });
        },


        //delete data
        async deleteData(id, index) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will not be able to return to this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete(window.location.origin+'/api/activaty-log/'+id).then(()=>{
                                Swal.fire(
                                'Deleted!',
                                'Your item has been deleted successfully.',
                                'success'
                            )
                            this.logs.splice(index, 1)
                        }).catch(()=> {
                            Swal.fire("Opps!", "Something is wrong.", "warning");
                        });
                }
                })
        },

        //delete data
        async clear() {
            if(this.logs.length > 0) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will not be able to return to this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Delete it!'
                    }).then((result) => {
                    if (result.value) {
                        axios.get(window.location.origin+'/api/activaty-log-clear').then((response)=>{
                            this.logs=[];
                            Swal.fire('Deleted!','Your item has been deleted successfully.','success')
                        }).catch(()=> {
                            Swal.fire("Opps!", "Something is wrong.", "warning");
                        });
                    }
                })
            } else {
                toast.fire("Opps!", "You have no activity log", "warning");
            }
        },
  },

  created() {

  }
}

</script>