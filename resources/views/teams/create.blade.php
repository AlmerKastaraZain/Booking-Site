<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Vendor') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Auth::user() && Auth::user()->subscribed())
                <a href="{{ Route('dashboard') }}">
                    <x-button class="bg-indigo-600 hover:bg-indigo-400 mb-4">Return</x-button>
                </a>
            @elseif (Auth::user() && Auth::user()->type == 'admin')
                <a href="{{ Route('admin.dashboard') }}">
                    <x-button class="bg-indigo-600 hover:bg-indigo-400 mb-4">Return</x-button>
                </a>
            @elseif (Auth::user())
                <a href="{{ Route('guest.dashboard') }}">
                    <x-button class="bg-indigo-600 hover:bg-indigo-400 mb-4">Return</x-button>
                </a>
            @endif
            <hr class="mb-4" />

            @livewire('teams.create-team-form')
        </div>
    </div>
</x-guest-layout>