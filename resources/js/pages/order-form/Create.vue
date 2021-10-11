<template>
	<div>
        <!-- breadcrumbs Start -->
        <breadcrumbs :items="breadcrumbs" :current="breadcrumbsCurrent" />
        <!-- breadcrumbs end -->

        <div class="main-content">
            <!----------------------
                Form-top-area
            ------------------------>
            <div class="mb-8 md:pb-0 grid grid-cols-1 sm:grid-cols-3 md:grid-cols-3 gap-12">
                <div class="col-span-2">
                    <div class="card overflow-hidden bg-white">
                        <div class="border-b bg-gray-100">
                            <div class="flex justify-between">
                                <h2 class="p-3 flex-1 text-lg uppercase" >Add form</h2>
                                <a href="#" class="p-3 border-l">
                                    View Form <i class="fal fa-eye"></i>
                                </a>
                            </div>
                        </div> <!-- /. order-form-title -->
                        
                        <div>
                            <div class="px-10 py-5 border-b border-opacity-25">
                                <label for="name" class="block uppercase tracking-wide text-gray-600 text-xs font-bold">Form name <span class="text-pink-400">*</span></label> 
                                <input id="name" v-model="baseForm.name" required="required" type="text" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 ">
                            </div>
                            <div class="px-10 py-5">
                                <label for="details" class="block uppercase tracking-wide text-gray-600 text-xs font-bold">Form information(Optional)</label> 
                                <textarea id="details" v-model="baseForm.details" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 "></textarea>
                            </div>
                        </div><!-- /.dragable-input -->

                    </div>
                </div>
            </div><!-- /. form-top-area -->

            <!------------------------------
                Dragble Form input field
            -------------------------------->
            <div class="pb-12 md:pb-0 grid grid-cols-1 sm:grid-cols-3 md:grid-cols-3 gap-12">
                <div class="col-span-2">
                    <div class="card bg-white">
                        <h2 class="p-4 bg-gray-200 text-center border-b">Drag and drop fields from the right column onto your form here...</h2>
                        
                        <draggable v-model="baseForm.form" 
                                    v-bind="dragOptions" 
                                    class="dragabble-form" 
                                    group="people"
                                    @start="isDragging = true"
                                    @end="isDragging = false">
                            <div v-for="(data, index) in baseForm.form" :key="index">    
                                <!-------------------------------------
                                    Block one (services input style)
                                -------------------------------------->
                                <!-- option group (single service) start -->
                                <div v-if="data.field === 'opt_single_service'" 
                                    @click="editElementProperties(data, index)"
                                    :class="{ 'is-active': index === activeForm }" 
                                    class="px-10 py-8 dragabble-form-single border-b">
                                    <label class="block mb-2 text-indigo-500 tracking-wide text-gray-600 text-xs font-bold">{{ data.label }} <span class="text-pink-400">*</span></label> 
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-4">  
                                        <div class="flex items-start p-2 py-4 border rounded bg-gray-100">
                                            <label for="submitted" class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 p-1 rounded-full cursor-pointer">
                                                <input type="radio" name="initial_status" class="form-checkbox checkbox-sm focus:outline-none focus:shadow-outline">
                                            </label> 
                                            <div>
                                                <span id="submitted" class="ml-1 text-md text-gray-600">Submitted</span> 
                                                <p class="help-block text-sm font-bold text-indigo-600 ml-1">$1</p>
                                            </div>
                                        </div>
                                    </div>
                                    <button @click.stop.prevent="clearField(index)" 
                                            class="w-6 h-6 shadow rounded remove-input">
                                        <i class="fad fa-trash text-pink-500 text-xs"></i>
                                    </button>
                                </div>

                                <!-- Checkbox group (multiple services) start -->
                                <div v-if="data.field === 'ckbox_multi_services'" 
                                     @click="editElementProperties(data, index)"
                                    :class="{ 'is-active': index === activeForm  }"
                                    class="px-10 py-8 dragabble-form-single">
                                    <label class="block mb-2 text-indigo-500 tracking-wide text-xs font-bold">{{ data.label }} </label> 
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-4">  
                                        <div class="flex items-start p-2 py-4 border rounded bg-gray-100">
                                            <label for="checkbox" class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 p-1 rounded-lg cursor-pointer">
                                                <input type="checkbox" name="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline w-4 h-4">
                                            </label> 
                                            <div>
                                                <span id="submitted" class="ml-1 text-md text-gray-600">Submitted</span> 
                                                <p class="help-block text-sm font-bold text-indigo-600 ml-1">$1</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start p-2 py-4 border rounded bg-gray-100">
                                            <label for="checkbox" class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 p-1 rounded-lg cursor-pointer">
                                                <input type="checkbox" name="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline w-4 h-4">
                                            </label> 
                                            <div>
                                                <span id="submitted" class="ml-1 text-md text-gray-600">Submitted</span> 
                                                <p class="help-block text-sm font-bold text-indigo-600 ml-1">$1</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start p-2 py-4 border rounded bg-gray-100">
                                            <label for="checkbox" class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 p-1 rounded-lg cursor-pointer">
                                                <input type="checkbox" name="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline w-4 h-4">
                                            </label> 
                                            <div>
                                                <span id="submitted" class="ml-1 text-md text-gray-600">Submitted</span> 
                                                <p class="help-block text-sm font-bold text-indigo-600 ml-1">$1</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start p-2 py-4 border rounded bg-gray-100">
                                            <label for="checkbox" class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 p-1 rounded-lg cursor-pointer">
                                                <input type="checkbox" name="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline w-4 h-4">
                                            </label> 
                                            <div>
                                                <span id="submitted" class="ml-1 text-md text-gray-600">Submitted</span> 
                                                <p class="help-block text-sm font-bold text-indigo-600 ml-1">$1</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start p-2 py-4 border rounded bg-gray-100">
                                            <label for="checkbox" class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 p-1 rounded-lg cursor-pointer">
                                                <input type="checkbox" name="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline w-4 h-4">
                                            </label> 
                                            <div>
                                                <span id="checkbox" class="ml-1 text-md text-gray-600">Submitted</span> 
                                                <p class="help-block text-sm font-bold text-indigo-600 ml-1">$1</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start p-2 py-4 border rounded bg-gray-100">
                                            <label for="checkbox" class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 p-1 rounded-lg cursor-pointer">
                                                <input type="checkbox" name="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline w-4 h-4">
                                            </label> 
                                            <div>
                                                <span id="submitted" class="ml-1 text-md text-gray-600">Submitted</span> 
                                                <p class="help-block text-sm font-bold text-indigo-600 ml-1">$1</p>
                                            </div>
                                        </div>
                                    </div>
                                    <button @click.stop.prevent="clearField(index)" 
                                            class="w-6 h-6 shadow rounded remove-input">
                                        <i class="fad fa-trash text-pink-500 text-xs"></i>
                                    </button>
                                </div>

                                <!-- Dropdown menu (single service) start -->
                                <div v-if="data.field === 'dropdown_single_service'"
                                     @click="editElementProperties(data)" 
                                      :class="{ 'is-active': data === activeForm  }"
                                      class="px-10 py-8 dragabble-form-single">
                                    <label :for="data.field" class="block mb-2 tracking-wide text-indigo-500 text-xs font-bold">{{ data.label }} </label> 
                                    <select :id="data.field" class="text-gray-600 border-2 border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:border-indigo-500">
                                        <option selected disabled>Choose a service</option> 
                                        <option value="working">Working-$100</option> 
                                        <option value="pending">Pending-$100</option> 
                                        <option value="submitted">Submitted-$100</option> 
                                        <option value="canceled">Canceled-($100)</option>
                                    </select>
                                    <button @click.stop.prevent="clearField(index)" 
                                            class="w-6 h-6 shadow rounded remove-input">
                                        <i class="fad fa-trash text-pink-500 text-xs"></i>
                                    </button>
                                </div>

                                <!-- Dropdown menu (multiple services) start -->
                                <div v-if="data.field === 'dropdown_multiple_services'"
                                     @click="editElementProperties(data)" 
                                     :class="{ 'is-active': data === activeForm  }" 
                                     class="px-10 py-8 dragabble-form-single">
                                    <label :for="data.field" class="block mb-2 tracking-wide text-indigo-500 text-xs font-bold">{{ data.label }}</label> 
                                    <select :id="data.field" multiple class="text-gray-600 border-2 border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:border-indigo-500">
                                        <option selected disabled>Choose a service</option> 
                                        <option value="working">Working-$100</option> 
                                        <option value="pending">Pending-$100</option> 
                                        <option value="submitted">Submitted-$100</option> 
                                        <option value="canceled">Canceled-($100)</option>
                                    </select>
                                    <button @click.stop.prevent="clearField(index)" 
                                            class="w-6 h-6 shadow rounded remove-input">
                                        <i class="fad fa-trash text-pink-500 text-xs"></i>
                                    </button>
                                </div>

                                <!-------------------------------------
                                    Block two (user info field)
                                -------------------------------------->
                                <!-- name field start -->
                                <div v-if="data.field === 'name'" 
                                     @click="editElementProperties(data)"
                                     :class="{ 'is-active': data === activeForm  }" 
                                     class="px-10 py-8 dragabble-form-single">
                                    <label for="fname" class="block tracking-wide text-indigo-500 text-xs font-bold">{{ data.label }} <span class="text-pink-400">*</span></label> 
                                    <div class="grid grid-cols-2 gap-4"> 
                                        <div>
                                            <input id="fname" required="required" type="text" name="name" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 ">
                                            <label for="fname" class="text-gray-600 text-xs ml-1">First name</label>
                                        </div>
                                        <div>
                                            <input id="lname" required="required" type="text" name="name" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 ">
                                            <label for="lname" class="text-gray-600 text-xs ml-1">Last name</label>
                                        </div>
                                    </div>
                                    <button @click.stop.prevent="clearNrestore(data, index)" 
                                            class="w-6 h-6 shadow rounded remove-input">
                                        <i class="fad fa-trash text-pink-500 text-xs"></i>
                                    </button>
                                </div>

                                <!-- email field -->
                                <div v-if="data.field === 'email'" 
                                     @click="editElementProperties(data)"
                                     :class="{ 'is-active': data === activeForm  }"
                                     class="px-10 py-8 dragabble-form-single">
                                    <label :for="data.field" class="block tracking-wide text-indigo-500 text-xs font-bold">{{ data.label }}</label> 
                                    <input :id="data.field" type="email" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 ">  
                                    <button @click.stop.prevent="clearNrestore(data, index)" 
                                            class="w-6 h-6 shadow rounded remove-input">
                                        <i class="fad fa-trash text-pink-500 text-xs"></i>
                                    </button>
                                </div>

                                <!-- password field -->
                                <div v-if="data.field === 'password'"
                                     @click="editElementProperties(data)" 
                                     :class="{ 'is-active': data === activeForm  }"
                                     class="px-10 py-8 dragabble-form-single">
                                    <label :for="data.field" class="block tracking-wide text-indigo-500 text-xs font-bold">{{ data.label }}</label> 
                                    <input :id="data.field" type="password" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 ">  
                                    <button @click.stop.prevent="clearNrestore(data, index)" 
                                            class="w-6 h-6 shadow rounded remove-input">
                                        <i class="fad fa-trash text-pink-500 text-xs"></i>
                                    </button>
                                </div>

                                <!-- billing address field start -->
                                <div v-if="data.field === 'billing-address'" 
                                     @click="editElementProperties(data)"
                                    :class="{ 'is-active': data === activeForm  }" 
                                    class="px-10 py-8 dragabble-form-single">
                                    <label for="address" class="block tracking-wide text-indigo-500 text-xs font-bold">{{ data.label }}</label> 
                                    <div class="grid grid-cols-3 gap-4 mb-2"> 
                                        <div class="col-span-2">
                                            <input id="address" required="required" type="text" name="name" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 ">
                                            <label for="address" class="text-gray-600 text-xs ml-1">Address</label>
                                        </div>
                                        <div class="col-span-1">
                                            <input id="city" required="required" type="text" name="name" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 ">
                                            <label for="city" class="text-gray-600 text-xs ml-1">City</label>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-4"> 
                                        <div class="col-span-1">
                                            <input id="country" required="required" type="text" name="name" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 ">
                                            <label for="country" class="text-gray-600 text-xs ml-1">Country</label>
                                        </div>
                                        <div class="col-span-1">
                                            <input id="state" required="required" type="text" name="name" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 ">
                                            <label for="state" class="text-gray-600 text-xs ml-1">State / Province / Region</label>
                                        </div>
                                        <div class="col-span-1">
                                            <input id="zipcode" required="required" type="text" name="name" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 ">
                                            <label for="zipcode" class="text-gray-600 text-xs ml-1">Postal / ZIP code</label>
                                        </div>
                                    </div>
                                    <button @click.stop.prevent="clearNrestore(data, index)" 
                                            class="w-6 h-6 shadow rounded remove-input">
                                        <i class="fad fa-trash text-pink-500 text-xs"></i>
                                    </button>
                                </div>

                                <!-- phone field -->
                                <div v-if="data.field === 'phone'" 
                                     @click="editElementProperties(data)"
                                     :class="{ 'is-active': data === activeForm  }" 
                                     class="px-10 py-8 dragabble-form-single">
                                    <label :for="data.field" class="block tracking-wide text-indigo-500 text-xs font-bold">{{ data.label }}</label> 
                                    <input :id="data.field" type="tel" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 ">  
                                    <button @click.stop.prevent="clearNrestore(data, index)" 
                                            class="w-6 h-6 shadow rounded remove-input">
                                        <i class="fad fa-trash text-pink-500 text-xs"></i>
                                    </button>
                                </div>

                                <!-------------------------------------
                                    Block three (input fields)
                                -------------------------------------->
                                <!-- single-text field start -->
                                <div v-if="data.field === 'singleText'" 
                                     @click="editElementProperties(data)"
                                     :class="{ 'is-active': data === activeForm  }" 
                                     class="px-10 py-8 dragabble-form-single">
                                    <label for="sltext" class="block tracking-wide text-indigo-500 text-xs font-bold"> {{ data.label }} <span class="text-pink-400">*</span></label> 
                                    <input id="sltext" type="text" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 ">  
                                    <button @click.stop.prevent="clearField(index)" 
                                            class="w-6 h-6 shadow rounded remove-input">
                                        <i class="fad fa-trash text-pink-500 text-xs"></i>
                                    </button>
                                </div>

                                <!-- Multiple line of text start -->
                                <div v-if="data.field === 'multiText'" 
                                     @click="editElementProperties(data)"
                                     :class="{ 'is-active': data === activeForm  }" 
                                     class="px-10 py-8 dragabble-form-single">
                                    <label for="textarea" class="block tracking-wide text-indigo-500 text-xs font-bold"> {{ data.field }} <span class="text-pink-400">*</span></label> 
                                    <textarea id="textarea" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 "></textarea>
                                    <button @click.stop.prevent="clearField(index)" 
                                            class="w-6 h-6 shadow rounded remove-input">
                                        <i class="fad fa-trash text-pink-500 text-xs"></i>
                                    </button>
                                </div>

                                <!-- Checkbox start -->
                                <div v-if="data.field === 'checkbox'" 
                                     @click="editElementProperties(data)"
                                     :class="{ 'is-active': data === activeForm  }" 
                                     class="px-10 py-8 dragabble-form-single">
                                    <div class="flex items-start">
                                        <label for="checkbox" class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 p-1 rounded-lg cursor-pointer">
                                            <input type="checkbox" id="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline w-4 h-4">
                                        </label> 
                                        <label id="checkbox" class="ml-1 text-md text-gray-600">{{ data.label }} <small>(Optional)</small></label>
                                    </div>
                                    <button @click.stop.prevent="clearField(index)" 
                                            class="w-6 h-6 shadow rounded remove-input">
                                        <i class="fad fa-trash text-pink-500 text-xs"></i>
                                    </button>
                                </div>

                                <!-- dropdown start -->
                                <div v-if="data.field === 'dropdown'" 
                                     @click="editElementProperties(data)"
                                     :class="{ 'is-active': data === activeForm  }" 
                                     class="px-10 py-8 dragabble-form-single">
                                    <label for="dropdown" class="block mb-2 tracking-wide text-indigo-500 text-xs font-bold">{{ data.label }}  (optional) </label> 
                                    <select id="dropdown" class="text-gray-600 border-2 border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:border-indigo-500">
                                        <option selected disabled>Choose a option</option> 
                                        <option value="working">Option 1</option> 
                                        <option value="pending">Option 2</option>
                                    </select>
                                    <button @click.stop.prevent="clearField(index)" 
                                            class="w-6 h-6 shadow rounded remove-input">
                                        <i class="fad fa-trash text-pink-500 text-xs"></i>
                                    </button>
                                </div>

                                <!-- dropdown start -->
                                <div v-if="data.field === 'fileUpload'" 
                                     @click="editElementProperties(data)"
                                     :class="{ 'is-active': data === activeForm }" 
                                     class="px-10 py-8 dragabble-form-single">
                                    <label for="fileUpload" class="block mb-2 tracking-wide text-indigo-500 text-xs font-bold">{{ data.label }} (optional) </label> 
                                    <input id="fileUpload" type="file" class="text-gray-600 border-2 border-gray-300 rounded-lg p-1 w-full focus:outline-none focus:border-indigo-500">
                                    <button @click.stop.prevent="clearField(index)" 
                                            class="w-6 h-6 shadow rounded remove-input">
                                        <i class="fad fa-trash text-pink-500 text-xs"></i>
                                    </button>
                                </div>

                                <!-- secret text start -->
                                <div v-if="data.field === 'secretText'" 
                                     @click="editElementProperties(data)"
                                     :class="{ 'is-active': data === activeForm }" 
                                     class="px-10 py-8 dragabble-form-single">
                                    <label for="secret" class="block tracking-wide text-indigo-500 text-xs font-bold">{{ data.label }} <span>(optional)</span></label> 
                                    <input id="secret" type="password" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 ">  
                                    <button @click.stop.prevent="clearField(index)" 
                                            class="w-6 h-6 shadow rounded remove-input">
                                        <i class="fad fa-trash text-pink-500 text-xs"></i>
                                    </button>
                                </div>
                            </div>
                        </draggable> <!-- /.dragable-input -->

                        <div>
                            <div class="p-8 py-4 bg-gray-300 clearfix border-t border-gray-200">
                                <a class="text-sm cursor-pointer rounded-lg shadow inline-flex items-center bg-pink-500 focus:outline-none focus:shadow-outline text-white py-2 px-4"><i class="fad fa-undo-alt"></i> <span class="ml-1">Go back</span></a> 
                                <button class="btn float-right cursor-pointer w-auto bg-indigo-500 text-indigo-100 py-2 px-4 rounded-lg hover:bg-indigo-600 focus:outline-none cursor-pointer btn-primary">
                                    <span class="mr-1">Save</span> 
                                    <i class="fad fa-forward"></i>
                                </button>
                            </div>
                        </div>
                    </div><!-- form-dragable-area -->
                </div>

                <!-----------------------
                    sidebar element
                ------------------------->
                <aside class="col-span-2 md:col-span-1 lg:col-span-1">
                    <div class="grid sticky top-100">
                        <div v-if="elementInput">
                            <!-- service block -->
                            <div class="bg-white mb-8 border rounded shadow sidebar-block">
                                <draggable
                                    :sort="false"
                                    :list="servicefields"
                                    :group="{ name: 'people', pull: 'clone', put: false }">
                                    <button v-for="element in servicefields" :key="element.label" type="button" class="p-3 border-b w-full text-left text-gray-600 text-sm">
                                        <em v-if="element.field=='opt_single_service'" class="fas fa-dot-circle"></em> 
                                        <em v-else-if="element.field=='ckbox_multi_services'" class="fas fa-grip-horizontal"></em> 
                                        <em v-else-if="element.field=='dropdown_single_service'" class="fas fa-sort"></em> 
                                        <em v-else-if="element.field=='dropdown_multiple_services'" class="fas fa-sort"></em> 
                                        <em v-else class="fas fa-dot-circle"></em> 
                                        <span class="ml-2">{{ element.label }}</span>
                                    </button>
                                </draggable>
                            </div>

                            <!-- personal info block -->
                            <div class="bg-white mb-8 border rounded shadow sidebar-block">
                                <draggable
                                    :sort="false"
                                    :list="infofields"
                                    :group="{ name: 'people', put: false }">
                                    <button v-for="element in infofields" :key="element.label" type="button" class="p-3 border-b w-full text-left text-gray-600 text-sm">
                                        <em v-if="element.field=='name'" class="fas fa-user"></em> 
                                        <em v-else-if="element.field=='email'" class="fas fa-envelope"></em> 
                                        <em v-else-if="element.field=='password'" class="fas fa-sign-in"></em> 
                                        <em v-else-if="element.field=='billing-address'" class="fas fa-address-card"></em> 
                                        <em v-else-if="element.field=='phone'" class="fas fa-phone"></em> 
                                        <span class="ml-2">{{ element.label }}</span>
                                    </button>
                                </draggable>
                            </div>

                            <!-- payment block -->
                            <div class="bg-white mb-8 border rounded shadow sidebar-block">
                                <button type="button" class="p-3 border-b w-full text-left text-gray-600 text-sm">
                                    <i class="fas fa-credit-card"></i> 
                                    <span class="ml-2">Payment Method</span>
                                </button>
                            </div>

                            <!--input block -->
                            <div class="bg-white mb-8 border rounded shadow sidebar-block">
                                <draggable
                                    :sort="false"
                                    :list="inputfields"
                                    :group="{ name: 'people', pull: 'clone', put: false }">
                                    <button v-for="element in inputfields" :key="element.label" type="button" class="p-3 border-b w-full text-left text-gray-600 text-sm">
                                        <em v-if="element.field=='singleText'" class="fas fa-i-cursor"></em> 
                                        <em v-else-if="element.field=='multiText'" class="fas fa-align-left"></em> 
                                        <em v-else-if="element.field=='checkbox'" class="fas fa-check-square"></em> 
                                        <em v-else-if="element.field=='dropdown'" class="fas fa-sort"></em> 
                                        <em v-else-if="element.field=='fileUpload'" class="fas fa-upload"></em> 
                                        <em v-else-if="element.field=='secretText'" class="fas fa-key"></em> 
                                        <span class="ml-2">{{ element.label }}</span>
                                    </button>
                                </draggable>
                            </div>
                        </div>
                        <div v-if="!elementInput && baseForm.form[activeForm]" class="border rounded overflow box-shadow">
                            <div class="bg-gray-300 px-4 py-2">
                                Edit
                                <code class="text-pink-500">{{ baseForm.form[activeForm].field }} </code> 
                                <a @click="elementInput=true" class="bg-gray-400 w-6 h-6 float-right text-center rounded float-right cursor-pointer" >×</a>
                            </div>
                            <div class="bg-white">
                                <!-- field label name -->
                                <div class="border-b px-4 py-4">
                                    <label for="field_name" class="text-sm text-gray-700">Field name</label> 
                                    <input id="field_name"
                                           type="text" 
                                           v-model="baseForm.form[activeForm].label"
                                           :placeholder="baseForm.form[activeForm].label"
                                           class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-600 text-xs focus:outline-none focus:border-indigo-500">
                                </div>

                                <!-- field label name -->
                                <div class="border-b px-4 py-4" v-show="baseForm.form[activeForm].hasOwnProperty('defaultSelected')">
                                    <label for="selected_default" class="text-sm text-gray-700">Default</label> 
                                    <input id="selected_default" 
                                            type="text" 
                                            v-model="baseForm.form[activeForm].defaultSelected" 
                                            :placeholder="baseForm.form[activeForm].defaultSelected" 
                                            class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-600 text-xs focus:outline-none focus:border-indigo-500 ">
                                </div>

                                <!-- placeholder text -->
                                <div class="border-b px-4 py-4" v-show="baseForm.form[activeForm].hasOwnProperty('placeholder')">
                                    <label for="selected_default" class="text-sm text-gray-700">Placeholder text</label> 
                                    <input id="selected_default" 
                                            type="text"
                                            v-model="baseForm.form[activeForm].placeholder" 
                                            class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-600 text-xs focus:outline-none focus:border-indigo-500 ">
                                    <p class="help-block">Shown inside the field</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </aside>
            </div> <!-- table top search area -->

        </div>
	</div>
</template>

<script>
import Form from 'vform'
import draggable from 'vuedraggable'
import Button from '../../components/Button.vue'

export default {
  components: { Button, draggable },  
    middleware: ['auth','admin'],

    metaInfo () {
        return { title: this.$t('Services') }
    },

    data: () => ({
        breadcrumbsCurrent: 'Order Form',
        breadcrumbs:[
            {
                name:'Order Form',
                url: ''
            }
        ],

        errors:[],
        elementInput:true,
        activeForm:[],
        services:[],
        baseForm: new Form({
            name: '',
            details: '',
            cuponCode: false,
            serviceData:false,
            form: []
        }),
        servicefields:[
            {
                field: 'opt_single_service',
                order:1,
                label: 'Option group (single service)',
                hasQuantaty:false,
            },
            {
                field: 'ckbox_multi_services',
                order:2,
                label: 'Checkbox group (multiple services)',
                hasQuantaty:false,
            },
            {
                field: 'dropdown_single_service',
                order:3,
                label: 'Dropdown menu (single service)',
                hasQuantaty:false,
            },
            {
                field: 'dropdown_multiple_services',
                order:4,
                label: 'Dropdown menu (multiple services)',
                hasQuantaty:false,
            },
        ],
        infofields:[
            {
                field: 'name',
                order:5,
                label: 'Name',
                hasQuantaty:false,
            },
            {
                field: 'email',
                order:6,
                label: 'Email',
                hasQuantaty:false,
            },
            {
                field: 'password',
                order:7,
                label: 'Password',
                hasQuantaty:false,
            },
            {
                field: 'billing-address',
                order:8,
                label: 'billing-address',
                hasQuantaty:false,
            },
            {
                field: 'phone',
                order:9,
                label: 'phone',
                hasQuantaty:false,
            },
        ],
        inputfields:[
            {
                field: 'singleText',
                order:10,
                label: 'Single line of text',
                hasQuantaty:false,
            },
            {
                field: 'multiText',
                order:11,
                label: 'Multiple lines of text',
                hasQuantaty:false,
            },
            {
                field: 'checkbox',
                order:12,
                label: 'Checkbox',
                hasQuantaty:false,
            },
            {
                field: 'dropdown',
                order:13,
                label: 'Dropdown menu',
                hasQuantaty:false,
            },
            {
                field: 'fileUpload',
                order:14,
                label: 'File upload',
                hasQuantaty:false,
            },
            {
                field: 'secretText',
                order:15,
                label: 'Secret text',
                hasQuantaty:false,
            }
        ]

    }),

    methods: { 

            dataModel() {
                return this.activeForm;
            },

            /*
            * clear field from drag area
            */
            clearField (index) {
                this.elementInput = true;
                this.baseForm.form.splice(index, 1);
            },

            /*
            * clear field and restore in sidebar info block
            */
            clearNrestore (data, index) {
                
                if(data.order==5) {
                    this.infofields.splice(0, 0, data)
                } else if(data.order==6) {
                    this.infofields.splice(1, 0, data)
                } else if (data.order==7) {
                    this.infofields.splice(2, 0, data)
                } else if (data.order==8) {
                    this.infofields.splice(3, 0, data)
                } else if (data.order==9) {
                    this.infofields.splice(4, 0, data)
                }

                this.baseForm.form.splice(index, 1);
                this.elementInput = true;
            },

            /*
            * Service Block
            * clear field and restore in sidebar info block
            */
            checkServiceData() {
                if(this.baseForm.serviceData == true && (this.baseForm.form.find((item) => item.field === 'opt_single_service' || item.field === 'ckboxMultiServices' || item.field === 'dropDownSingleService' || item.field === 'dropDownMultipleServices' ))){
                    return "You can't add multiple service...";
                } else {
                    return false;
                }
            },

            /*
            * Service Block
            * push single service data
            */
            ckBoxSingleService () {
                if(this.checkServiceData() == false){
                    this.baseForm.form.push({
                        field: 'opt_single_service',
                        order:1,
                        label: 'Option group (single service)',
                        hasQuantaty:false,
                        hasServices: [
                            this.services
                        ],
                        selectedService:[0],
                    });
                } else {
                    console.log("Test");
                    // this.$notify({
                    //   group: 'checkErrors',
                    //   //title: 'Important message',
                    //   text: this.checkServiceData(),
                    //   closeOnClick: true,
                    //   type:"warn"
                    // });
                }

            },

            /*
            * edit selected input data
            */
            editElementProperties(data, index){
                this.elementInput = false;
                this.activeForm = index;
                //this.baseForm.form.splice(4, 1, data);
            }

    },

    computed: {
        dragOptions() {
            return {
                animation: 200,
                group: "description",
                disabled: false,
                ghostClass: "ghost"
            };
        }
    }

}

</script>


<style scoped>

    .dragabble-form {
        border: 1px dashed #c7d0d8;
        margin: 15px;
        min-height: 100px;
    }
    .dragabble-form-single{
        position: relative;
        border: 1px solid rgba(0,0,0,.05);
    }
    /* .dragabble-form-single:last-child{
        border: none;
    } */
    
    .dragabble-form-single.is-active,
    .dragabble-form-single:hover{
        background: #F8F9FA;
    }

    .dragabble-form-single.is-active:before,
    .dragabble-form-single:before {
        content: "\f58e";
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        display: block;
        position: absolute;
        left: 20px;
        top: 28px;
        opacity: 0;
        transform: translate(-5px);
        transition: all .1s linear;
        cursor: move;
        color: #667eea;
    }

    .remove-input {
        position: absolute;
        top: 20px;
        right: 5px;
        opacity: 0;
        transition: all .1s linear;
        transform: translate(5px);
    }
    .dragabble-form-single.is-active .remove-input,
    .dragabble-form-single:hover .remove-input,
    .dragabble-form-single.is-active:before,
    .dragabble-form-single:hover:before{
        opacity: 1;
        transform: translate(0);
    }

    .top-100{
        top: 100px;
    }
    .sidebar-block button{
        transition: all .1s linear;
        cursor: move;
    }
    .sidebar-block button:hover{
        background: #edf2f7;
    }
</style>