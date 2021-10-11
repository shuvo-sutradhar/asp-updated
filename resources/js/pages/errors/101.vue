<template>
  <card class="text-center">
    <h3 class="mb-4">
      101- Permission Denied
    </h3>

    <div class="links">
      <router-link :to="{ name: 'welcome' }">
        {{ $t('go_home') }}
      </router-link>
    </div>
  </card>
</template>

<script>
export default {
  name: 'PermissionDenied'
}
</script>
