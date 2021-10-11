<template>
  <div class="space-y-1">
    <!-- <label id="listbox-label" class="block text-sm leading-5 font-medium text-gray-700">
      <slot name="SelectLabel"></slot>
    </label> -->

    <div class="relative" v-click-outside="closeDropdown">
      <span class="inline-block w-full rounded-md shadow-sm">
        <button type="button" @click="openDropdown" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label" class="cursor-pointer relative w-full rounded-lg border-2 border-gray-200 bg-white pl-3 pr-10 py-2 text-left focus:outline-none focus:border-indigo-500 transition ease-in-out duration-150 sm:text-sm sm:leading-5">
          <div class="flex items-center space-x-3">
            <!-- <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="flex-shrink-0 h-6 w-6 rounded-full" /> -->
            <span class="block truncate text-sm text-gray-700 font-medium tracking-wide">
              {{ value }}
            </span>
          </div>
          <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
              <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
        </button>
      </span>

      <!-- Select popover, show/hide based on select state. -->
      <div v-show="isOpen" class="absolute z-20 mt-1 w-full rounded-md overflow-hidden bg-white shadow-xs">
        <div class="w-full py-2 px-3 z-10 bg-gray-100">
          <input type="text" class="border-2 border-gray-200 w-full rounded-md px-3 py-1 text-sm text-gray-700 focus:outline-none focus:border-indigo-300" placeholder="Search..." />
        </div>
        <ul tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-item-3" class="max-h-dropdown py-1 text-base leading-6 overflow-auto focus:outline-none sm:text-sm sm:leading-5">

          <li tabindex="0" @click="select(d)" id="listbox-item-0" role="option" v-for="d in data" v-bind:key="d" class="text-gray-700 text-sm cursor-default select-none relative py-2 pl-3 pr-9 cursor-pointer hover:text-white hover:bg-indigo-500 focus:outline-none focus:text-white focus:bg-indigo-600">
            <div class="flex items-center space-x-3">
              <img src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80" alt="" class="flex-shrink-0 h-6 w-6 rounded-full" />
              <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
              <span class="block truncate" v-bind:class="{ 'font-normal' : !isSelected(d) , 'font-semibold' : isSelected(d)}">
                {{ d }}
              </span>
            </div>

            <!--
              Checkmark, only display for selected option.
              Highlighted: "text-white", Not Highlighted: "text-indigo-600"
            -->
            <span v-show="isSelected(d)" class="absolute inset-y-0 right-0 flex items-center pr-4">
              <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
            </span>
          </li>

          <!-- More options... -->
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
// import ClickOutside from 'vue-click-outside'
export default {
  name: 'VueSelect',
  props: {
    data: Array,
    value: String,
    default:String
  },
  data() {
    return {
      'isOpen' : false
    }
  },
  methods: {
    isSelected(value) {
      return this.value === value;
    },
    closeDropdown() {
      this.isOpen = false;
    },
    openDropdown() {
      this.isOpen = true;
    },
    select(value) {
      this.isOpen = false;
      this.$emit('valueSelect', value);
    }
  }
}
</script>


<style scoped>

.max-h-dropdown{
  max-height: 230px;
}

</style>