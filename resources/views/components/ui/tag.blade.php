@props([
    'variant' => 'primary',
    'dismissible' => false,
])

@php
    $variantClasses = [
        'primary' => 'bg-primary/10 text-primary border border-primary/20',
        'secondary' => 'bg-secondary/10 text-secondary border border-secondary/20',
        'accent' => 'bg-accent/10 text-accent border border-accent/20',
        'muted' => 'bg-base-200 text-base-content/80 border border-base-200',
        'danger' => 'bg-error/10 text-error border border-error/20',
        'success' => 'bg-success/10 text-success border border-success/20',
    ];

    $classes = trim('inline-flex items-center gap-2 rounded-full px-3 py-1 text-sm font-medium ' . ($variantClasses[$variant] ?? $variantClasses['primary']));
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
    @if($dismissible)
        <button type="button" class="ml-1 rounded-full p-1 text-current hover:bg-base-300/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" aria-label="Đóng">
            &times;
        </button>
    @endif
</span>
