<template>
    <div>
        <div class="py-6 px-10">
            <label for="name" class="block uppercase tracking-wide text-gray-600 text-xs font-bold">Service Name Or Tagline <span class="text-pink-400">*</span></label>
            <input class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 " 
                   id="name" 
                   required 
                   :class="{ 'border border-red-500': this.$store.state.service.form.errors.has('name') }"
                   type="text" 
                   v-model="name" 
                   name="name">
            <has-error :form="this.$store.state.service.form" field="name" class="text-red-500" />
        </div>
        <hr class="border-gray-200">
        <div class="py-6 px-10">
            <label for="description" class="block uppercase tracking-wide text-gray-600 text-xs font-bold">Service Description</label> 
            <editor id="description" 
                    class="mt-2 resize-y block w-full rounded-lg text-base text-gray-900 transition ease-in-out duration-150" 
                    :class="{ 'border border-red-500': this.$store.state.service.form.errors.has('description') }"
                    v-model="description"></editor>
            <has-error :form="this.$store.state.service.form" field="description" class="text-red-500" />
        </div>
        <hr class="border-gray-200">
        <div class="py-6 px-10">
            <label class="block uppercase tracking-wide text-gray-600 text-xs font-bold">Assign to a team member 
                <a href="#" v-tippy='{ placement : "top", arrow : true }' content="Automatically assign orders of this service to a team member." class="text-indigo-500">
                    <i class="fal fa-question-circle"></i>
                </a>
            </label>
            <multiselect class="mt-2" v-model="teams" 
                        :multiple="true"
                        placeholder="Assign to a team member" 
                        label="name" 
                        track-by="slug" 
                        :options="teamMembers" 
                        :option-height="50" 
                        :show-labels="false">
                <template slot="singleLabel" slot-scope="props">
                    <img class="option__image" :src="props.option.photo_url" alt="No Man’s Sky">
                    <span class="option__desc">
                        <span class="option__title">{{ props.option.name }}</span>
                    </span>
                </template>
                <template slot="option" slot-scope="props">
                    <img class="option__image" :src="props.option.photo_url" alt="No Man’s Sky">
                    <div class="option__desc">
                        <span class="option__title">{{ props.option.name }}</span>
                        <span class="option__small">{{ props.option.desc }}</span>
                    </div>
                </template>
            </multiselect>

        </div>
        <hr class="border-gray-200">
        <div class="py-6 px-10">
            <label for="name" class="block uppercase tracking-wide text-gray-600 text-xs font-bold">Tags</label>
            <multiselect class="mt-2" tag-placeholder="Add this as new tag"
            v-model="tags"  
            placeholder="Search or add a tag" 
            label="name" 
            track-by="name" 
            :options="optionsTag" 
            :multiple="true" 
            :taggable="true" 
            @tag="addTag"></multiselect>
        </div>
    </div>
</template>


<script>
import { mapGetters } from 'vuex'

export default {

    data:()=>({
      //for Tag
      optionsTag: [],
      teamMembers:[]
    }),


    computed: {
        ...mapGetters('team', ['serviceTeam']),
        ...mapGetters('tag', ['serviceTags']),

        // all input field
        name: {
            get() {
                return this.$store.state.service.form.name
            },
            set(value) {
               this.$store.dispatch('service/serviceName', value)
            }
        },
        description: {
            get() {
                return this.$store.state.service.form.description
            },
            set(value) {
               this.$store.dispatch('service/serviceDesc', value)
            }
        },
        teams: {
            get() {
                return this.$store.state.service.form.teams
            },
            set(value) {
               this.$store.dispatch('service/serviceTeams', value)
            }
        },
        tags: {
            get() {
                return this.$store.state.service.form.tags
            },
            set(value) {
               this.$store.dispatch('service/serviceTags', value)
            }
        }
    },

    methods: {

        async getTeams() {
            await this.$store.dispatch('team/fetchServiceTeam');
            this.teamMembers = this.serviceTeam;
        },

        async getTags() {
            await this.$store.dispatch('tag/fetchServiceTags');
            this.optionsTag = this.serviceTags;
        },

        addTag (newTag) {
            const tag = {
                name: newTag
            } 
            //this.optionsTag.push
            this.$store.dispatch('service/addServiceTag', tag)
        }
    },

    created () {
        this.getTeams();
        this.getTags();
    },


}
</script>