<template>
	<div>
        <!-- breadcrumbs Start -->
        <breadcrumbs :items="breadcrumbs" :current="breadcrumbsCurrent"></breadcrumbs>
        <!-- breadcrumbs end -->

        <div class="main-content">
            <div class="container mx-auto max-w-3xl">
                <div class="md:pb-0 flex justify-between items-center relative">
                    <h2 class="text-xl text-gray-600">Permissions</h2>
                </div><!-- tbl-header -->

                <form @submit.prevent="login" @keydown="form.onKeydown($event)" class="relative">
                    <div class="w-full bg-white rounded-lg mx-auto mt-4 overflow-hidden rounded-b-none shadow">
                        <div class="py-4 px-8 md:py-8 md:px-16 lg:py-8 lg:px-16">
                            <label for="name" class="block uppercase tracking-wide text-gray-600 text-xs font-bold mb-2">{{ $t('name') }} </label>
                            <input id="name"  
                                class=" mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-sm tracking-wide font-medium text-gray-700 focus:outline-none focus:border-indigo-500" 
                                type="text"
                                v-model="form.name">
                        </div>
                    </div>
                    <hr class="border-gray-200">
                    <div class="w-full bg-white mx-auto">
                        <div class="py-4 px-8 md:py-8 md:px-16 lg:py-8 lg:px-16">
                            <label for="name" class="block uppercase tracking-wide text-gray-600 text-xs font-bold mb-2">Guard Name </label>
                            <select id="name"  
                              class=" mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-sm tracking-wide font-medium text-gray-700 focus:outline-none focus:border-indigo-500" 
                              type="text" 
                              v-model="form.guard_name">
                              <option disabled selected>Selected</option>
                              <option value="order_access">Order access</option>
                              <option value="order_management">Order management</option>
                              <option value="messaging">Messaging</option>
                              <option value="clients">Clients</option>
                              <option value="invoice_subscription_access">Invoice and subscription access</option>
                              <option value="invoice_management">Invoice management</option>
                              <option value="coupons">Coupons</option>
                              <option value="services">Services</option>
                              <option value="forms">Forms</option>
                              <option value="settings_team">Settings and team</option>
                              <option value="accounting">Accounting</option>
                              <option value="rank_tracking">Rank tracking</option>
                            </select>
                        </div>
                    </div>
                    <div class="p-16 py-8 bg-gray-300 clearfix rounded-b-lg border-t border-gray-200">           
                        <router-link :to="{ name: 'settings.role.create'  }" class="text-sm rounded-lg shadow inline-flex items-center bg-pink-500 focus:outline-none focus:shadow-outline text-white py-2 px-4">
                            <i class="fad fa-undo-alt"></i>
                            <span class="ml-1">Go back</span>
                        </router-link>
                        <v-button :loading="form.busy" class="float-right uppercase cursor-pointer w-full sm:w-auto bg-indigo-500 text-indigo-100 py-2 px-4 rounded-lg hover:bg-indigo-600 focus:outline-none cursor-pointer">
                            Save
                        </v-button>
                       
                    </div>
                </form>

            </div>
        </div>

	</div>
</template>

<script>
import Form from 'vform'
export default {  
  middleware: ['auth','admin'],


  metaInfo () {
    return { title: this.$t('Role') }
  },

    data:()=>({
      form: new Form({
        name: '',
        guard_name: 'Selected'
      }),
      breadcrumbsCurrent: 'Create Permission' ,
      breadcrumbs:[
        {
          name:'settings',
          url: 'settings'
        },
        {
          name:'Roles Create',
          url: 'role.create'
        },
        {
          name:'Permission',
          url: ''
        },
      ]
    }),

  methods: {
    async login () {
      // Submit the form.
      await this.form.post('/api/permission').then((response)=>{
          console.log(response);
      })
      this.form.reset();

      // // Save the token.
      // this.$store.dispatch('auth/saveToken', {
      //   token: data.token,
      //   remember: this.remember
      // })

      // // Fetch the user.
      // await this.$store.dispatch('auth/fetchUser')

      // // Redirect home.
      // this.$router.push({ name: 'home' })
    }
  }

}

</script>