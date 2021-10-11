<template>
	<div>
        <!-- breadcrumbs Start -->
        <breadcrumbs :items="breadcrumbs" :current="breadcrumbsCurrent"></breadcrumbs>
        
        <!-- breadcrumbs end -->

        <div class="main-content">
            <div class="container mx-auto max-w-3xl">
                <role-edit />
            </div>
        </div>

	</div>
</template>

<script>
import RoleEdit from '~/components/Role/Edit'
export default {  
  middleware: ['auth','admin'],
  components: {
      RoleEdit
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