<template>
  <div>

    <topbar @sidebarOpen="isSidebarOpen" />  <!-- Topbar -->
    <div class="h-screen flex flex-row flex-wrap">
      
      <sidebar :class="[ isOpenSidebar ? 'block fadeIn md:slideInRight md:-ml-64' : 'hidden md:slideInLeft md:ml-0' ]" class="md:block"/> <!-- Sidebar -->

      <!-- strat content -->
      <div class="bg-gray-100 flex-1 mt-24 md:mt-20 transition" 
           :class="[ isOpenSidebar ? 'md:ml-0' : 'md:ml-64' ]"> 
            <child />
      </div>

    </div>
    
  </div>
</template>

<script>
import Topbar from '~/components/Layouts/Topbar'
import Sidebar from '~/components/Layouts/Sidebar'

export default {
  name: 'MainLayout',

  components: {
    Topbar,Sidebar
  },

  data: () => ({
    isOpenSidebar: false,
  }),

  methods:{
    isSidebarOpen(data){
      this.isOpenSidebar = data
    }
  }

}
</script>
