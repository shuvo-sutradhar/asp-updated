<template>
    <div>
        <div>
            <div class="flex justify-between items-center text-center bg-gray-100 p-1">
                <div class="flex-1 py-4 text-gray-600 font-medium flex items-center justify-center cursor-pointer" :class="[ this.$store.state.service.form.service_type==0 ? 'bg-gray-300' : 'bg-gray-200'  ]" @click="serviceType(0)">
                    Onetime Service <span class="ml-2 w-2 h-2 block rounded-full bg-green-400" v-if="this.$store.state.service.form.service_type==0"></span>
                </div>
                <div class="flex-1 bg-gray-200 py-4 text-gray-600 font-medium rounded-tr-sm cursor-pointer flex items-center justify-center cursor-pointer" :class="[ this.$store.state.service.form.service_type==1 ? 'bg-gray-300' : 'bg-gray-200'  ]" @click="serviceType(1)">
                    Requiring Service <span class="ml-2 w-2 h-2 block rounded-full bg-green-400" v-if="this.$store.state.service.form.service_type==1"></span>
                </div>
            </div>
        </div>
        <hr class="border-gray-100">
        <onetime-service v-if="this.$store.state.service.form.service_type==0"></onetime-service>
        <requiring-service v-if="this.$store.state.service.form.service_type==1"></requiring-service>
    </div>
</template>

<script>
import OnetimeService from '~/components/Service/CreateHelper/OnetimeService'
import RequiringService from '~/components/Service/CreateHelper/RequiringService'
export default {

    components: {
        OnetimeService, RequiringService
    },

    data: () => ({
    }),

    methods:{
        serviceType(val) {
            this.$store.dispatch('service/serviceType', val)
        }
    }
}
</script>