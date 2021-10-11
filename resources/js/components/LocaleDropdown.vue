<template>
  <div @click="isOpen = !isOpen" class="relative" v-click-outside="closeDropDown">
    <a class="text-white flex items-center z-10" href="#" >
      {{ locales[locale] }}
      <svg class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </a>
    <div :class="[ isOpen ? 'fadeIn' : 'hidden']" class="text-gray-500 menu w-full md:rounded bg-white shadow-md absolute z-20 left-0 md:w-40 mt-2 md:mt-6 overflow-hidden md:border-t md:border-b md:border-gray-200 md:mt-1 animated faster">
      
      <a v-for="(value, key) in locales" :key="key" class="z-10 px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out" href="#"
         @click.prevent="setLocale(key)"
      >
        {{ value }}
      </a>
      

      
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { loadMessages } from '~/plugins/i18n'

export default {
  computed: mapGetters({
    locale: 'lang/locale',
    locales: 'lang/locales'
  }),


  data() {
    return {
      isOpen: false
    };
  },

  methods: {
    setLocale (locale) {
      if (this.$i18n.locale !== locale) {
        loadMessages(locale)

        this.$store.dispatch('lang/setLocale', { locale })
      }
    },

    closeDropDown() {
      this.isOpen = false;
    }

  }
}
</script>
