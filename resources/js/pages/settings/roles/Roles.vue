<template>
	<div>
        <!-- breadcrumbs Start -->
        <breadcrumbs :items="breadcrumbs" :current="breadcrumbsCurrent"></breadcrumbs>
        
        <!-- breadcrumbs end -->

        <div class="main-content">
            <div class="container mx-auto max-w-3xl">
                <role-table />
            </div>
        </div>

	</div>
</template>

<script>
import RoleTable from '~/components/Role/Index'
export default {  
  middleware: ['auth','admin'],
  components: {
      RoleTable
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
          name:'roles',
          url: ''
        }
      ]
    })
}

</script>