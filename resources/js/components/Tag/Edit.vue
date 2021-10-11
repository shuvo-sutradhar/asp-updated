<template>
    <modal name="editTag">

        <template v-slot:closeModal>
            <div @click="close" id="switch-plan-close" class="absolute right-0 top-0 -mt-4 -ml-4 h-8 w-8 rounded-full shadow bg-white text-xl flex justify-center align-center cursor-pointer">
                &times;
            </div>
        </template>

        <div slot="header">
            <h2 class="text-xl text-gray-600 font-medium">Edit tag <span class="text-pink-500 text-semibold">{{ data.name }}</span></h2>
        </div>


        <div slot="modal-form">
            <form @submit.prevent="update" @keydown="form.onKeydown($event)" multipart>
                <div slot="body" class="p-8 py-12">
                    
                    <div>
                        <label for="name" class="block uppercase tracking-wide text-gray-600 text-xs font-bold mb-2">{{ $t('name') }} </label>
                        <input id="name"  
                            class=" mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-sm tracking-wide font-medium text-gray-700 focus:outline-none focus:border-indigo-500" 
                            type="text" 
                            :class="{ 'border border-red-500': form.errors.has('name') }"
                            v-model="form.name">
                        <has-error :form="form" field="name" class="text-red-500" />
                    </div>
                        
                </div>
                <div slot="footer">
                    <div class="p-8 py-4 bg-gray-300 clearfix rounded-b-lg border-t border-gray-200">           
                        <a @click="close" v-ripple class="text-sm rounded-lg shadow inline-flex items-center bg-pink-500 focus:outline-none focus:shadow-outline text-white py-2 px-4">
                            <i class="fad fa-undo-alt"></i>
                            <span class="ml-1">Go back</span>
                        </a>
                        <v-button :loading="form.busy" v-ripple class="float-right cursor-pointer w-auto bg-indigo-500 text-indigo-100 py-2 px-4 rounded-lg hover:bg-indigo-600 focus:outline-none cursor-pointer">
                            <span class="mr-1">Save</span>
                            <i class="fad fa-forward"></i>
                        </v-button>
                    </div>
                </div>
            </form>
        </div>
    </modal>
</template>


<script>

import Form from 'vform'


export default {
    props: {
        data: { type: Object, required: true }
    },

	data() {
        return {
            form: new Form({
                name: this.data.name,
            })
        };
    },
 

    methods: {
        close() {
			this.$store.state.tag.tagSlug = null;
			this.$store.dispatch("modals/close", 'editTag')
        },

        async update() {

            // update the tag.
            await this.form.patch(window.location.origin+'/api/tag/'+this.data.slug)
                .then((response)=>{
                    toast.fire({
                        type: 'success',
                        title: 'Tag updated successfully.'
                    })
                    this.$store.dispatch('tag/tagUpdate', { data: response.data.data })
                    this.close();
                }).catch(()=>{
                    toast.fire({
                        type: 'error',
                        title: 'Opps...something went to wrong 😔'
                    })
                })

        },

    }
}
</script>

