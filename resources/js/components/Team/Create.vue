<template>
    <div class="container mx-auto max-w-3xl">
        <form @submit.prevent="submit" @keydown="form.onKeydown($event)" enctype="multipart/form-data">
            <div class="w-full bg-white rounded-lg mx-auto overflow-hidden rounded-b-none shadow">
                <div class="py-4 px-8 md:py-8 md:px-16 lg:py-8 lg:px-16">
                    <label for="name" class="block uppercase tracking-wide text-gray-600 text-xs font-bold mb-2">
                        {{ $t('name') }} 
                    </label>
                    <input id="name"  
                           class=" mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-sm tracking-wide font-medium text-gray-700 focus:outline-none focus:border-indigo-500" 
                           type="text" 
                           :class="{ 'border border-red-500': form.errors.has('name') }"
                           v-model="form.name">
                    <has-error :form="form" field="name" class="text-red-500" />
                </div>
                <hr class="border-gray-200">
                <div class="py-4 px-8 md:py-8 md:px-16 lg:py-8 lg:px-16">
                    <label for="email" class="block uppercase tracking-wide text-gray-600 text-xs font-bold mb-2">{{ $t('email') }}</label>
                    <input id="email" 
                            class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-sm tracking-wide text-gray-700 font-medium focus:outline-none focus:border-indigo-500" 
                            type="email" 
                            :class="{ 'border border-red-500': form.errors.has('email') }"
                            v-model="form.email">
                    <has-error :form="form" field="email" class="text-red-500" />
                </div>
                <hr class="border-gray-200">
                <div class="py-4 px-8 md:py-8 md:px-16 lg:py-8 lg:px-16">
                    <label for="phone" class="block uppercase tracking-wide text-gray-600 text-xs font-bold mb-2">{{ $t('phone') }}</label>
                    <input id="phone" 
                            class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-sm tracking-wide text-gray-700 font-medium focus:outline-none focus:border-indigo-500" 
                            type="phone" 
                            :class="{ 'border border-red-500': form.errors.has('phone') }"
                            v-model="form.phone">
                    <has-error :form="form" field="phone" class="text-red-500" />
                </div>
                <hr class="border-gray-200">
                <div class="py-4 px-8 md:py-8 md:px-16 lg:py-8 lg:px-16">
                    <label for="role" class="block uppercase tracking-wide text-gray-600 text-xs font-bold mb-2">{{ $t('role') }}</label>
                    <multiselect 
                    v-model="form.role" 
                    :options="options" 
                    placeholder="Select one" 
                    label="name" 
                    :class="{ 'border border-red-500': form.errors.has('role') }"
                    track-by="slug"
                    ></multiselect>
                    <has-error :form="form" field="role" class="text-red-500" />
                    
                </div>
                <hr class="border-gray-200">
                <div class="py-8 px-16 clearfix">
                    <label for="profile_picture" class="block uppercase tracking-wide text-gray-600 text-xs font-bold mb-2">{{ $t('profile_picture') }}</label>
                     <img class="rounded-full w-16 h-16 border-4 mt-2 border-gray-200 float-left" 
                          :src="form.profilePic ? getProfilePhoto() : 'https://www.gravatar.com/avatar/faf1084144ec566e51fadd3420c66c02?s=100&amp;d=mm&amp;r=g'" 
                          alt="photo">
                    <div class="bg-gray-200 text-gray-500 text-xs mt-5 ml-3 font-bold px-4 py-2 rounded-lg float-left hover:bg-gray-300 hover:text-gray-600 relative overflow-hidden cursor-pointer">
                        <input type="file" name="profile_picture" @change="uploadPhoto" 
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                               :class="{ 'is-invalid': form.errors.has('profile_picture') }"> Change
                    	<has-error :form="form" field="profile_picture"></has-error>
                    </div>
                </div>
                <hr class="border-gray-200">
                <div class="py-4 px-8 md:py-8 md:px-16 lg:py-8 lg:px-16">
                    <label for="password" class="block uppercase tracking-wide text-gray-600 text-xs font-bold mb-2">{{ $t('password') }}</label>
                    <input id="password" 
                            class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-sm tracking-wide text-gray-700 font-medium focus:outline-none focus:border-indigo-500" 
                            type="password" v-model="form.password">
                    <small class="text-xs text-gray-500">Default password is: 123456</small>
                </div>
                <hr class="border-gray-200">
                <div class="py-8 px-16">
                    <checkbox v-model="form.mail" class="flex items-center mb-3">
                        <span class="block uppercase tracking-wide text-gray-600 text-xs font-bold ml-1">Send welcome email</span>
                    </checkbox>
                </div>
            </div>
            <div class="p-16 py-8 bg-gray-300 clearfix rounded-b-lg border-t border-gray-200">           
                <router-link v-ripple :to="{ name: 'settings.team'  }" class="text-sm rounded-lg shadow inline-flex items-center bg-pink-500 focus:outline-none focus:shadow-outline text-white py-2 px-4">
                    <i class="fad fa-undo-alt"></i>
                    <span class="ml-1">Go back</span>
                </router-link>
                <v-button v-ripple :loading="form.busy" class="float-right cursor-pointer w-auto bg-indigo-500 text-indigo-100 py-2 px-4 rounded-lg hover:bg-indigo-600 focus:outline-none cursor-pointer">
                    <span class="mr-1">Save</span>
                    <i class="fad fa-forward"></i>
                </v-button>
            </div>
        </form>
    </div>
</template>


<script>

import Form from 'vform'
import { mapGetters } from 'vuex'

export default {

    data: () => ({
        form: new Form({
            name:'',
            email:'',
            phone:'',
            role:{},
            profilePic:'',
            password:'',
            mail:true,
        }),
        options: []
    }),

    // Map Getters
    computed: {
        ...mapGetters('role', ['roles']),
    },

    methods: {

        getProfilePhoto(){
             let prefix = (this.form.profilePic.match(/\//) ? '' : '');
             return prefix + this.form.profilePic;
        },


        async uploadPhoto(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            //check file type
            if((file['type'] == 'image/jpeg') || (file['type'] == 'image/png')) {

                //check file size
                if(file['size'] < 5242880) {
                    reader.onloadend = (file) => {
                        this.form.profilePic = reader.result;
                    }
                    reader.readAsDataURL(file)
                } else {
                    Swal.fire({
                        title: 'Oops...',
                        text: "File size is too large..",
                        type: 'error',
                    })
                }
            } else {
                Swal.fire({
                    title: 'Oops...',
                    text: "Only JPG/PNG image is allowed.",
                    type: 'error',
                })
            }
        },


        async getRole() {
            await this.$store.dispatch('role/fetchRoles');
            this.options = this.roles
        },

        async submit() {
            // Register the team member.
            await this.form.post('/api/team').then((response)=>{
              toast.fire({
                type: 'success',
                title: 'Team created successfully.'
              })
              this.$router.push({ name: 'settings.team'});
            }).catch(()=>{
                toast.fire({
                    type: 'error',
                    title: 'Opps...something went to wrong :('
                })
            })
        },
    },

    created () {
        this.getRole();
    }
}
</script>