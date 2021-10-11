<template>
    <div class="breadcrumb flex border-b bg-gray-200 px-6 py-3 md:py-4 justify-between items-center">
        <h1 class="text-md md:text-xl text-gray-600">{{ $t(current) }}</h1>
        <nav aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <router-link :to="{ name: 'home' }" class="text-indigo-600">
                        <em class="fad fa-home"></em>
                    </router-link>
                    <svg v-show="items" class="fill-current w-3 h-3 mx-3 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/>
                    </svg>
                </li>
                <li v-show="items" class="flex items-center" v-for="(data, index) in items" :key="index">
                    <router-link :to="{ name: data.url }" class="text-indigo-600" v-show="data.url">
                        {{ $t(data.name) }}
                    </router-link>
                    <svg v-show="data.url" class="fill-current w-3 h-3 mx-3 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/>
                    </svg>
                    <a v-show="!data.url" href="#" class="text-gray-500" aria-current="page">{{ $t(data.name) }}</a>
                </li>
            </ol>
        </nav>
    </div><!-- BreadCrumn end -->
</template>

<script>

export default {
  name: 'breadcrumbs',
  
  props:['items', 'current'],


}
</script>
