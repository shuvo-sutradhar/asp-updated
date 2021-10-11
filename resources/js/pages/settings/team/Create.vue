<template>
    <div>
        <!-- breadcrumbs Start -->
        <breadcrumbs :items="breadcrumbs" :current="breadcrumbsCurrent"></breadcrumbs>
        <!-- breadcrumbs end -->

        <!-- Main content Start -->
        <div class="main-content">
            <div class="md:pb-0 flex justify-between items-center relative">
                <team-create />
            </div>
        </div>        
        <!-- Main content Start -->


    </div>
</template>


<script>
import TeamCreate from '~/components/Team/Create'
export default {
    middleware: ['auth','admin'],
    components: {
        TeamCreate
    },

    data:()=>({
      breadcrumbsCurrent: 'add_new' ,
      breadcrumbs:[
        {
          name:'settings',
          url: 'settings'
        },
        {
          name:'setting.team',
          url: 'settings.team'
        },
        {
          name:'create',
          url: ''
        },
      ]
    })
}
</script>