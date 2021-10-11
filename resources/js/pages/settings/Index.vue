<template>
	<div>
        <!-- breadcrumbs Start -->
        <breadcrumbs :items="breadcrumbs" :current="breadcrumbsCurrent"></breadcrumbs>
        <!-- breadcrumbs end -->

        <div class="main-content">
            <!-- Section one -->
            <div class="card border shadow px-4 rounded-lg bg-gray-200">
                <div class="py-3 flex justify-between">
                    <h2 class="text-gray-600 text-lg">{{ $t('setting.your_system') }}</h2>
                    <div>
                        <button class="px-2 focus:outline-none" v-if="BSetting==true" @click="BSetting=!BSetting">
                            <em class="fad fa-times-circle fa-spin text-pink-500"></em>
                        </button>
                        <button class="px-2 focus:outline-none" v-else @click="BSetting=!BSetting">
                            <em class="fad fa-bars text-indigo-500" ></em>
                        </button>
                    </div>
                </div><!-- /. card-header -->

                <div class="setting-wrap mb-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 pb-4" v-if="BSetting==true">
                    <router-link :to="{ name: 'settings.general' }" v-ripple class="card-item bg-white rounded shadow text-gray-500 text-xm transition delay-150 duration-300 ease-in-out hover:bg-gray-100 hover:border-indigo-600 p-2 flex item-center border-l-2 border-indigo-300">
                        <div>
                            <em class="fad fa-sliders-v-square w-10 h-10 inline-block rounded bg-indigo-100 text-indigo-600 text-lg mr-3 mt-1 flex items-center justify-center"></em>
                        </div>
                        <div class="inline-block">
                            <h2 class="text-md text-indigo-400">{{ $t('setting.company') }}</h2>
                            <p class="text-sm text-gray-500">{{ $t('setting.company_desc') }}</p>
                        </div>
                    </router-link><!-- single-settings -->
                    <router-link :to="{ name: 'settings.team' }" v-ripple class="card-item bg-white rounded shadow text-gray-500 text-xm transition delay-150 duration-300 ease-in-out hover:bg-gray-100 hover:border-indigo-600 p-2 flex item-center border-l-2 border-indigo-300">
                        <div>
                            <em class="fad fa-sliders-v-square w-10 h-10 inline-block rounded bg-indigo-100 text-indigo-600 text-lg mr-3 mt-1 flex items-center justify-center"></em>
                        </div>
                        <div class="inline-block">
                            <h2 class="text-md text-indigo-400">{{ $t('setting.team') }}</h2>
                            <p class="text-sm text-gray-500">{{ $t('setting.team_desc') }}</p>
                        </div>
                    </router-link><!-- single-settings -->
                    <router-link :to="{ name: 'settings.payment' }" v-ripple class="card-item bg-white rounded shadow text-gray-500 text-xm transition delay-150 duration-300 ease-in-out hover:bg-gray-100 hover:border-indigo-600 p-2 flex item-center border-l-2 border-indigo-300">
                        <div>
                            <em class="fad fa-sliders-v-square w-10 h-10 inline-block rounded bg-indigo-100 text-indigo-600 text-lg mr-3 mt-1 flex items-center justify-center"></em>
                        </div>
                        <div class="inline-block">
                            <h2 class="text-md text-indigo-400">{{ $t('setting.payments') }}</h2>
                            <p class="text-sm text-gray-500">{{ $t('setting.payment_desc') }}</p>
                        </div>
                    </router-link><!-- single-settings -->
                    <router-link :to="{ name: 'settings.orders'}" v-ripple class="card-item bg-white rounded shadow text-gray-500 text-xm transition delay-150 duration-300 ease-in-out hover:bg-gray-100 hover:border-indigo-600 p-2 flex item-center border-l-2 border-indigo-300">
                        <div>
                            <em class="fad fa-sliders-v-square w-10 h-10 inline-block rounded bg-indigo-100 text-indigo-600 text-lg mr-3 mt-1 flex items-center justify-center"></em>
                        </div>
                        <div class="inline-block">
                            <h2 class="text-md text-indigo-400">{{ $t('setting.orders') }}</h2>
                            <p class="text-sm text-gray-500">{{ $t('setting.orders_desc') }}</p>
                        </div>
                    </router-link><!-- single-settings -->
                    <router-link :to="{ name: 'settings.roles'}" v-ripple class="card-item bg-white rounded shadow text-gray-500 text-xm transition delay-150 duration-300 ease-in-out hover:bg-gray-100 hover:border-indigo-600 p-2 flex item-center border-l-2 border-indigo-300">
                        <div>
                            <em class="fad fa-sliders-v-square w-10 h-10 inline-block rounded bg-indigo-100 text-indigo-600 text-lg mr-3 mt-1 flex items-center justify-center"></em>
                        </div>
                        <div class="inline-block">
                            <h2 class="text-md text-indigo-400">{{ $t('setting.role_permission') }}</h2>
                            <p class="text-sm text-gray-500">{{ $t('setting.role_permission_desc') }}</p>
                        </div>
                    </router-link><!-- single-settings -->

                    <router-link :to="{ name: 'settings.tags'}" v-ripple class="card-item bg-white rounded shadow text-gray-500 text-xm transition delay-150 duration-300 ease-in-out hover:bg-gray-100 hover:border-indigo-600 p-2 flex item-center border-l-2 border-indigo-300">
                        <div>
                            <em class="fad fa-sliders-v-square w-10 h-10 inline-block rounded bg-indigo-100 text-indigo-600 text-lg mr-3 mt-1 flex items-center justify-center"></em>
                        </div>
                        <div class="inline-block">
                            <h2 class="text-md text-indigo-400">{{ $t('setting.tags') }}</h2>
                            <p class="text-sm text-gray-500">{{ $t('setting.tag_desc') }}</p>
                        </div>
                    </router-link><!-- single-settings -->
                    <router-link :to="{ name: 'settings.logs'}" v-ripple class="card-item bg-white rounded shadow text-gray-500 text-xm transition delay-150 duration-300 ease-in-out hover:bg-gray-100 hover:border-indigo-600 p-2 flex item-center border-l-2 border-indigo-300">
                        <div>
                            <em class="fad fa-sliders-v-square w-10 h-10 inline-block rounded bg-indigo-100 text-indigo-600 text-lg mr-3 mt-1 flex items-center justify-center"></em>
                        </div>
                        <div class="inline-block">
                            <h2 class="text-md text-indigo-400">{{ $t('setting.system_log') }}</h2>
                            <p class="text-sm text-gray-500">{{ $t('setting.system_log_desc') }}</p>
                        </div>
                    </router-link><!-- single-settings -->

                </div><!-- /. setting-wrap -->
            </div>
            <!-- /. Section one end -->

            <!-- Section Two (Your Client Panel) -->
            <div class="card border shadow px-4 rounded-lg bg-gray-200 mt-8">
                <div class="py-3 flex justify-between">
                    <h2 class="text-gray-600 text-lg">{{ $t('setting.your_client_panel') }}</h2>
                    <div>
                        <button class="px-2 focus:outline-none" v-if="BSetting==true" @click="BSetting=!BSetting">
                            <em class="fad fa-times-circle fa-spin text-pink-500"></em>
                        </button>
                        <button class="px-2 focus:outline-none" v-else @click="BSetting=!BSetting">
                            <em class="fad fa-bars text-indigo-500" ></em>
                        </button>
                    </div>
                </div><!-- /. card-header -->

                <div class="setting-wrap mb-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 pb-4" v-if="BSetting==true">
                    <router-link :to="{ name: 'settings.general' }" class="card-item bg-white rounded shadow text-gray-500 text-xm transition delay-150 duration-300 ease-in-out hover:bg-gray-100 hover:border-indigo-600 p-2 flex item-center border-l-2 border-indigo-300">
                        <div>
                            <em class="fad fa-sliders-v-square w-10 h-10 inline-block rounded bg-indigo-100 text-indigo-600 text-lg mr-3 mt-1 flex items-center justify-center"></em>
                        </div>
                        <div class="inline-block">
                            <h2 class="text-md text-indigo-400">{{ $t('setting.templates') }}</h2>
                            <p class="text-sm text-gray-500">{{ $t('setting.templates_desc') }}</p>
                        </div>
                    </router-link><!-- single-settings -->
                    <router-link :to="{ name: 'settings.payment' }" class="card-item bg-white rounded shadow text-gray-500 text-xm transition delay-150 duration-300 ease-in-out hover:bg-gray-100 hover:border-indigo-600 p-2 flex item-center border-l-2 border-indigo-300">
                        <div>
                            <em class="fad fa-sliders-v-square w-10 h-10 inline-block rounded bg-indigo-100 text-indigo-600 text-lg mr-3 mt-1 flex items-center justify-center"></em>
                        </div>
                        <div class="inline-block">
                            <h2 class="text-md text-indigo-400">{{ $t('setting.menus') }}</h2>
                            <p class="text-sm text-gray-500">{{ $t('setting.menus_desc') }}</p>
                        </div>
                    </router-link><!-- single-settings -->
                </div><!-- /. setting-wrap -->
            </div>
            <!-- /. Section Two end -->

            <!-- Section Three -->
            <div class="card border shadow px-4 rounded-lg bg-gray-200 mt-8">
                <div class="py-3 flex justify-between">
                    <h2 class="text-gray-600 text-lg">{{ $t('setting.your_account') }}</h2>
                    <div>
                        <button class="px-2 focus:outline-none" v-if="account==true" @click="account=!account">
                            <em class="fad fa-times-circle fa-spin text-pink-500"></em>
                        </button>
                        <button class="px-2 focus:outline-none" v-else @click="account=!account">
                            <em class="fad fa-bars text-indigo-500" ></em>
                        </button>
                    </div>
                </div><!-- /. card-header -->

                <div class="setting-wrap mb-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 pb-4" v-if="account==true">
                    <router-link to="/" class="card-item bg-white rounded shadow text-gray-500 text-xm transition delay-150 duration-300 ease-in-out hover:bg-gray-100 hover:border-indigo-600 p-2 flex item-center border-l-2 border-indigo-300">
                        <div>
                            <em class="fad fa-sliders-v-square w-10 h-10 inline-block rounded bg-indigo-100 text-indigo-600 text-lg mr-3 mt-1 flex items-center justify-center"></em>
                        </div>
                        <div class="inline-block">
                            <h2 class="text-md text-indigo-400">{{ $t('setting.billing_upgrade') }}</h2>
                            <p class="text-sm text-gray-500">{{ $t('setting.billing_upgrade_desc') }}</p>
                        </div>
                    </router-link><!-- single-settings -->
                    <router-link to="/" class="card-item bg-white rounded shadow text-gray-500 text-xm transition delay-150 duration-300 ease-in-out hover:bg-gray-100 hover:border-indigo-600 p-2 flex item-center border-l-2 border-indigo-300">
                        <div>
                            <em class="fad fa-sliders-v-square w-10 h-10 inline-block rounded bg-indigo-100 text-indigo-600 text-lg mr-3 mt-1 flex items-center justify-center"></em>
                        </div>
                        <div class="inline-block">
                            <h2 class="text-md text-indigo-400">{{ $t('setting.contact_support') }}</h2>
                            <p class="text-sm text-gray-500">{{ $t('setting.contact_support_desc') }}</p>
                        </div>
                    </router-link><!-- single-settings -->
                    <router-link to="/" class="card-item bg-white rounded shadow text-gray-500 text-xm transition delay-150 duration-300 ease-in-out hover:bg-gray-100 hover:border-indigo-600 p-2 flex item-center border-l-2 border-indigo-300">
                        <div>
                            <em class="fad fa-sliders-v-square w-10 h-10 inline-block rounded bg-indigo-100 text-indigo-600 text-lg mr-3 mt-1 flex items-center justify-center"></em>
                        </div>
                        <div class="inline-block">
                            <h2 class="text-md text-indigo-400">{{ $t('setting.product_updates') }}</h2>
                            <p class="text-sm text-gray-500">{{ $t('setting.product_updates_desc') }}</p>
                        </div>
                    </router-link><!-- single-settings -->
                </div><!-- /. setting-wrap -->
            </div>
            <!-- /. Section Three end -->
        </div>
	</div>
</template>

<script>

export default {  
  middleware: ['auth','admin'],

  metaInfo () {
    return { title: this.$t('Settings') }
  },


    data:()=>({
      BSetting:true,
      account:true,
      breadcrumbsCurrent: 'Settings' ,
      breadcrumbs:[
        {
          name:'settings',
          url: ''
        }
      ]
    })

}

</script>