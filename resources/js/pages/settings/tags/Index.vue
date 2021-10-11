<template>
	<div>
        <!-- breadcrumbs Start -->
        <breadcrumbs :items="breadcrumbs" :current="breadcrumbsCurrent" />
        <!-- breadcrumbs end -->

        <div class="main-content">
            <div class="pb-12 md:pb-0 flex justify-between items-center relative">
                <tag-table />
            </div>
        </div>
	</div>
</template>

<script>
import TagTable from '~/components/Tag/TagTable'

export default {  
  middleware: ['auth','admin'],
  components: {
    TagTable
  },

  data: () => ({
      breadcrumbsCurrent: 'Tags',
      breadcrumbs:[
        {
          name:'Settings',
          url: 'settings'
        },
        {
          name:'Tags',
          url: ''
        },
      ]

  }),

  metaInfo () {
    return { title: this.$t('Tags') }
  }

}

</script>