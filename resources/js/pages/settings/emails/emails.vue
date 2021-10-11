<template>
	<div>
        <div class="breadcrumb flex  border-b mb-6 bg-gray-200 px-6 py-3 md:py-4 justify-between items-center">
		    <h1 class="text-md md:text-xl text-gray-600">Emails</h1>
            <nav aria-label="Breadcrumb">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                        <router-link :to="{ name: 'home' }" class="text-indigo-600">
                            <i class="fad fa-home"></i>
                        </router-link>
                        <svg class="fill-current w-3 h-3 mx-3 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                    </li>
                    <li class="flex items-center">
                        <router-link :to="{ name: 'settings' }" class="text-indigo-600">
                           Settings
                        </router-link>
                        <svg class="fill-current w-3 h-3 mx-3 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                    </li>
                    <li>
                        <a href="#" class="text-gray-500" aria-current="page">Emails</a>
                    </li>
                </ol>
            </nav>
        </div><!-- BreadCrumn end -->

        <div class="main-content">
            <div class="container mx-auto max-w-3xl mt-8">
                <!-- Incomint email -->
                <div class="mb-12">
                    <div class="flex justify-between items-center relative p-10 py-8 bg-gray-300 rounded-t-lg border-t border-gray-200">
                        <h2 class="text-xl text-gray-600">Incoming emails</h2>
                    </div> <!-- table top search area -->

                    <div class="w-full bg-white mx-auto overflow-hidden shadow">
                        <div class="py-8 px-16">
                            <label for="name" class="text-sm text-gray-600">Sender name<a href="#" class="text-indigo-500"><i class="fal fa-question-circle"></i></a></label>
                            <input class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" type="text" value="" name="name">
                        </div>
                        <hr class="border-gray-200">
                        <div class="py-8 px-16">
                            <label for="email" class="text-sm text-gray-600">Sender email</label>
                            <input class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" type="email" name="email" value="">
                            <span class="text-xs text-gray-500">Displayed in header throughout SPP.</span>
                        </div>
                    </div>
                    <div class="p-16 py-4 bg-gray-300 clearfix rounded-b-lg border-t border-gray-100">
                        <p class="float-left text-xs text-gray-500 tracking-tight mt-2">Click on Save to update your Profile Info</p>
                        <input type="submit" class="bg-indigo-500 text-white text-sm font-medium px-6 py-2 rounded float-right uppercase cursor-pointer" value="Save">
                    </div>                    
                </div>
                <!--/. outgoing-email -->

                <!-- outgoing-email -->
                <div>
                    <div class="flex justify-between items-center relative p-10 py-8 bg-gray-300 rounded-t-lg border-t border-gray-200">
                        <h2 class="text-xl text-gray-600">Outgoing emails</h2>
                    </div> <!-- table top search area -->

                    <div class="w-full bg-white mx-auto overflow-hidden shadow">
                        <div class="py-8 px-16">
                            <label for="name" class="text-sm text-gray-600">Reply email<a href="#" class="text-indigo-500"><i class="fal fa-question-circle"></i></a></label>
                            <input class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500" type="text" value="" name="name">
                        </div>
                    </div>
                    <div class="p-16 py-4 bg-gray-300 clearfix rounded-b-lg border-t border-gray-100">
                        <p class="float-left text-xs text-gray-500 tracking-tight mt-2">Click on Save to update your Profile Info</p>
                        <input type="submit" class="bg-indigo-500 text-white text-sm font-medium px-6 py-2 rounded float-right uppercase cursor-pointer" value="Save">
                    </div>                    
                </div>
                <!--/. outgoing-email -->

                <!-- account email start -->
                <div class="my-10">
                    <h2 class="text-xl text-gray-600 mb-4">Account notifications</h2>
                    <table class="table bg-white w-full shadow rounded">
                        <tbody>
                            <tr>
                                <td class="px-8 py-4 border-b">
                                    <a href="https://digitech.spp.io/settings/email/template/client_welcome.html" class="text-indigo-500">
                                        Welcome email
                                    </a>
                                </td>
                                <td class="text-gray-600 border-b">Sent to new users when their account is created.</td>
                            </tr>
                            <tr>
                                <td class="px-8 py-4">
                                    <a href="https://digitech.spp.io/settings/email/template/client_password_reset.html" class="text-indigo-500">
                                        Password reset
                                    </a>
                                </td>
                                <td class="text-gray-600">Sent to users when they request a password reset.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- account email end -->

            </div>
        </div>
	</div>
</template>

<script>


export default {  
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('Emails') }
  },

  data: () => ({

  }),
}

</script>