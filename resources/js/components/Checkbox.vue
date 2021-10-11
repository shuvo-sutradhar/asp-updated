<template>

   <div>
      <label :for="id || name" class="self-start text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 p-1 -ml-1 mr-1 rounded-lg cursor-pointer ">
          <input
            :id="id || name"
            :name="name"
            :checked="internalValue"
            type="checkbox"
            class="form-checkbox focus:outline-none focus:shadow-outline w-4 h-4"
            @click="handleClick"
          >
      </label>
      <label>
        <slot />
      </label>
   </div>

</template>

<script>
export default {
  name: 'Checkbox',

  props: {
    id: { type: String, default: null },
    name: { type: String, default: 'checkbox' },
    value: { type: Boolean, default: false },
    checked: { type: Boolean, default: false }
  },

  data: () => ({
    internalValue: false
  }),

  watch: {
    value (val) {
      this.internalValue = val
    },

    checked (val) {
      this.internalValue = val
    },

    internalValue (val, oldVal) {
      if (val !== oldVal) {
        this.$emit('input', val)
      }
    }
  },

  created () {
    this.internalValue = this.value

    if ('checked' in this.$options.propsData) {
      this.internalValue = this.checked
    }
  },

  methods: {
    handleClick (e) {
      this.$emit('click', e)

      if (!e.isPropagationStopped) {
        this.internalValue = e.target.checked
      }
    }
  }
}
</script>


<style>

.form-checkbox {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  -webkit-print-color-adjust: exact;
  color-adjust: exact;
  display: inline-block;
  vertical-align: middle;
  background-origin: border-box;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  flex-shrink: 0;
  color: #667EEA;
  background-color: #fff;
  border-color: #e2e8f0;
  border-width: 1px;
  border-radius: 0.25rem;
}


.opt-hover .form-checkbox{
  color: #667EEA;
  background-color: #C3DAFE;
  border-color: #667EEA;
}


.form-checkbox:checked {
  background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M5.707 7.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414L7 8.586 5.707 7.293z'/%3e%3c/svg%3e");
  border-color: transparent;
  background-color: #667EEA;
  background-size: 100% 100%;
  background-position: center;
  background-repeat: no-repeat;
}

.form-checkbox.checkbox-lg{
  height: 2em;
  width: 2em; 
  border-radius: 100%;
}

.form-checkbox.checkbox-sm{
  height: 1.2em;
  width: 1.2em; 
  border-radius: 100%;
}

.form-checkbox.checkbox-lg:checked{
  background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='rgb(102, 126, 234)' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M5.707 7.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414L7 8.586 5.707 7.293z'/%3e%3c/svg%3e");
  border-radius: 100%;
  border-color: #667eea;
  background-color: #c3dafe;
}

</style>