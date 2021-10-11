<template>
    <div class="h-24 w-full relative z-50">
      <div class="container max-w-6xl mx-auto h-full flex justify-center sm:justify-between items-center px-8 xl:px-0">
          <router-link :to="{ name: 'welcome' }" class="inline-block h-full flex items-center h-5 relative font-black">
            <svg class="h-8 w-auto fill-current text-gray-900" viewBox="0 0 281 280" height="280" xmlns="http://www.w3.org/2000/svg">
                <path d="M140 0C89.592-.006 43.073 27.088 18.206 70.935-6.66 114.78-6.037 168.61 19.84 211.87a135.373 135.373 0 006.73 10.2c40.925 56.523 117.212 74.304 178.91 41.7l-11.29-19.51c-42.055 21.797-93.087 16.206-129.426-14.178-36.34-30.384-50.88-79.618-36.875-124.869C41.893 59.963 81.7 27.547 128.85 23c3.67-.34 7.39-.52 11.15-.52 3.76 0 7.47.18 11.14.52 42.314 4.012 79.16 30.57 96.344 69.444 17.185 38.875 12.028 84-13.484 117.996L140 47.9 52.19 200h33.87L140 106.56l72.75 125.69 11.38 19.66c48.149-36.192 67.751-99.125 48.67-156.258C253.72 38.52 200.235-.004 140 0z"/>
            </svg>
            <span class="font-black ml-2 text-gray-900 text-xl">{{ appName }}</span>
          </router-link>
          <nav id="nav" class="absolute w-full sm:w-auto flex-col sm:flex-row h-24 sm:h-auto justify-center bg-white sm:bg-transparent top-0 mt-24 sm:mt-0 border-t sm:border-none border-gray-200 pt-5 sm:py-0 z-50 flex hidden sm:flex items-center sm:relative">
            <a href="/" class="font-bold ml-0 sm:ml-12 mr-0 sm:mr-5 text-sm transition-color duration-100 hover:text-indigo-600">Home</a>
            <a href="#how-it-works" class="font-bold mr-0 sm:mr-5 text-sm transition-color duration-100 hover:text-indigo-600">Features</a>
            <a href="" class="font-bold text-sm transition-color duration-100 hover:text-indigo-600">Pricing</a>
          </nav>
          <div id="navAuth" class="absolute sm:relative w-full sm:w-auto bg-white sm:bg-transparent border-b sm:border-none border-gray-200 mt-48 sm:mt-0 flex-col sm:flex-row pb-8 sm:p-0 justify-center items-center sm:items-end flex hidden sm:flex sm:justify-between ">
            <router-link :to="{ name: 'login' }" class="px-5 py-2 text-sm text-pink-500 lg:text-white font-bold mr-0 sm:mr-3 relative z-40">
              {{ $t('login') }}
            </router-link>
            <router-link :to="{ name: 'register' }" class="px-5 py-3 rounded fold-bold text-sm transition-all duration-300 leading-none bg-indigo-700 lg:bg-white text-white lg:text-indigo-700 w-auto sm:w-full h-full inline-block font-bold relative shadow-md lg:shadow-none hover:shadow-xl duration-100 transition z-40">
              {{ $t('register') }}
            </router-link>
            <svg class="hidden lg:block absolute w-screen max-w-3xl -mt-64 -ml-12 left-0 top-0" viewBox="0 0 818 815" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <defs>
                  <linearGradient x1="0%" y1="0%" x2="100%" y2="100%" id="c">
                      <stop stop-color="#E614F2" offset="0%"/>
                      <stop stop-color="#FC3832" offset="100%"/>
                  </linearGradient>
                  <linearGradient x1="0%" y1="0%" x2="100%" y2="100%" id="f">
                      <stop stop-color="#657DE9" offset="0%"/>
                      <stop stop-color="#1C0FD7" offset="100%"/>
                  </linearGradient>
                  <filter x="-4.7%" y="-3.3%" width="109.3%" height="109.3%" filterUnits="objectBoundingBox" id="a">
                      <feOffset dy="8" in="SourceAlpha" result="shadowOffsetOuter1"/>
                      <feGaussianBlur stdDeviation="8" in="shadowOffsetOuter1" result="shadowBlurOuter1"/>
                      <feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0" in="shadowBlurOuter1"/>
                  </filter>
                  <filter x="-4.7%" y="-3.3%" width="109.3%" height="109.3%" filterUnits="objectBoundingBox" id="d">
                      <feOffset dy="8" in="SourceAlpha" result="shadowOffsetOuter1"/>
                      <feGaussianBlur stdDeviation="8" in="shadowOffsetOuter1" result="shadowBlurOuter1"/>
                      <feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.2 0" in="shadowBlurOuter1"/>
                  </filter>
                  <path d="M160.52 108.243h497.445c17.83 0 24.296 1.856 30.814 5.342 6.519 3.486 11.635 8.602 15.12 15.12 3.487 6.52 5.344 12.985 5.344 30.815v497.445c0 17.83-1.857 24.296-5.343 30.814-3.486 6.519-8.602 11.635-15.12 15.12-6.52 3.487-12.985 5.344-30.815 5.344H160.52c-17.83 0-24.296-1.857-30.814-5.343-6.519-3.486-11.635-8.602-15.12-15.12-3.487-6.52-5.343-12.985-5.343-30.815V159.52c0-17.83 1.856-24.296 5.342-30.814 3.486-6.519 8.602-11.635 15.12-15.12 6.52-3.487 12.985-5.343 30.815-5.343z" id="b"/>
                  <path d="M159.107 107.829H656.55c17.83 0 24.296 1.856 30.815 5.342 6.518 3.487 11.634 8.602 15.12 15.12 3.486 6.52 5.343 12.985 5.343 30.816V656.55c0 17.83-1.857 24.296-5.343 30.815-3.486 6.518-8.602 11.634-15.12 15.12-6.519 3.486-12.985 5.343-30.815 5.343H159.107c-17.83 0-24.297-1.857-30.815-5.343-6.519-3.486-11.634-8.602-15.12-15.12-3.487-6.519-5.343-12.985-5.343-30.815V159.107c0-17.83 1.856-24.297 5.342-30.815 3.487-6.519 8.602-11.634 15.12-15.12 6.52-3.487 12.985-5.343 30.816-5.343z" id="e"/>
                </defs>
                <g fill="none" fill-rule="evenodd" opacity=".9">
                  <g transform="rotate(65 416.452 409.167)">
                      <use fill="#000" filter="url(#a)" xlink:href="#b"/>
                      <use fill="url(#c)" xlink:href="#b"/>
                  </g>
                  <g transform="rotate(29 421.929 414.496)">
                      <use fill="#000" filter="url(#d)" xlink:href="#e"/>
                      <use fill="url(#f)" xlink:href="#e"/>
                  </g>
                </g>
            </svg>
          </div>
          <div id="nav-mobile-btn" class="w-6 absolute block sm:hidden right-0 top-0 mr-10 mt-8 sm:mt-10 z-50 cursor-pointer select-none">
            <span class="w-full h-1 mt-2 sm:mt-1 bg-gray-800 rounded-full block transform duration-200"></span>
            <span class="w-full h-1 mt-1 bg-gray-800 rounded-full block  transform duration-200"></span>
          </div>
      </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import LocaleDropdown from './LocaleDropdown'

export default {
  name: 'welcomenavbar',
  data: () => ({
    appName: window.config.appName
  }),

}
</script>