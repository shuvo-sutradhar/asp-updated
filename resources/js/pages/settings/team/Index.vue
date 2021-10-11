<template>
	<div>
        <!-- breadcrumbs Start -->
        <breadcrumbs :items="breadcrumbs" :current="breadcrumbsCurrent"></breadcrumbs>
        <!-- breadcrumbs end -->

        <div class="main-content">
            <div class="pb-12 md:pb-0 flex justify-between items-center relative">
                <team-table />
            </div>
        </div>
	</div>
</template>

<script>
import TeamTable from '~/components/Team/TeamTable'

export default {  
  middleware: ['auth','admin'],
  components: {
    TeamTable
  },

  data: () => ({
      breadcrumbsCurrent: 'Team members',
      breadcrumbs:[
        {
          name:'Settings',
          url: 'settings'
        },
        {
          name:'Team',
          url: ''
        },
      ]

  }),

  metaInfo () {
    return { title: this.$t('Team') }
  }

}

</script>