<template>
   <div>
      <!-- <div class="py-6 px-10">
         <label for="name" class="block uppercase tracking-wide text-gray-600 text-xs font-bold">Services Photos (optional) <a href="#" class="text-indigo-500"><i class="fal fa-question-circle"></i></a></label>
         <div class="mt-4">
            <div class="relative border-dashed border-2 border-gray-400 py-6 flex flex-col justify-center items-center hover:bg-gray-100 transition">
               <p class="mb-1 text-sm text-gray-600 flex flex-wrap justify-center">
                  <span>Drag and drop your </span>&nbsp;<span>video anywhere or</span>
               </p>
               <input type="file" multiple="true" @change="uploadVideo" class="opacity-0 absolute w-full h-full">
                  <button class="mt-2 text-sm rounded-sm px-3 py-1 bg-gray-200 hover:bg-gray-300 focus:shadow-outline focus:outline-none">
                  Upload a video
               </button>
            </div>

            <video controls>
               <source type="video/webm" src="">
            </video>

         </div>
      </div>
      <hr class="border-gray-200"> -->
      <div class="py-6 px-10">
         <label for="name" class="block uppercase tracking-wide text-gray-600 text-xs font-bold">Services Photos (optional) <a href="#" class="text-indigo-500"><i class="fal fa-question-circle"></i></a></label>
         <div class="flex mt-4">
            <div class="w-full h-full flex flex-col">
               <div class="relative border-dashed border-2 border-gray-400 py-6 flex flex-col justify-center items-center hover:bg-gray-100 transition">
                  <p class="mb-1 text-sm text-gray-600 flex flex-wrap justify-center">
                     <span>Drag and drop your </span>&nbsp;<span>images anywhere or</span>
                  </p>
                  <input type="file" multiple="true" @change="onFileChange" class="opacity-0 absolute w-full h-full">
                  <button class="mt-2 text-sm rounded-sm px-3 py-1 bg-gray-200 hover:bg-gray-300 focus:shadow-outline focus:outline-none">
                  Upload a image
                  </button>
               </div>
               <ul v-if="images.length > 0" class="flex flex-1 flex-wrap mt-4">
                  <!-- <li  class="h-full w-full text-center flex flex-col items-center justify-center">
                     <img class="mx-auto w-32" src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png" alt="no data">
                     <span class="text-small text-gray-500">No images selected</span>
                  </li> -->
                  <li class="service-img relative" v-for="(image, key) in images" :key="key">
                    <span @click="removeImg(key)" class="w-6 h-6 absolute bg-gray-100 rounded shadow-md flex items-center justify-center cursor-pointer z-10 top-0 right-0 m-3">
                      <i class="text-xs fad fa-trash text-pink-500"></i>
                    </span>
                     <img :ref="'image'" />
                  </li>
               </ul>
            </div>
         </div>
      </div>
      <hr class="border-gray-200">
      <div class="py-6 px-10">
         It will be like Fiverr gig gallery system
      </div>
   </div>
</template>

<script>
import axios from 'axios'

export default {
  data: ()=>({
    images:[]
  }),

  methods: {


      uploadVideo(e) {
            const file = e.target.files[0]; 

            // check is it valid video or not
            // if(file.type.slice(0, 5) !== 'video') {
            //    toast.fire({type: 'error',title: 'Please upload a valid video file'});
            //    return;
            // }

            // // Check the video size is it smaller then 50mb or not
            // var size = parseInt(file.size / (1024 * 1024)).toFixed(56);
            // if(size > 56) {
            //    toast.fire({type: 'error',title: 'File size is too large. Please upload a video less then 50mb 😔'});
            //    return;
            // }

            // axios.post(window.location.origin+'/api/service', formData)
            // .then(function (response) {
            //    console.log(response);
            // })

            // this.$store.dispatch('service/serviceVideo', formData);
            //console.log(this.$store.state.service.form.video);
      },

      onFileChange(e) {
         let vm = this;
         var selectedFiles = e.target.files;
         if(selectedFiles.length <= 4) {
               for (let i = 0; i < selectedFiles.length; i++) {
                  if(this.images.length > 3) {
                     toast.fire({type: 'error',title: 'You can\'t upload more then 4 images.'});
                     return;
                  } 

                  if(selectedFiles[i]['type'] !== 'image/jpeg' && selectedFiles[i]['type'] !== 'image/png') {
                     toast.fire({type: 'error',title: 'Please upload a valid image file. (jpg, jpeg, png)'});
                     return;
                  } 
                  if(selectedFiles[i]['size'] > 2111775) {
                     toast.fire({type: 'error',title: 'File size is too large. Please upload a image less then 2mb 😔'});
                     return;
                  } 
                  this.images.push(selectedFiles[i]);
               }

               for (let i = 0; i < this.images.length; i++) {   
                  let reader = new FileReader();
                  reader.onload = (e) => {
                  this.$refs.image[i].src = reader.result;
                  };
                  reader.readAsDataURL(this.images[i]);
               }
         } else {
            toast.fire({type: 'error',title: 'You can\'t upload more then 4 images.'});
         }
      },


    removeImg(key) {
      this.images.splice(key,1);
    }
  }

}
</script>