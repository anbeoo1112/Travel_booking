@php
    use Illuminate\Support\Str;
@endphp

@props([
    'label' => null,
    'hint' => null,
    'error' => null,
    'placeholder' => null,
])

@php
    $selectId = $attributes->get('id') ?? 'select-' . Str::random(8);

    $describedBy = collect([
        $hint ? $selectId . '-hint' : null,
        $error ? $selectId . '-error' : null,
    ])->filter()->implode(' ');
@endphp

<div class="form-control w-full">
    @if($label)
        <label for="{{ $selectId }}" class="label">
            <span class="label-text font-medium text-base-content">{{ $label }}</span>
        </label>
    @endif

    <select
        id="{{ $selectId }}"
        {{ $attributes->merge([
            'class' => 'select select-bordered w-full',
            'aria-describedby' => $describedBy ?: null,
        ]) }}
        @if($error) aria-invalid="true" @endif
    >
        @if($placeholder)
            <option value="" disabled @if(blank($attributes->get('value'))) selected @endif>{{ $placeholder }}</option>
        @endif
        {{ $slot }}
    </select>

    @if($hint)
        <p id="{{ $selectId }}-hint" class="mt-2 text-sm text-base-content/70">{{ $hint }}</p>
    @endif

    @if($error)
        <p id="{{ $selectId }}-error" class="mt-2 text-sm text-error">{{ $error }}</p>
    @endif
</div>
