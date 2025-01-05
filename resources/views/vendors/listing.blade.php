<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 lg:p-8 overflow-hidden shadow-xl sm:rounded-lg">
                <h1 class="text-2xl font-black"> Create Listing </h1>
                <p class="opacity-60 pt-10 pb-2">Which type of property are you creating?</p>
                <div class="flex gap-2 pt-2">
                    <x-button class="gap-2">
                        <div class="w-6">
                            <x-ri-hotel-fill style="color: #fff" />
                        </div>Multiple Room Rental
                    </x-button>

                    <x-button class="gap-2">
                        <div class="w-6">
                            <x-heroicon-s-home style="color: #fff" />
                        </div>Single Room Rental
                    </x-button>
                </div>
                <hr class="pb-10 mt-10" />
                <h1 class="text-2xl font-black pb-5"> Manage Listing </h1>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full lg: text-sm text-left rtl:text-right text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Property Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Owner
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Vendor
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b ">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    Hotel Garudasakti
                                </th>
                                <td class="px-6 py-4">
                                    login
                                </td>
                                <td class="px-6 py-4">
                                    TLC Business
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-2.5 w-2.5 rounded-full bg-yellow-500 me-2"></div> Pending For Approval
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                                    <a href="#" class="font-medium pl-2 text-red-600 hover:underline">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                

            </div>




        </div>
    </div>
</x-app-layout>
