@props([
    'label',
    'value',
    'icon' => null,
    'description' => null,
    'trend' => null,
])

<div {{ $attributes->merge(['class' => 'stat rounded-xl border border-base-200 bg-base-100/90 shadow-sm']) }}>
    @if($icon)
        <div class="stat-figure text-primary">
            {!! $icon !!}
        </div>
    @endif
    <div class="stat-title text-sm font-medium text-base-content/70">{{ $label }}</div>
    <div class="stat-value text-3xl font-semibold text-base-content">{{ $value }}</div>
    @if($description)
        <div class="stat-desc text-sm text-base-content/60">{{ $description }}</div>
    @endif
    @if($trend)
        <div class="mt-2 text-sm font-medium {{ $trend['direction'] === 'up' ? 'text-success' : 'text-error' }}">
            <span aria-hidden="true">
                @if($trend['direction'] === 'up')
                    ↑
                @else
                    ↓
                @endif
            </span>
            <span class="ml-1">{{ $trend['label'] ?? '' }}</span>
        </div>
    @endif
</div>
