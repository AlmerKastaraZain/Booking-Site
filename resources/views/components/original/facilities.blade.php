@props([
    'array'
])



<div>
    <ul class="items-center z-20 w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex">
        {{ $slot }}
    </ul>
</div>