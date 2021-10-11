import Vue from 'vue'

import Swal from 'sweetalert2';
window.Swal = Swal;
const toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  confirmButtonColor: '#667eea',
  cancelButtonColor: '#ed64a6',
  timer: 4000
});
window.toast = toast;


// Vue Fire
window.Fire =  new Vue();