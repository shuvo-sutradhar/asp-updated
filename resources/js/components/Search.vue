<template>

<div>
    <div class="absolute top-0 left-0 inline-flex items-center p-2" :class="[ query !== '' ? 'hidden' : 'block']">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400 " viewBox="0 0 24 24"
            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
            <circle cx="10" cy="10" r="7" />
            <line x1="21" y1="21" x2="15" y2="15" />
        </svg>
    </div>

    <input type="text"
            id="test"
            :value="query" 
            class="w-full pl-10 pr-4 py-2 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600"
            placeholder="Search..."
            @input="$emit('reset-pagination', $event.target.value)">
    
    <label class="absolute l-0 t-0 -mt-8 w-10 h-6 text-center cursor-pointer" 
            :class="[ query !== '' ? 'block' : 'hidden']"
            @click="$emit('reload')">
        <em class="fad fa-times-circle text-pink-500"></em>
    </label>
</div>

</template>

<script>

export default {
    name: 'Search',
  
    props: ["query"],
    model: {
      prop: "query",
      event: "reset-pagination"
    }

}
</script>
