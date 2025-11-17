@props([
    'open' => false,
    'size' => 'md',
    'title' => null,
])

@php
    $sizeClasses = [
        'sm' => 'max-w-md',
        'md' => 'max-w-xl',
        'lg' => 'max-w-3xl',
    ];
@endphp

<div x-data="{ open: {{ $open ? 'true' : 'false' }} }" x-on:keydown.escape.window="open = false" {{ $attributes->merge(['class' => 'relative']) }}>
    <div
        x-cloak
        x-show="open"
        x-transition.opacity
        class="fixed inset-0 z-40 bg-base-300/60 backdrop-blur"
    ></div>

    <div
        x-cloak
        x-show="open"
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center px-4 py-6"
        role="dialog"
        aria-modal="true"
    >
        <div class="modal-box w-full {{ $sizeClasses[$size] ?? $sizeClasses['md'] }}">
            @if($title)
                <h2 class="text-lg font-semibold text-base-content">{{ $title }}</h2>
            @endif
            <div class="mt-4">
                {{ $slot }}
            </div>
            <div class="modal-action mt-6">
                {{ $actions ?? '' }}
            </div>
        </div>
    </div>
</div>
