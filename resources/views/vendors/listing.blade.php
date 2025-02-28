<x-guest-layout>
    <x-original.dashboard>
        <h1 class="text-2xl font-black pb-5"> Manage Rental </h1>
        <div class="flex mb-6">
            <a href="{{ Route('create.rental') }}">
                <x-button class="gap-2 bg-indigo-700 ">
                    <div class="w-3">
                        <x-fas-plus style="color: #fff" />
                    </div>Create
                </x-button>
            </a>
        </div>
        @livewire('rental-table') 
    </x-original.dashboard>
</x-guest-layout>