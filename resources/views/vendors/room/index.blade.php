<x-guest-layout>
    <x-original.dashboard>
        <h1 class="text-2xl font-black pb-5"> Manage Single Rental </h1>
        <div class="flex mb-6">
            <a href="{{ Route('create.singlerental') }}">
                <x-button class="gap-2 bg-indigo-700 ">
                    <div class="w-3">
                        <x-fas-plus style="color: #fff" />
                    </div>Create
                </x-button>
            </a>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full lg: text-sm text-left rtl:text-right text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Property Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Type
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ownerdsaad
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
                            Single Rental
                        </td>
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
                            <a href="" class="font-medium text-blue-600 hover:underline">Edit</a>
                            <a href="#" class="font-medium text-red-600 hover:underline">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-original.dashboard>
</x-guest-layout>