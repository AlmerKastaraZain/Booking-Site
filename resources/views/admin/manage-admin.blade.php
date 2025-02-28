<x-guest-layout>
    <x-original.dashboard>
        <h1 class="text-2xl font-black pb-5">Create Admin Account</h1>
        <form class="gap-2" action="{{ Route('admin.store') }}" method="POST">
            @csrf
            <div class="flex mb-2">
                <div class="w-1/4">
                    <x-label for="username" value="{{ __('Username') }}" />
                    <x-input id="username" class="block mt-1 w-[95%]" type="text" name="username" placeholder="Name..."
                        required autofocus />
                </div>
                <div class="w-1/4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-[100%]" type="password" name="password"
                        placeholder="Password..." required autofocus />
                </div>
            </div>
            <div class="w-1/2">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="text" name="email" placeholder="Email..." required
                    autofocus />
            </div>
            <x-button class="gap-2 mt-4 bg-indigo-700 ">
                <div class="w-3">
                    <x-fas-plus style="color: #fff" />
                </div>Create Admin Account
            </x-button>
        </form>
        <hr class="my-6" />
        <h1 class="text-2xl font-black pb-5"> Manage Admin</h1>

        @livewire('admin-table')
    </x-original.dashboard>
</x-guest-layout>