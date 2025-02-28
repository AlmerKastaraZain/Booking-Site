@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="{{ url('logo/Untitled_design-removebg-preview.png') }}" class="logo" alt="Booking Online Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>