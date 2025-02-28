<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6  px-10 lg:p-8 overflow-hidden shadow-xl sm:rounded-lg">
                <h1 class="text-2xl font-black pb-5">Create Admin Account</h1>
                <form class="gap-2" action="{{ Route('vendor.update', ['user' => $user]) }}">
                    @csrf
                    <div class="flex mb-2">
                        <div class="w-1/4">
                            <x-label for="username" value="{{ __('Username') }}" />
                            <x-input id="username" class="block mt-1 w-[95%]" :value="$user->name" type="text"
                                name="username" placeholder="Name..." required autofocus />
                        </div>
                        <div class="w-1/4">
                            <x-label for="password" value="{{ __('Password') }}" />
                            <x-input id="password" class="block mt-1 w-[100%]" type="password" name="password"
                                placeholder="Password..." required autofocus />
                        </div>
                    </div>
                    <div class="w-1/2">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="text" :value="$user->email" name="email"
                            placeholder="Email..." required autofocus />
                    </div>
                    <x-button class="gap-2 mt-4 bg-indigo-700 ">
                        <div class="w-3">
                            <x-fas-plus style="color: #fff" />
                        </div>Update
                    </x-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>