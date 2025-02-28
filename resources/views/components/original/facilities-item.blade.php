@props(['name', 'value', 'checked' => ''])

<div class="w-full">
    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
        <div class="flex items-center ps-3">
            @if ($checked === '')
                <input name="{{ $name }}" type="checkbox" {{ $attributes }} value="{{ $value }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
            @else
                <input name="{{ $name }}" type="checkbox" {{ $attributes }} value="{{ $value }}" checked class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
            @endif
            <label for="vue-checkbox-list" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 ">{{ $value }}</label>
        </div>
    </li>
</div>