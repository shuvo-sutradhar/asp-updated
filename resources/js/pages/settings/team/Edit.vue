<template>
    <div>
        <!-- breadcrumbs Start -->
        <breadcrumbs :items="breadcrumbs" :current="breadcrumbsCurrent"></breadcrumbs>
        <!-- breadcrumbs end -->

        <!-- Main content Start -->
        <div class="main-content">
            <div class="md:pb-0 flex justify-between items-center relative">
                <team-edit />
            </div>
        </div>        
        <!-- Main content Start -->


    </div>
</template>


<script>
import TeamEdit from '~/components/Team/Edit'
export default {
    middleware: ['auth','admin'],
    components: {
        TeamEdit
    },

    data:()=>({
      breadcrumbsCurrent: 'Edit' ,
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
          name:'Edit',
          url: ''
        },
      ]
    })
}
</script>