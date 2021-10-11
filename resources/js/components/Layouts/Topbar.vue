<template>
    <!-- start navbar -->
    <div class="fixed w-full top-0 z-30 flex items-center bg-indigo-500 p-0 shadow-xs flex-col md:flex-row md:p-5 md:justify-between">

        <!-- logo -->
        <div class="w-full px-6 py-3 md:w-64 md:px-0 md:py-0 border-b border-gray-200 md:border-none flex flex-row items-center justify-between">
            <router-link :to="{ name: 'welcome' }" class="inline-block h-full flex items-center h-5 relative font-black">
              <div v-if="lightLogo">
                <img :src="'/img/'+lightLogo" :alt="companyName" class="h-8 w-auto" />
              </div>
              <div v-else class="flex items-center">
                <svg class="h-8 w-auto fill-current text-pink-500" viewBox="0 0 281 280" height="280" xmlns="http://www.w3.org/2000/svg">
                    <path d="M140 0C89.592-.006 43.073 27.088 18.206 70.935-6.66 114.78-6.037 168.61 19.84 211.87a135.373 135.373 0 006.73 10.2c40.925 56.523 117.212 74.304 178.91 41.7l-11.29-19.51c-42.055 21.797-93.087 16.206-129.426-14.178-36.34-30.384-50.88-79.618-36.875-124.869C41.893 59.963 81.7 27.547 128.85 23c3.67-.34 7.39-.52 11.15-.52 3.76 0 7.47.18 11.14.52 42.314 4.012 79.16 30.57 96.344 69.444 17.185 38.875 12.028 84-13.484 117.996L140 47.9 52.19 200h33.87L140 106.56l72.75 125.69 11.38 19.66c48.149-36.192 67.751-99.125 48.67-156.258C253.72 38.52 200.235-.004 140 0z"/>
                </svg>
                <strong class="capitalize ml-1 flex-1 text-white">{{ companyName }}</strong>               
              </div>
            </router-link>

            <div class="flex items-center">
                <locale-dropdown class="ml-4 d-block md:hidden text-sm mr-2" />
                <button id="sliderBtn" class="flex-none text-right px-2 py-2 text-gray-200" @click="isSidebarOpen">
                    <em class="fad fa-list-ul" :class="[isOpenSidebar ? 'hidden md:block' : 'block md:hidden']"></em>
                    <em class="fad fa-times-circle" :class="[isOpenSidebar ? 'block md:hidden' : 'hidden md:block']" ></em>
                </button>
            </div>
        </div>
        <!-- end logo -->   

        <div class="flex justify-between items-center w-full">
            <locale-dropdown class="ml-4 hidden md:block" />
            
            <div id="navbar" class="animated flex-1 md:pl-3 flex w-full md:w-auto justify-end justify-evenly items-center p-0 md:flex-none"> 

                <!-- messages -->
                <div class="relative md:mr-5 mr-0 static w-24 md:w-auto bg-gray-200 md:bg-transparent md:border-none border-r border-gray-300 py-2">
                    <button class="text-gray-800 md:text-gray-100 w-full md:w-auto menu-btn p-0 m-0 hover:text-gray-900 focus:text-gray-900 focus:outline-none transition-all ease-in-out duration-300">
                        <em class="fal fa-comment-alt-minus"></em>
                    </button>

                    <button class="hidden fixed top-0 left-0 z-10 w-full h-full menu-overflow"></button>

                    <div class="menu hidden w-full md:w-auto md:right-0 md:mt-2 rounded bg-white shadow-md absolute z-20 right-0 w-84 mt-5 py-2 animated faster">
                        <!-- top -->
                        <div class="px-4 py-2 flex flex-row justify-between items-center capitalize font-semibold text-sm">
                        <h1>messages</h1>
                        <div class="bg-teal-100 border border-teal-200 text-teal-500 text-xs rounded px-1">
                            <strong>3</strong>
                        </div>
                        </div>
                        <hr>
                        <!-- end top -->

                        <!-- body -->

                        <!-- item -->
                        <a class="flex flex-row items-center justify-start px-4 py-4 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 transition-all duration-300 ease-in-out" href="#">

                        <div class="w-10 h-10 rounded-full overflow-hidden mr-3 bg-gray-100 border border-gray-300">
                            <img class="w-full h-full object-cover" src="img/user1.jpg" alt="">
                        </div>

                        <div class="flex-1 flex flex-rowbg-green-100">
                            <div class="flex-1">
                            <h1 class="text-sm font-semibold">mohamed said</h1>
                            <p class="text-xs text-gray-500">yeah i know</p>
                            </div>
                            <div class="text-right text-xs text-gray-500">
                            <p>4 min ago</p>
                            </div>
                        </div>

                        </a>
                        <hr>
                        <!-- end item --> 

                        <!-- item -->
                        <a class="flex flex-row items-center justify-start px-4 py-4 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 transition-all duration-300 ease-in-out" href="#">

                        <div class="w-10 h-10 rounded-full overflow-hidden mr-3 bg-gray-100 border border-gray-300">
                            <img class="w-full h-full object-cover" src="img/user2.jpg" alt="">
                        </div>

                        <div class="flex-1 flex flex-rowbg-green-100">
                            <div class="flex-1">
                            <h1 class="text-sm font-semibold">sull goldmen</h1>
                            <p class="text-xs text-gray-500">for sure</p>
                            </div>
                            <div class="text-right text-xs text-gray-500">
                            <p>1 day ago</p>
                            </div>
                        </div>

                        </a>
                        <hr>
                        <!-- end item -->

                        <!-- item -->
                        <a class="flex flex-row items-center justify-start px-4 py-4 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 transition-all duration-300 ease-in-out" href="#">

                        <div class="w-10 h-10 rounded-full overflow-hidden mr-3 bg-gray-100 border border-gray-300">
                            <img class="w-full h-full object-cover" src="img/user3.jpg" alt="">
                        </div>

                        <div class="flex-1 flex flex-rowbg-green-100">
                            <div class="flex-1">
                            <h1 class="text-sm font-semibold">mick</h1>
                            <p class="text-xs text-gray-500">is typing ....</p>
                            </div>
                            <div class="text-right text-xs text-gray-500">
                            <p>31 feb</p>
                            </div>
                        </div>

                        </a>
                        <!-- end item -->


                        <!-- end body -->

                        <!-- bottom -->
                        <hr>
                        <div class="px-4 py-2 mt-2">
                        <a href="#" class="border border-gray-300 block text-center text-xs uppercase rounded p-1 hover:text-teal-500 transition-all ease-in-out duration-500">
                            view all
                        </a>
                        </div>
                        <!-- end bottom -->            
                    </div>
                </div>
                <!-- end messages -->               

                <!-- notifcation -->
                <div class="relative md:mr-5 mr-0 static w-24 md:w-auto bg-gray-200 md:bg-transparent md:border-none border-r border-gray-300 py-2">

                    <button class="text-gray-800 md:text-gray-100 menu-btn w-full md:w-auto p-0 m-0 hover:text-gray-900 focus:text-gray-900 focus:outline-none transition-all ease-in-out duration-300">
                        <em class="far fa-bell"></em>          
                    </button>

                    <button class="hidden fixed top-0 left-0 z-10 w-full h-full menu-overflow"></button>

                    <div class="menu hidden rounded bg-white md:right-0 md:w-full shadow-md absolute z-20 right-0 w-84 mt-5 md:mt-2 py-2 animated faster">
                        <!-- top -->
                        <div class="px-4 py-2 flex flex-row justify-between items-center capitalize font-semibold text-sm">
                        <h1>notifications</h1>
                        <div class="bg-teal-100 border border-teal-200 text-teal-500 text-xs rounded px-1">
                            <strong>5</strong>
                        </div>
                        </div>
                        <hr>
                        <!-- end top -->

                        <!-- body -->

                        <!-- item -->
                        <a class="flex flex-row items-center justify-start px-4 py-4 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 transition-all duration-300 ease-in-out" href="#">

                        <div class="px-3 py-2 rounded mr-3 bg-gray-100 border border-gray-300">
                            <em class="fad fa-birthday-cake text-sm"></em>
                        </div>

                        <div class="flex-1 flex flex-rowbg-green-100">
                            <div class="flex-1">
                            <h1 class="text-sm font-semibold">poll..</h1>
                            <p class="text-xs text-gray-500">text here also</p>
                            </div>
                            <div class="text-right text-xs text-gray-500">
                            <p>4 min ago</p>
                            </div>
                        </div>

                        </a>
                        <hr>
                        <!-- end item -->

                        <!-- item -->
                        <a class="flex flex-row items-center justify-start px-4 py-4 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 transition-all duration-300 ease-in-out" href="#">

                        <div class="px-3 py-2 rounded mr-3 bg-gray-100 border border-gray-300">
                            <em class="fad fa-user-circle text-sm"></em>
                        </div>

                        <div class="flex-1 flex flex-rowbg-green-100">
                            <div class="flex-1">
                            <h1 class="text-sm font-semibold">mohamed..</h1>
                            <p class="text-xs text-gray-500">text here also</p>
                            </div>
                            <div class="text-right text-xs text-gray-500">
                            <p>78 min ago</p>
                            </div>
                        </div>

                        </a>
                        <hr>
                        <!-- end item -->

                        <!-- item -->
                        <a class="flex flex-row items-center justify-start px-4 py-4 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 transition-all duration-300 ease-in-out" href="#">

                        <div class="px-3 py-2 rounded mr-3 bg-gray-100 border border-gray-300">
                            <em class="fad fa-images text-sm"></em>
                        </div>

                        <div class="flex-1 flex flex-rowbg-green-100">
                            <div class="flex-1">
                            <h1 class="text-sm font-semibold">new imag..</h1>
                            <p class="text-xs text-gray-500">text here also</p>
                            </div>
                            <div class="text-right text-xs text-gray-500">
                            <p>65 min ago</p>
                            </div>
                        </div>

                        </a>
                        <hr>
                        <!-- end item -->

                        <!-- item -->
                        <a class="flex flex-row items-center justify-start px-4 py-4 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 transition-all duration-300 ease-in-out" href="#">

                        <div class="px-3 py-2 rounded mr-3 bg-gray-100 border border-gray-300">
                            <em class="fad fa-alarm-exclamation text-sm"></em>
                        </div>

                        <div class="flex-1 flex flex-rowbg-green-100">
                            <div class="flex-1">
                            <h1 class="text-sm font-semibold">time is up..</h1>
                            <p class="text-xs text-gray-500">text here also</p>
                            </div>
                            <div class="text-right text-xs text-gray-500">
                            <p>1 min ago</p>
                            </div>
                        </div>

                        </a>
                        <!-- end item -->


                        <!-- end body -->

                        <!-- bottom -->
                        <hr>
                        <div class="px-4 py-2 mt-2">
                        <a href="#" class="border border-gray-300 block text-center text-xs uppercase rounded p-1 hover:text-teal-500 transition-all ease-in-out duration-500">
                            view all
                        </a>
                        </div>
                        <!-- end bottom -->            
                    </div>
                </div>
                <!-- end notifcation -->

                <!-- user -->
                <base-dropdown tag="div" class="md:relative w-full bg-gray-200 md:bg-transparent animated py-1 md:py-0">
                    <div class="fixed inset-0 w-full h-full bg-black opacity-50"></div>
                    <button slot="title" class="z-10 menu-btn focus:outline-none flex items-center ml-auto px-3 pr-8 md:px-0">
                        <div class="w-8 h-8 overflow-hidden rounded-full z-10">
                            <img :src="user.photo_url" class="w-full h-full object-cover" alt="s" >
                        </div> 
                        <div class="ml-2 capitalize flex z-10">
                            <h1 class="text-sm text-gray-600 md:text-gray-100 font-semibold m-0 p-0 leading-none">{{ user.name }}</h1>
                            <em class="fad fa-chevron-down ml-2 text-xs leading-none text-gray-800 md:text-gray-100"></em>
                        </div>                        
                    </button>

                    <template>
                        <div class="text-gray-500 menu w-full md:rounded bg-white shadow-md absolute z-20 right-0 md:w-40 mt-2 md:mt-6 py-2 md:border-t md:border-b md:border-gray-200 md:mt-1 animated faster">

                            <!-- item -->
                            <a class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out" href="#">
                            <em class="fad fa-user-edit text-xs mr-1"></em>
                                edit my profile
                            </a>     
                            <!-- end item -->

                            <!-- item -->
                            <a class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out" href="#">
                                <em class="fad fa-inbox-in text-xs mr-1"></em>
                                my inbox
                            </a>     
                            <!-- end item -->

                            <!-- item -->
                            <a class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out" href="#">
                                <em class="fad fa-badge-check text-xs mr-1"></em>
                                tasks
                            </a>     
                            <!-- end item -->

                            <!-- item -->
                            <a class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out" href="#">
                            <em class="fad fa-comment-alt-dots text-xs mr-1"></em>
                                chats
                            </a>     
                            <!-- end item -->

                            <hr>

                            <!-- item -->
                            <a  @click.prevent="logout" class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out" href="#">
                                <em class="fad fa-user-times text-xs mr-1"></em>
                                {{ $t('logout') }}
                            </a>     
                            <!-- end item -->

                        </div>
                    </template>
                </base-dropdown>
                <!-- end user -->

            </div>
        </div>
    </div>
    <!-- end navbar -->
</template>

<script>
import { mapGetters } from 'vuex'
import LocaleDropdown from '../LocaleDropdown'

export default {
  components: {
    LocaleDropdown
  },


  data: () => ({
    appName: window.config.appName,
    isOpen:false,
    isOpenSidebar:false
  }),


  computed: mapGetters({
    user: 'auth/user',
    companyName: 'settings/company_name',
    lightLogo: 'settings/light_logo',
  }),

  methods: {

    isSidebarOpen() {
        this.isOpenSidebar = !this.isOpenSidebar;
        this.$emit('sidebarOpen', this.isOpenSidebar)
    },


    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>