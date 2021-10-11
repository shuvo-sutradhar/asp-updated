<template>
  <!-- start sidebar -->
  <div class="fixed z-20 md:z-0 lg:z-0 overflow-auto bg-white border-r border-gray-300 p-6 w-full md:w-64 h-full animated faster pt-32 md:pt-24">
    
    <!-- sidebar content -->
    <div class="flex flex-col">

      <p class="uppercase text-xs text-indigo-600 mb-4 tracking-wider">{{ $t('sidebar.activity') }}</p>

      <!-- link -->
      <router-link :to="{ name: 'home' }" class="mb-3 capitalize font-medium text-sm hover:text-pink-600 transition ease-in-out duration-500 text-gray-700"> 
        <em class="fad fa-chart-pie mr-2"></em>      
        {{ $t('sidebar.dashboard') }}
      </router-link >
      <!-- end link -->

      <!-- link -->
      <router-link :to="{ name: 'orders' }" class="mb-3 capitalize font-medium text-sm hover:text-pink-600 transition ease-in-out duration-500 text-gray-700"> 
        <em class="fad fa-shopping-cart mr-2"></em>
        {{ $t('sidebar.orders') }}
      </router-link>
      <!-- end link -->

      <!-- link -->
      <router-link :to="{ name: 'clients' }" class="mb-3 capitalize font-medium text-sm hover:text-pink-600 transition ease-in-out duration-500 text-gray-700">
        <em class="fal fa-user mr-2"></em>
        {{ $t('sidebar.clients') }}
      </router-link>
      <!-- end link -->

      <!-- link -->
      <a href="./index-1.html" class="mb-3 capitalize font-medium text-sm hover:text-pink-600 transition ease-in-out duration-500 text-gray-700"> 
        <em class="fad fa-comment-check mr-2"></em>
        {{ $t('sidebar.tickets') }}
      </a>
      <!-- end link -->

      <p class="uppercase text-indigo-600 mb-4 text-xs mt-4 tracking-wider">{{ $t('sidebar.billing') }}</p>

      <!-- link -->
      <router-link :to="{ name: 'invoices' }" class="mb-3 capitalize font-medium text-sm hover:text-pink-600 transition ease-in-out duration-500 text-gray-700">
        <em class="fad fa-file-invoice-dollar mr-2"></em>
        {{ $t('sidebar.invoices') }}
      </router-link>
      <!-- end link -->

      <!-- link -->
      <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-pink-600 transition ease-in-out duration-500 text-gray-700">
        <em class="fad fa-atom-alt mr-2"></em>
        
        {{ $t('sidebar.subscriptions') }}
      </a>
      <!-- end link -->

      <p class="uppercase text-xs text-indigo-600 mb-4 mt-4 tracking-wider">{{ $t('sidebar.marketing') }}</p>

      <!-- link -->
      <router-link :to="{ name: 'discounts' }" class="mb-3 capitalize font-medium text-sm hover:text-pink-600 transition ease-in-out duration-500 text-gray-700">
       <em class="fad fa-badge-percent mr-2"></em>
        {{ $t('sidebar.discounts') }}
      </router-link>
      <!-- end link -->

      <!-- link -->
      <a href="#" class="mb-3 capitalize font-medium text-sm hover:text-pink-600 transition ease-in-out duration-500 text-gray-700">
        <em class="fab fa-creative-commons-nc mr-2"></em>
        {{ $t('sidebar.affliates') }}
      </a>
      <!-- end link -->

      <p class="uppercase text-xs text-indigo-600 mb-4 mt-4 tracking-wider">{{ $t('sidebar.setup') }}</p>

      <!-- link -->
      <router-link :to="{ name: 'services' }" class="mb-3 capitalize font-medium text-sm hover:text-pink-600 transition ease-in-out duration-500 text-gray-700">
       <em class="fad fa-luggage-cart mr-2"></em>
        {{ $t('sidebar.services') }}
      </router-link>
      <!-- end link -->

      <!-- link -->
      <router-link :to="{ name: 'forms' }" class="mb-3 capitalize font-medium text-sm hover:text-pink-600 transition ease-in-out duration-500 text-gray-700">
       <em class="fad fa-server mr-2"></em>
        {{ $t('sidebar.order_forms') }}
      </router-link>
      <!-- end link -->

      <!-- link -->
      <router-link :to="{ name: 'modules' }" class="mb-3 capitalize font-medium text-sm hover:text-pink-600 transition ease-in-out duration-500 text-gray-700">
       <em class="fad fa-th-large mr-2"></em>
        
        {{ $t('sidebar.modules') }}
      </router-link>
      <!-- end link -->

      <!-- link -->
      <router-link :to="{ name: 'plugin' }" class="mb-3 capitalize font-medium text-sm hover:text-indigo-600 transition ease-in-out duration-500 text-gray-700">
       <em class="fal fa-plug mr-2"></em>
        {{ $t('sidebar.plugins') }}
      </router-link >
      <!-- end link -->


      <!-- link -->
      <router-link :to="{ name: 'settings' }" class="mb-3 capitalize font-medium text-sm hover:text-pink-600 transition ease-in-out duration-500 text-gray-700">
       <em class="fad fa-cogs mr-2"></em>
        {{ $t('sidebar.settings') }}
      </router-link>
      <!-- end link -->

      <!-- link -->
      <a href="./email.html" class="mb-3 capitalize font-medium text-sm hover:text-indigo-600 transition ease-in-out duration-500 text-gray-700">
       <em class="fal fa-trash mr-2"></em>
        {{ $t('sidebar.trash') }}
      </a>
      <!-- end link -->
    </div>
    <!-- end sidebar content -->

  </div>
  <!-- end sidbar -->
</template>

<script>

export default {


}
</script>