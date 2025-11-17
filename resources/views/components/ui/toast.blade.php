@props([
    'variant' => 'info',
    'title' => null,
    'dismissible' => false,
])

@php
    $variantClasses = [
        'info' => 'alert-info',
        'success' => 'alert-success',
        'warning' => 'alert-warning',
        'danger' => 'alert-error',
    ];

    $classes = 'alert shadow-md items-start ' . ($variantClasses[$variant] ?? $variantClasses['info']);
@endphp

<div {{ $attributes->merge(['class' => $classes, 'role' => 'status']) }}>
    <div class="flex flex-1 flex-col gap-1">
        @if($title)
            <span class="font-semibold leading-none">{{ $title }}</span>
        @endif
        <div class="text-sm leading-snug text-base-content/80">{{ $slot }}</div>
    </div>

    @if($dismissible)
        <button type="button" class="btn btn-sm btn-ghost" aria-label="Đóng" onclick="this.closest('[role=status]').remove()">×</button>
    @endif
</div>
