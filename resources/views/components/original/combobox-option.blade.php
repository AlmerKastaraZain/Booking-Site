@props(['value', 'selected' => ''])
<option value="{{ $value }}" @selected($selected === "true") {{ $attributes}}>{{ $slot }}</option>