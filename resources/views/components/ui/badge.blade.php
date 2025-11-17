@props([
    'variant' => 'primary',
    'soft' => false,
])

@php
    $variantClasses = [
        'primary' => 'badge-primary',
        'secondary' => 'badge-secondary',
        'accent' => 'badge-accent',
        'ghost' => 'badge-ghost',
        'danger' => 'badge-error',
        'success' => 'badge-success',
        'warning' => 'badge-warning',
        'info' => 'badge-info',
    ];

    $softClasses = [
        'primary' => 'bg-primary/10 text-primary border-primary/20',
        'secondary' => 'bg-secondary/10 text-secondary border-secondary/20',
        'accent' => 'bg-accent/10 text-accent border-accent/20',
        'ghost' => 'bg-base-200 text-base-content border-base-200',
        'danger' => 'bg-error/10 text-error border-error/20',
        'success' => 'bg-success/10 text-success border-success/20',
        'warning' => 'bg-warning/10 text-warning border-warning/30',
        'info' => 'bg-info/10 text-info border-info/20',
    ];

    $classes = $soft
        ? 'badge border ' . ($softClasses[$variant] ?? $softClasses['primary'])
        : 'badge ' . ($variantClasses[$variant] ?? $variantClasses['primary']);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
