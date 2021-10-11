<template>
    <sidebar-drawer name="multiple-pricing">
        <div slot="header">
            <h2 class="text-xl text-gray-600 font-medium">Pricing options for Test service</h2>
        </div>
        <div slot="body">
            <div class="flex">
                <div class="w-2/3">
                    <div class="flex items-center text-gray-600 text-lg p-2 mb-3">
                        <div class="w-8 h-8 text-sm text-white rounded-full flex justify-center items-center bg-indigo-500 shadow z-10">
                            1
                        </div> 
                        <h2 class="bg-indigo-500 text-white pr-4 pl-6 py-1 pb-2 leading-none -m-4 rounded-r">Create options</h2>
                    </div>
                    <div class="single-pricing bg-gray-100 py-6 px-10 rounded mb-3"
                        v-for="(pricing, index) in multi_pricing"
                        :key="index">
                        <label for="name" class="block uppercase tracking-wide text-gray-600 text-xs font-bold mb-4">Option {{ index + 1 }}: <a href="#" class="text-indigo-500"><i class="fal fa-question-circle"></i></a></label>
                        <div class="flex justify-center items-center">
                            <input id="name" class="mr-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 transition ease-in-out duration-150" 
                                    type="text" 
                                    v-model="pricing.value" 
                                    :placeholder="pricing.placeholder">
                            <button @click="remove(index)" content="Delete" v-tippy='{ placement : "top", arrow : true }' 
                                    class="w-10 h-10 inline-block shadow rounded">
                                    <i class="fad fa-trash"></i>
                            </button>
                        </div>
                        <small class=" tracking-wide text-gray-600 text-xs">This is a drop-down menu where customers can select one of the options below.</small>
                        <div class="single-child mt-6 ml-12">
                            <div v-show="pricing.sub_field" class="flex justify-center items-center mb-3"
                                v-for="(data, key) in pricing.sub_field"
                                :key="key">
                                <input class="mr-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 transition ease-in-out duration-150" 
                                        type="text" 
                                        v-model="data.value" 
                                        :placeholder="data.placeholder">
                                <button @click="removeSubField(index, key)" content="Delete" v-tippy='{ placement : "top", arrow : true }' class="w-10 h-10 inline-block shadow rounded"><i class="fad fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="button" class="text-gray-700" @click="addSubField(index)">+ Add value</button>
                        </div>
                    </div>

                    <div class="text-right" v-if="this.multi_pricing.length < 3">
                        <button type="button" class="btn btn-link text-indigo-500 mt-2 p-0" @click="addMultiPricing">+ Add another option menu</button>
                    </div>
                </div><!-- /. row -->
                <div class="w-1/3">
                    <div class="single-pricing py-6 px-10">
                        <h3>Option 1:</h3>
                        <div class="">
                            
                        </div>
                    </div>
                </div><!-- /. row -->
            </div>
            
            <div class="w-full">
                <div class="flex items-center text-gray-600 text-lg p-2 mb-3">
                    <div class="w-8 h-8 text-sm text-white rounded-full flex justify-center items-center bg-indigo-500 shadow z-10">
                        1
                    </div> 
                    <h2 class="bg-indigo-500 text-white pr-4 pl-6 py-1 pb-2 leading-none -m-4 rounded-r">Set prices for your option combos</h2>
                </div><!-- /. step header -->

                <div class="overflow-x-auto shadow rounded-lg flex">
                    <table class="w-full whitespace-no-wrap bg-white table-striped relative">
                        <thead>
                            <tr class="text-left bg-gray-200">
                                <th class="py-2 px-2 sticky top-0 border-b border-r bg-gray-200 border-gray-300 w-20">
                                    <checkbox class="text-center" />
                                </th>
                                <th class="sticky top-0 bg-gray-200 border-b border-gray-100 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs"
                                    v-for="(pricing, key) in multi_pricing"
                                    :key="key">{{ pricing.value }}</th>
                                <th class="sticky top-0 bg-gray-200 border-b border-gray-100 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-right"> Price</th>
                            </tr>
                        </thead>
                        <tbody>
        
                            <template v-if="multi_pricing.length==1">
                                <tr v-for="(firstVarient, index) in multi_pricing[0].sub_field" :key="index">
                                    <td class="border-dashed border-t border-r border-gray-300 px-2 text-center">
                                        <label class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 p-1 -ml-1 rounded-lg cursor-pointer">
                                            <input type="checkbox" value="1" class="form-checkbox focus:outline-none focus:shadow-outline w-4 h-4" >
                                        </label>
                                    </td>
                                    <td> {{ firstVarient.value }}</td>
                                    <td class="border-dashed border-t border-gray-200 p-3 align-right">
                                        <input id="name" class="border-2 border-gray-200 px-2 py-1 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 transition ease-in-out duration-150" 
                                                type="text" placeholder="$0.00">
                                    </td>                              
                                </tr>
                            </template>

                            <template v-if="multi_pricing.length==2">
                                <template v-for="firstVarient in multi_pricing[0].sub_field">
                                    <tr v-show="multi_pricing.length==2 && multi_pricing[1].sub_field.length" v-for="(secondVarient, secondIndex) in multi_pricing[1].sub_field" :key="secondIndex">
                                        <td class="border-dashed border-t border-r border-gray-300 px-2 text-center">
                                            <label class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 p-1 -ml-1 rounded-lg cursor-pointer">
                                                <input type="checkbox" value="1" class="form-checkbox focus:outline-none focus:shadow-outline w-4 h-4" >
                                            </label>
                                        </td>
                                        <td> {{ firstVarient.value }}</td>
                                        <td> {{ secondVarient.value }}</td>
                                        <td class="border-dashed border-t border-gray-200 p-3 align-right">
                                            <input id="name" class="border-2 border-gray-200 px-2 py-1 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 transition ease-in-out duration-150" 
                                                    type="text" placeholder="$0.00">
                                        </td>                              
                                    </tr>
                                </template>
                            </template>

                            <template v-if="multi_pricing.length==3">
                                <template v-for="firstVarient in multi_pricing[0].sub_field">
                                    <template v-for="secondVarient in multi_pricing[1].sub_field">
                                        <tr v-for="(thirdVarient, index) in multi_pricing[2].sub_field" :key="index">
                                            <td class="border-dashed border-t border-r border-gray-300 px-2 text-center">
                                                <label class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 p-1 -ml-1 rounded-lg cursor-pointer">
                                                    <input type="checkbox" value="1" class="form-checkbox focus:outline-none focus:shadow-outline w-4 h-4" >
                                                </label>
                                            </td>
                                            <td> {{ firstVarient.value }}</td>
                                            <td> {{ secondVarient.value }}</td>
                                            <td>{{ thirdVarient.value }}</td>
                                            <td class="border-dashed border-t border-gray-200 p-3 align-right">
                                                <input id="name" class="border-2 border-gray-200 px-2 py-1 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 transition ease-in-out duration-150" 
                                                        type="text" placeholder="$0.00">
                                            </td>                              
                                        </tr>
                                    </template>
                                </template>
                            </template>



                            <!-- <template v-for="pricing in multi_pricing">
                                <tr v-for="(data, index) in pricing.sub_field" :key="index">
                                    <td class="border-dashed border-t border-r border-gray-300 px-2 text-center">
                                        <label class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 p-1 -ml-1 rounded-lg cursor-pointer">
                                            <input type="checkbox" value="1" class="form-checkbox focus:outline-none focus:shadow-outline w-4 h-4" >
                                        </label>
                                    </td>
                                    <td class="border-dashed border-t border-gray-200 px-6 text-gray-600"
                                        v-for="(pricing, key) in multi_pricing" :key="key">
                                        <span v-for="i in pricing.sub_field.length" :key="i">
                                            {{ pricing.sub_field[i-1].value }}
                                        </span>
                                        {{ subFieldLen(multi_pricing) }}
                                    </td>
                                    <td class="border-dashed border-t border-gray-200 p-3 align-right">
                                        <input id="name" class="border-2 border-gray-200 px-2 py-1 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 transition ease-in-out duration-150" 
                                                type="text" placeholder="$0.00">
                                    </td>
                                </tr>
                            </template> -->
                        </tbody>
                    </table>
                </div>
            </div><!-- /. row -->
        </div>
    </sidebar-drawer>
</template>

<script>
export default {
    data: () => ({ 
        multi_pricing:[
           {
                id:1,
                placeholder: "Turnaround Time",
                value: null,
                sub_field: [
                    { id:1, placeholder: 'Regular', value: null},
                    { id:2, placeholder: 'Fast', value: null},
                    { id:3, placeholder: 'Extra Fast', value: null},
                ]
            }
        ],
        variantPrice:[]
    }),

    methods:{
        /*
        * Multi pricing add
        */
        addMultiPricing(){
            this.multi_pricing.push({
                id: this.multi_pricing[this.multi_pricing.length-1].id+1,
                placeholder: "Turnaround Time",
                value: null,
                sub_field: [
                    { id:1, placeholder: 'Regular', value: null}
                ]
            });
        },

        /*
        * Multi pricing remove
        */
        remove(index) {
            this.multi_pricing.splice(index, 1);
        },

        /*
        * Add sub field
        */
        addSubField(index) {
            let placeholder = '';
            if(this.multi_pricing[index].sub_field.length==1){
                placeholder = 'Fast';
            } else {
                placeholder = 'Extra fast';
            }

            this.multi_pricing[index].sub_field.push({
                id:1, 
                placeholder: placeholder, 
                value: null
            });
        },

        /*
        * Remove sub field
        */
        removeSubField(index, key) {
            this.multi_pricing[index].sub_field.splice(key, 1);
        },

        /*
        * Remove sub field
        */
        subFieldLen(data) {

            // // if multi_pricing options 1
            // if(data.length==1 && data[0].sub_field.length) {
            //     for (let j = 0; j < data[0].sub_field.length; j++) {
            //         //console.log(data[0].sub_field);
            //         this.variantPrice.push({ 
            //             parentId: data[0].id, 
            //             value:    data[0].sub_field[j].value, 
            //             price:    null
            //         });
            //     }
            // }

            // // if multi_pricing options 2
            // if(data.length==2) {
            //     for (let i = 0; i < data[0].sub_field.length; i++) {
            //         for (let j = 0; j < data[1].sub_field.length; j++) {
            //             console.log(data[0].sub_field[i].value);
            //             console.log(data[1].sub_field[j].value);
            //         }
            //     }
            // }

        }
        
    },

}
</script>