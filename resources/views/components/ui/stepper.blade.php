@props([
    'steps' => [],
])

@php
    $statusClasses = [
        'complete' => 'step-primary',
        'current' => 'step-primary step-current',
        'upcoming' => 'text-base-content/60',
    ];
@endphp

<ul class="steps w-full">
    @foreach($steps as $step)
        @php
            $label = $step['label'] ?? '';
            $description = $step['description'] ?? null;
            $status = $step['status'] ?? 'upcoming';
        @endphp
        <li class="step {{ $statusClasses[$status] ?? '' }}" @if($status === 'current') aria-current="step" @endif>
            <div class="flex flex-col items-center gap-1 text-center">
                <span class="font-medium">{{ $label }}</span>
                @if($description)
                    <span class="text-xs text-base-content/70">{{ $description }}</span>
                @endif
            </div>
        </li>
    @endforeach
</ul>
