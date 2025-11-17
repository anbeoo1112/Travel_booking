@props([
    'variant' => 'primary',
    'size' => 'md',
    'loading' => false,
    'disabled' => false,
    'iconBefore' => null,
    'iconAfter' => null,
    'href' => null,
    'type' => 'button',
])

@php
    $variantClasses = [
        'primary' => 'btn-primary',
        'secondary' => 'btn-secondary',
        'ghost' => 'btn-ghost',
        'danger' => 'btn-error',
    ];

    $sizeClasses = [
        'sm' => 'btn-sm',
        'md' => 'btn-md',
        'lg' => 'btn-lg',
    ];

    $isDisabled = $disabled || $loading;

    $classes = trim(implode(' ', [
        'btn inline-flex items-center gap-2 font-medium tracking-tight transition',
        $variantClasses[$variant] ?? $variantClasses['primary'],
        $sizeClasses[$size] ?? $sizeClasses['md'],
        $loading ? 'loading cursor-wait' : '',
        'focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:opacity-60 disabled:pointer-events-none',
    ]));
@endphp

@if($href)
    <a
        href="{{ $href }}"
        {{ $attributes->merge(['class' => $classes, 'role' => 'button']) }}
        @if($isDisabled) aria-disabled="true" @endif
    >
        @if($iconBefore)
            <span class="flex items-center" aria-hidden="true">{{ $iconBefore }}</span>
        @endif

        <span class="flex items-center justify-center">{{ $slot }}</span>

        @if($iconAfter)
            <span class="flex items-center" aria-hidden="true">{{ $iconAfter }}</span>
        @endif
    </a>
@else
    <button
        type="{{ $type }}"
        @if($isDisabled) disabled @endif
        {{ $attributes->merge(['class' => $classes]) }}
    >
        @if($iconBefore)
            <span class="flex items-center" aria-hidden="true">{{ $iconBefore }}</span>
        @endif

        <span class="flex items-center justify-center">{{ $slot }}</span>

        @if($iconAfter)
            <span class="flex items-center" aria-hidden="true">{{ $iconAfter }}</span>
        @endif
    </button>
@endif
