@props([
    'padding' => 'p-6',
    'shadow' => 'shadow-md',
    'hover' => false,
])

@php
    $classes = trim(implode(' ', [
        'rounded-xl bg-base-100 border border-base-200/60 dark:bg-base-200/70 dark:border-base-200/40',
        $shadow,
        $padding,
        $hover ? 'transition hover:-translate-y-1 hover:shadow-lg' : '',
        'focus-within:ring-2 focus-within:ring-primary/30',
    ]));
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
