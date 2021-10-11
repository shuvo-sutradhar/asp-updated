<template>
	<div>
        <!-- breadcrumbs Start -->
        <breadcrumbs :items="breadcrumbs" />
        <!-- breadcrumbs end -->

        <div class="main-content">
            <div class="container mx-auto max-w-3xl">
                <form class="relative" url="/basic" multipart>
                    <!-- {{ systemSettings }} -->
                    <!-- @csrf -->
                    <div class="w-full bg-white rounded-lg mx-auto overflow-hidden rounded-b-none shadow">
                        <div class="py-8 px-16">
                            <label for="company_domain" class="block uppercase tracking-wide text-gray-600 text-xs font-bold mb-2">{{ $t('setting.custom_domain') }} 
                                <a href="#" class="text-indigo-500"><em class="fal fa-question-circle"></em></a>
                            </label>
                            <input id="company_domain"  
                                   class=" mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-sm tracking-wide font-medium text-gray-700 focus:outline-none focus:border-indigo-500" 
                                   type="text" 
                                   v-model="custom_domain" 
                                   disabled>
                        </div>
                        <hr class="border-gray-200">
                        <div class="py-8 px-16">
                            <label for="co_name" class="block uppercase tracking-wide text-gray-600 text-xs font-bold mb-2">{{ $t('setting.company_name') }}</label>
                            <input id="co_name" 
                                   class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-sm tracking-wide text-gray-700 font-medium focus:outline-none focus:border-indigo-500" 
                                   type="email" v-model="form.company_name" 
                                   :placeholder="$t('setting.your_agency')">
                            <span class="text-xs text-gray-500">{{ $t('setting.company_name_helper') }}</span>
                        </div>
                        <hr class="border-gray-200">
                        <div class="py-8 px-16 clearfix">
                            <label for="photo" class="block uppercase tracking-wide text-gray-600 text-xs font-bold mb-2">{{ $t('setting.upload') }}</label>
                            <img class="rounded-full w-16 h-16 border-4 mt-2 border-gray-200 float-left" id="photo" src="https://pbs.twimg.com/profile_images/1163965029063913472/ItoFLWys_400x400.jpg" alt="photo">
                            <div class="bg-gray-200 text-gray-500 text-xs mt-5 ml-3 font-bold px-4 py-2 rounded-lg float-left hover:bg-gray-300 hover:text-gray-600 relative overflow-hidden cursor-pointer">
                                <input type="file" name="photo" onchange="loadFile(event)" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"> Change Logo
                            </div>
                            <div class="bg-red-200 text-white text-xs mt-5 ml-3 font-bold px-4 py-2 rounded-lg float-left hover:bg-gray-300 hover:text-gray-600 relative overflow-hidden cursor-pointer">
                                <input type="file" name="photo" onchange="loadFile(event)" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"> Remove Logo
                            </div>
                        </div>
                        <hr class="border-gray-200">
                        <div class="py-8 px-16">
                            <label for="name" class="block uppercase tracking-wide text-gray-600 text-xs font-bold mb-2">{{ $t('setting.system_color') }}</label>
                            <div class="grid grid-cols-2 gap-4">
                                <!-- <div class="col-span-1">
                                    <VueSelect class="mt-2" :data="categories" v-model="form.sidebar_color" v-on:valueSelect="onValueSelect">
                                        <template v-slot:SelectLabel>Wrestl ers</template>
                                    </VueSelect>
                                    <span class="text-xs text-gray-500">{{ $t('setting.sidebar_color') }}</span>
                                </div>
                                <div class="col-span-1">
                                    <VueSelect class="mt-2" :data="categories" v-model="form.sidebar_color" v-on:valueSelect="onValueSelect">
                                        <template v-slot:SelectLabel>Wrestl ers</template>
                                    </VueSelect>
                                    <span class="text-xs text-gray-500">{{ $t('setting.topbar_color') }}</span>
                                </div>
                                <div class="col-span-1">
                                    <VueSelect class="mt-2" :data="categories" v-model="form.sidebar_color" v-on:valueSelect="onValueSelect">
                                        <template v-slot:SelectLabel>Wrestl ers</template>
                                    </VueSelect>
                                    <span class="text-xs text-gray-500">{{ $t('setting.body_color') }}</span>
                                </div>
                                <div class="col-span-1">
                                    <VueSelect class="mt-2" :data="wrestlers" v-model="form.sidebar_color" v-on:valueSelect="onValueSelect">
                                        <template v-slot:SelectLabel>Wrestl ers</template>
                                    </VueSelect>
                                    <span class="text-xs text-gray-500">{{ $t('setting.breadcrumb_color') }}</span>
                                </div>
                                <div class="col-span-2">
                                    <button type="reset" class="bg-gray-200 text-gray-500 py-2 px-2 w-full rounded-lg font-semibold text-xs hover:bg-gray-300 hover:text-gray-600 focus:outline-none">{{ $t('setting.reset_color') }}</button>
                                </div> -->
                            </div>

                        </div>
                        <hr class="border-gray-200">
                        <div class="py-8 px-16">
                            <label for="timezone" class="block uppercase tracking-wide text-gray-600 text-xs font-bold mb-2">{{ $t('setting.timezone') }}</label>
                            <input id="timezone" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" type="email" name="email" v-model="form.timezone">
                        </div>
                        <hr class="border-gray-200">
                        <div class="py-8 px-16">
                            <label for="contact_link" class="block uppercase tracking-wide text-gray-600 text-xs font-bold mb-2">{{ $t('setting.contact_link') }}</label>
                            <input id="contact_link" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" type="email" name="email" v-model="form.contact_link">
                            <span class="text-xs text-gray-500">{{ $t('setting.contact_link_helper') }}</span>
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

import { mapGetters } from 'vuex'
import Form from 'vform'

export default {  
    middleware: ['auth','admin','check-permissions'],

    // Meta Info
    metaInfo () {
        return { title: this.$t('General Settings') }
    },

    // Data 
    data: () => ({
        custom_domain: 'codeshaper.asp.test',
        form: new Form({
            company_name: '',
            logo_light: '',
            logo_dark: '',
            favicon: '',
            sidebar_color: 'bg-gray',
            topbar_color: 'df',
            body_color: '',
            breadcrumb_color: '',
            timezone: '',
            contact_link: '/helpdesk'
        }),

        categories:[
            {
                id: 1,
                name: 'cat1'
            },
            {
                id: 2,
                name: 'cat2'
            },
        ],
        // BreadCrumbs
        breadcrumbs:[{
                name:'Settings',
                url: 'settings'
            },
            {
                name:'General Settings',
                url: ''
            }],
    }),

    methods: {

        // get setting data inside form value
        fillForm() {
            this.form.company_name=this.settings[0].value
            this.form.logo_light=this.settings[1].value
            this.form.logo_dark=this.settings[2].value
            this.form.favicon=this.settings[3].value
            this.form.sidebar_color=this.settings[4].value
            this.form.topbar_color=this.settings[5].value
            this.form.body_color=this.settings[6].value
            this.form.breadcrumb_color=this.settings[7].value
            this.form.timezone=this.settings[8].value
            this.form.contact_link=this.settings[9].value
        }
    },

    // Map Getters
    computed: mapGetters({
        settings: 'settings/getSettings',
    }),



    created () {
        
        this.fillForm();
    }   
    
}

</script>