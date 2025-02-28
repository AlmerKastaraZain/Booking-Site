@props(['label', 'value' => "", 'default', 'for', 'option'])

<label for="{{ $for }}" class="block mb-2 text-sm font-semibold  text-gray-900 ">{{ $option }}</label>
<select id="{{ $for }}" name="{{ $for }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
  @if ($value !== '')
    <option>{{ $default }}</option>
  @else
    <option selected>{{ $default }}</option>
  @endif
  {{$slot}}
</select>