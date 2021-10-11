<template>
	<div>
        <div class="breadcrumb flex border-b bg-gray-200 px-6 py-3 md:py-4 justify-between items-center">
		    <h1 class="text-md md:text-xl text-gray-600">Create service</h1>
            <nav aria-label="Breadcrumb">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                        <router-link :to="{ name: 'home' }" class="text-indigo-600">
                            <i class="fad fa-home"></i>
                        </router-link>
                        <svg class="fill-current w-3 h-3 mx-3 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                    </li>
                    <li class="flex items-center">
                        <router-link :to="{ name: 'services' }" class="text-indigo-600">
                            Services
                        </router-link>
                        <svg class="fill-current w-3 h-3 mx-3 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                    </li>
    
                    <li>
                        <a href="#" class="text-gray-500" aria-current="page">Create service</a>
                    </li>
                </ol>
            </nav>
        </div><!-- BreadCrumn end -->

        <div class="main-content">
            <div class="container mx-auto max-w-3xl">
                <h1 class="text-xl font-medium text-gray-700 px-6 md:px-0">{{ formSteps[activeStep].title }}</h1>
    
                    <div class="w-full bg-white rounded-lg mx-auto mt-4 flex rounded-b-none">
                        <div class="w-1/3 bg-gray-200 p-8 hidden md:inline-block">
                            <div class="progress">
                                <div class="progress-step mb-4 items-center flex"
                                    :class="{'active': index === activeStep}"
                                    v-for="(step, index) in formSteps"
                                    :key="'step'+index">
                                    <div class="w-8 h-8 text-xs text-white rounded-full flex justify-center items-center"
                                         :class="[ index <= activeStep ? 'bg-indigo-500' : 'bg-gray-500'  ]">
                                         <i class="fad" :class="[ index+1 <= activeStep ? 'fa-check' : step.icon  ]"></i>
                                    </div>
                                    <div class="ml-2 text-md leading-tight "
                                        :class="[ index <= activeStep ? 'text-gray-700' : 'text-gray-500'  ]">{{ step.title }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="md:w-2/3 w-full">
                            <div v-if="activeStep==0">
                                <service-details></service-details>
                            </div>
                            <div v-if="activeStep==1">
                                <service-pricing></service-pricing>
                            </div>
                            <div v-if="activeStep==2">
                                <service-gallery></service-gallery>
                            </div>
                            <div v-if="activeStep==3">
                                <service-requirement></service-requirement>
                            </div>
                            <div v-if="activeStep==4">
                                <service-settings></service-settings>
                            </div>
                            <!-- <div v-if="activeStep==5">
                                <service-faq :errors="formSteps[5].errors"></service-faq>
                            </div> -->
                        </div>
                    </div>
                    <div class="p-10 py-6 bg-gray-300 clearfix rounded-b-lg border-t border-gray-200">
                        <div class="actions">
                            <button class="text-sm cursor-pointer w-full sm:w-auto bg-pink-500 text-indigo-100 py-2 px-4 rounded-lg hover:bg-pink-600 focus:outline-none cursor-pointer" 
                                    :class="{ 'base-spinner' : loadingPrev, 'cursor-not-allowed opacity-25' : this.activeStep ==0 }"  
                                    :disabled="loadingPrev"
                                    @click="prevtStep"
                                    v-ripple>
                                        <i class="fad fa-undo-alt"></i>
                                       <span class="ml-1">Previous</span>
                            </button>
                            <button class="text-sm float-right cursor-pointer w-full sm:w-auto bg-indigo-500 text-indigo-100 py-2 px-4 rounded-lg hover:bg-indigo-600 focus:outline-none cursor-pointer" 
                                    v-if="activeStep < formSteps.length-1" 
                                    @click="checkFields"
                                    :disabled="this.$store.state.service.form.busy"
                                    :class="{ 'base-spinner' : this.$store.state.service.form.busy}"
                                    v-ripple>
                                    <span class="mr-1">Next</span>
                                    <i class="fad fa-forward"></i>
                            </button>
                            <button class="text-sm float-right cursor-pointer w-full sm:w-auto bg-red-500 text-indigo-100 py-2 px-4 rounded-lg hover:bg-red-600 focus:outline-none cursor-pointer" 
                                    v-else 
                                    @click="submit"
                                    :disabled="this.$store.state.service.form.busy"
                                    :class="{ 'base-spinner' : this.$store.state.service.form.busy}"
                                    v-ripple>
                                    <span class="mr-1">Done</span>
                                    <i class="fad fa-forward"></i>
                            </button>
                           
                        </div>
                    </div>
            </div>
        </div>



	</div>

</template>

<script>
import ServiceDetails from '~/components/Service/CreateHelper/ServiceDetails'
import ServicePricing from '~/components/Service/CreateHelper/ServicePricing'
import ServiceGallery from '~/components/Service/CreateHelper/ServiceGallery'
import ServiceRequirement from '~/components/Service/CreateHelper/ServiceRequirement'
import ServiceSettings from '~/components/Service/CreateHelper/ServiceSettings'
import ServiceFaq from '~/components/Service/CreateHelper/ServiceFaq'
import axios from 'axios'
export default {

    middleware: 'auth',
    components: {
        ServiceDetails, ServicePricing, ServiceGallery, ServiceRequirement , ServiceSettings, ServiceFaq
    },

    data: () => ({
        isValidate:true,
        errors: [],
        activeStep:2,
        loadingPrev:false,
        formSteps: [
            {
                title: "Service Details",
                icon: 'fad fa-info',
            },
            {
                title: "Service Pricing",
                icon: 'fa-money-bill-wave',
            },
            {
                title: "Gallery",
                icon: 'fa-photo-video',
            },
            {
                title: "Requirements",
                icon: 'fa-server',
            },
            {
                title: "Service Setting",
                icon: 'fa-money-bill-wave',
            }
        ]
    }),


    methods: {
        // next step 
        nextStep() {
            
            if(this.activeStep < this.formSteps.length-1){
                this.activeStep += 1;
            }
        },
        
        // previous step 
        prevtStep() {
            if(this.activeStep!=0) {
                this.loadingPrev = true;
                setTimeout(()=>{
                    this.activeStep -= 1;
                    this.loadingPrev = false;
                },300);
            }

        },


        // input validation 
        async step1Validation(){
            try {
                const {data} = await axios.post(window.location.origin+'/api/serviceValidation/', { name: this.$store.state.service.form.name });
                if(data.success){
                    this.isValidate = true; 
                    if(this.$store.state.service.form.errors.has('name')){
                        this.$store.state.service.form.errors.clear('name')
                    }
                }

            } catch (error) {
                if(error.response && error.response.status === 400) {
                    this.isValidate = false; 
                    this.$store.dispatch('service/serviceFormError', error.response.data.data);
                }
            }

        },

        // if valid then proceed to next
        async checkFields() {
            // Jump step-1 to step-2
            this.$store.state.service.form.busy = true;
            if(this.activeStep==0) {
                await this.step1Validation();
            }
            if(this.isValidate){
                this.nextStep();
            }
            this.$store.state.service.form.busy = false;
        },

        async submit() {
            this.$store.dispatch('service/serviceSubmit');
        }
    }

}
</script>


<style lang="scss">

.progress-step {
    position: relative;

    &.active {
      ~ .progress-step::before {
        background-color: #ccc;
      }
    }

    &:before {
        content: "";
        position: absolute;
        top: -16px;
        width: 2px;
        height: 17px;
        background: #667eea;
        z-index: 10;
        left: 15px;
    }

    &:first-child::before {
      display: none;
    }
}


</style>