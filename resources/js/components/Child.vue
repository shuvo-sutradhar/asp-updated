<template>
    <vue-page-transition name="fade">
    <slot>
      <router-view />
    </slot>
  </vue-page-transition>
</template>

<script>
export default {
  name: 'Child'
}
</script>
