<template>
	<div>
        <!-- breadcrumbs Start -->
        <breadcrumbs :items="breadcrumbs" :current="breadcrumbsCurrent"></breadcrumbs>
        
        <!-- breadcrumbs end -->

        <div class="main-content">
            <div class="container mx-auto max-w-3xl">
                <role-create />
            </div>
        </div>

	</div>
</template>

<script>
import RoleCreate from '~/components/Role/Create'
export default {  
  middleware: ['auth','admin'],
  components: {
      RoleCreate
  },

  metaInfo () {
    return { title: this.$t('Role') }
  },

    data:()=>({
      breadcrumbsCurrent: 'roles' ,
      breadcrumbs:[
        {
          name:'settings',
          url: 'settings'
        },
        {
          name:'Roles',
          url: 'settings.roles'
        },
        {
          name:'Create',
          url: ''
        },
      ]
    })
}

</script>