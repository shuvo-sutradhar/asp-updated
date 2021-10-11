<template>
  <div class="main-content py-6">
    <!-- <general-report />
    <analytics />
    <quick-info /> -->
  </div>
</template>

<script>
// import GeneralReport from '~/components/Dashboard/GeneralReport'
// import Analytics from '~/components/Dashboard/Analytics'
// import QuickInfo from '~/components/Dashboard/QuickInfo'
export default {
  middleware: 'auth',

  components: {
    // GeneralReport , Analytics, QuickInfo
  },


  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
