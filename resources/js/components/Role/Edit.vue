<template>
    <div>
        <div class="md:pb-0 flex justify-between items-center relative">
            <h2 class="text-xl text-gray-600">Update Role & Permissions</h2>
        </div> <!-- tbl-header -->

        <form @submit.prevent="updateRole" @keydown="form.onKeydown($event)" multipart>

            <div class="w-full bg-white rounded-lg mx-auto mt-4 overflow-hidden rounded-b-none shadow">
                <div class="py-4 px-8 md:py-8 md:px-16 lg:py-8 lg:px-16">
                    <label for="name" class="block uppercase tracking-wide text-gray-600 text-xs font-bold mb-2">{{ $t('name') }} </label>
                    <input id="name"  
                           class=" mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-sm tracking-wide font-medium text-gray-700 focus:outline-none focus:border-indigo-500" 
                           type="text" 
                           :class="{ 'border border-red-500': form.errors.has('name') }"
                           v-model="form.name">
                    <has-error :form="form" field="name" class="text-red-500" />
                </div>
                <hr class="border-gray-200">
                <div class="py-4 px-8 md:py-8 md:px-16 lg:py-8 lg:px-16 relative h-92 max-h-full overflow-">
                    <div class="border rounded overflow-hidden">
                        <table-loading v-show="loading" />
                        <div v-for="(data, index) in permissions" 
                            :key="index" >
                            <ul class="flex justify-between bg-gray-100 px-2 py-3 " :class="[ permissions.length==index-1 ? 'border-0' : 'border-b' ]">
                                <li class="block uppercase tracking-wide text-gray-600 text-xs font-bold mb-2">{{ data[0].guard_name }}</li>
                                <li class="block uppercase tracking-wide text-gray-600 text-xs font-bold mb-2">Action</li>
                            </ul>
                            <!-- Permission table head end -->
                            <div class="px-3 py-3 flex justify-between hover:bg-gray-100 border-b" 
                                 v-for="(permission, key) in data" 
                                 :key="key">
                                <div class="text-gray-600 text-sm font-medium  pl-4">
                                    {{ permission.name }}
                                </div>
                                <div>
                                    <toggle-button 
                                        :value="form.permission.includes(permission.slug) ? true : false" 
                                        :sync="form.permission.includes(permission.slug) ? true : false" 
                                        color="#667eea" 
                                        :labels="true" 
                                        @change="onChangeEventHandler($event, permission.slug)"
                                    />
                                </div>
                            </div><!-- Permission table body end -->
                        </div>

                    </div><!-- Permission table  end -->
                    <router-link :to="{ name : 'settings.permission.create'}" class="text-indigo-500 mt-4">
                       + Add new permissions
                    </router-link>
                </div>
            </div>

            <div class="p-16 py-8 bg-gray-300 clearfix rounded-b-lg border-t border-gray-200">           
                <router-link :to="{ name: 'settings.roles'  }" class="text-sm rounded-lg shadow inline-flex items-center bg-pink-500 focus:outline-none focus:shadow-outline text-white py-2 px-4">
                    <i class="fad fa-undo-alt"></i>
                    <span class="ml-1">Go back</span>
                </router-link>
                <v-button :loading="form.busy" class="text-sm float-right cursor-pointer w-full sm:w-auto bg-indigo-500 text-indigo-100 py-2 px-4 rounded-lg hover:bg-indigo-600 focus:outline-none cursor-pointer">
                    <span class="mr-1">Update</span>
                    <i class="fad fa-forward"></i>
                </v-button>
            </div>
        </form>
    </div>
</template>


<script>
import { mapGetters } from "vuex"
import Form from 'vform'
export default {
    data: () => ({
        form: new Form({
            name:null,
            permission: [],
        }),
        loading:true,
    }),

    methods: {


        // get role from server
        async getRole(){
            const { data } = await this.form.get(window.location.origin+'/api/role/'+this.$route.params.slug);
            this.form.name = data.data.name;
            this.form.permission = data.data.permissions;
        },

        // get permission data 
        async getPermission() {
            this.loading=true;
            await this.$store.dispatch('role/fetchPermissions');
            this.loading=false;
        },

        // assign v-model permission data when change checkbox event
        onChangeEventHandler(e, permission) {
            if(e.value==false) {
                // remove item from array
                this.form.permission = this.form.permission.filter(function (item) {
                    return permission != item;
                });
            } else {
                // add item in array
                this.form.permission.push(permission);
            }
        }, 

        // update role and permission
        async updateRole(){
            await this.form.patch(window.location.origin+'/api/role/'+this.$route.params.slug)
                .then((response)=>{
                    toast.fire({
                        type: 'success',
                        title: 'Role and permissions has been updated successfully.'
                    })
                }).catch(()=>{
                    toast.fire({
                    type: 'error',
                    title: 'Opps...something is wrong 😔'
                    })
                });
        }

    },

    // Map Getters
    computed: mapGetters({
        permissions: 'role/getPermissions'
    }),

    mounted() {
        this.getPermission();
        this.getRole();
    }
}
</script>