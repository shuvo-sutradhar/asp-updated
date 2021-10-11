<template>
  <div class="flex flex-col items-center h-screen bg-gray-200 p-4 rotate">
      <div class="sm:max-w-xl md:max-w-3xl w-full m-auto">
            <router-link :to="{ name: 'welcome' }" class="inline-block flex items-center justify-center relative font-black m-auto mb-10">
              <div v-if="darkLogo">
                <img :src="'/img/'+darkLogo" :alt="companyName" class="h-8 w-auto" />
              </div>
              <div v-else class="flex">
                <svg class="h-8 w-auto fill-current text-pink-500" viewBox="0 0 281 280" height="280" xmlns="http://www.w3.org/2000/svg">
                    <path d="M140 0C89.592-.006 43.073 27.088 18.206 70.935-6.66 114.78-6.037 168.61 19.84 211.87a135.373 135.373 0 006.73 10.2c40.925 56.523 117.212 74.304 178.91 41.7l-11.29-19.51c-42.055 21.797-93.087 16.206-129.426-14.178-36.34-30.384-50.88-79.618-36.875-124.869C41.893 59.963 81.7 27.547 128.85 23c3.67-.34 7.39-.52 11.15-.52 3.76 0 7.47.18 11.14.52 42.314 4.012 79.16 30.57 96.344 69.444 17.185 38.875 12.028 84-13.484 117.996L140 47.9 52.19 200h33.87L140 106.56l72.75 125.69 11.38 19.66c48.149-36.192 67.751-99.125 48.67-156.258C253.72 38.52 200.235-.004 140 0z"/>
                </svg>
                <span class="font-black ml-2 text-indigo-500 text-xl uppercase">{{ companyName }}</span>                
              </div>
            </router-link>

            <card v-if="mustVerifyEmail">
              <div class="alert alert-success" role="alert">
                {{ $t('verify_email_address') }}
              </div>
            </card>
            <div v-else>
              <form @submit.prevent="register" @keydown="form.onKeydown($event)" class="flex items-stretch bg-white rounded-lg shadow-lg overflow-hidden border-t-4 border-indigo-500 sm:border-0">
                  <!-- @csrf -->
                  <div class="flex hidden overflow-hidden relative sm:block w-5/12 md:w-6/12 bg-gray-600 text-gray-300 py-4 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1477346611705-65d1883cee1e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80')">
                      <div class="flex-1 absolute bottom-0 text-white p-10">
                          <h3 class="text-4xl font-bold inline-block">{{ $t('register') }}</h3>
                          <p class="text-gray-500 whitespace-no-wrap">
                              {{ $t('signup_for_account') }}
                          </p>
                      </div>
                      <svg class="absolute animate h-full w-4/12 sm:w-2/12 right-0 inset-y-0 fill-current text-white" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                        <polygon points="0,0 100,100 100,0"></polygon>
                      </svg>
                  </div>
                  <div class="flex-1 p-6 sm:p-8 sm:py-12">
                      <h3 class="text-xl text-gray-700 font-bold mb-6">
                      {{ $t('register') }} <span class="text-gray-400 font-light">{{ $t('for_your_account') }}</span></h3>

                      <!-- Email -->
                      <input id="name" 
                            type="name" 
                            v-model="form.name"
                            class="px-3 w-full py-2 bg-gray-200 border border-gray-200 rounded focus:border-gray-400 focus:outline-none focus:bg-white mb-4" 
                            :class="{ 'border border-red-500 mb-0': form.errors.has('name') }"
                            :placeholder="$t('name')" 
                            name="name" 
                            required 
                            autofocus>
                      <has-error :form="form" field="name" class="text-red-500 mb-3 -mt-2 text-sm" />

                      <!-- Email -->
                      <input id="email" 
                            type="email" 
                            v-model="form.email"
                            class="px-3 w-full py-2 bg-gray-200 border border-gray-200 rounded focus:border-gray-400 focus:outline-none focus:bg-white mb-4" 
                            :class="{ 'border border-red-500 mb-0': form.errors.has('email') }"
                            :placeholder="$t('email')" 
                            name="email" 
                            required 
                            autofocus>
                      <has-error :form="form" field="email" class="text-red-500 mb-3 -mt-2 text-sm" />

                      <!-- Password -->
                      <input v-model="form.password" 
                            :class="{ 'is-invalid': form.errors.has('password') }" 
                            class="px-3 w-full py-2 bg-gray-200 border border-gray-200 rounded focus:border-gray-400 focus:outline-none focus:bg-white mb-4" 
                            type="password" 
                            name="password"
                            :placeholder="$t('password')" 
                            required>
                      <has-error :form="form" field="password" class="text-red-500 mb-3 -mt-2 text-sm" />

                      <!-- Password -->
                      <input v-model="form.password_confirmation" 
                            :class="{ 'is-invalid': form.errors.has('password_confirmation') }" 
                            class="px-3 w-full py-2 bg-gray-200 border border-gray-200 rounded focus:border-gray-400 focus:outline-none focus:bg-white mb-4" 
                            type="password" 
                            name="password_confirmation"
                            :placeholder="$t('confirm_password')" 
                            required>
                      <has-error :form="form" field="password_confirmation" class="text-red-500 mb-3 -mt-2 text-sm" />

                      <div class="flex flex-wrap items-center">
                          <div class="w-full sm:flex-1">
                              <v-button :loading="form.busy" class="w-full sm:w-auto bg-indigo-500 text-indigo-100 px-6 py-2 rounded-full hover:bg-indigo-600 focus:outline-none cursor-pointer">
                                {{ $t('register') }}
                              </v-button>
                          </div>
                      </div>

                      <p class="w-full text-sm text-left text-gray-700 mt-8">
                          {{ $t('already_have_account') }}
                          <router-link :to="{ name: 'login' }" class="text-blue-500 hover:text-blue-700 no-underline font-medium">
                              {{ $t('login') }}
                          </router-link>
                      </p>

                  </div>
              </form>
            </div>
      </div>
  </div>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'

export default {
  middleware: 'guest',
  layout: 'basic',


  metaInfo () {
    return { title: this.$t('register') }
  },

  data: () => ({    
    appName: window.config.appName,
    form: new Form({
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    }),
    mustVerifyEmail: false
  }),

  computed: mapGetters({
    companyName: 'settings/company_name',
    darkLogo: 'settings/dark_logo'
  }),

  methods: {
    async register () {
      // Register the user.
      const { data } = await this.form.post('/api/register')

      // Must verify email fist.
      if (data.status) {
        this.mustVerifyEmail = true
      } else {
        // Log in the user.
        const { data: { token } } = await this.form.post('/api/login')

        // Save the token.
        this.$store.dispatch('auth/saveToken', { token })

        // Update the user.
        await this.$store.dispatch('auth/updateUser', { user: data })

        // Redirect home.
        this.$router.push({ name: 'home' })
      }
    }
  }
}
</script>
