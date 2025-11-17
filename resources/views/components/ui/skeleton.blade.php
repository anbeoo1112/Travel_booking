@props([
    'shape' => 'block',
    'height' => 'h-4',
    'width' => 'w-full',
])

@php
    $rounded = $shape === 'circle' ? 'rounded-full' : ($shape === 'pill' ? 'rounded-full' : 'rounded-lg');
@endphp

<div {{ $attributes->merge(['class' => trim("skeleton bg-base-200/80 $rounded $height $width")]) }}></div>
