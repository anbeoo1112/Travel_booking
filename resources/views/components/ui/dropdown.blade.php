@props([
    'label' => null,
    'align' => 'end',
])

@php
    $alignClass = $align === 'start' ? 'dropdown-left' : ($align === 'center' ? 'dropdown-center' : 'dropdown-end');
@endphp

<div {{ $attributes->merge(['class' => trim('dropdown ' . $alignClass)]) }}>
    <div tabindex="0" role="button" class="btn btn-sm btn-ghost gap-2">
        @isset($trigger)
            {{ $trigger }}
        @else
            {{ $label }}
        @endisset
    </div>
    <ul tabindex="-1" class="menu dropdown-content z-[1] mt-2 w-52 rounded-xl bg-base-100 p-2 shadow-lg">
        {{ $slot }}
    </ul>
</div>
