@php
    use Illuminate\Support\Str;
@endphp

@props([
    'label' => null,
    'labelKey' => null,
    'hint' => null,
    'hintKey' => null,
    'placeholderKey' => null,
    'error' => null,
    'prefixIcon' => null,
    'suffixIcon' => null,
])

@php
    $inputId = $attributes->get('id') ?? 'input-' . Str::random(8);
    $hasPrefix = filled($prefixIcon ?? null);
    $hasSuffix = filled($suffixIcon ?? null);

    $describedBy = collect([
        $hint ? $inputId . '-hint' : null,
        $error ? $inputId . '-error' : null,
    ])->filter()->implode(' ');

    $inputClasses = ['input', 'input-bordered', 'w-full'];

    if ($hasPrefix) {
        $inputClasses[] = 'pl-12';
    }

    if ($hasSuffix) {
        $inputClasses[] = 'pr-12';
    }

    $inputClasses = implode(' ', $inputClasses);
@endphp

<div class="form-control w-full">
    @if($label || $labelKey)
        <label for="{{ $inputId }}" class="label">
            <span
                class="label-text font-medium text-base-content"
                @if($labelKey)
                    x-text="$store.uiTheme.t('{{ $labelKey }}')"
                @endif
            >{{ $label }}</span>
        </label>
    @endif

    <div class="relative">
        @if($hasPrefix)
            <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-base-content/60">
                {!! $prefixIcon !!}
            </span>
        @endif

        <input
            id="{{ $inputId }}"
            {{ $attributes->merge([
                'class' => $inputClasses,
                'aria-describedby' => $describedBy ?: null,
            ]) }}
            @if($placeholderKey)
                x-bind:placeholder="$store.uiTheme.t('{{ $placeholderKey }}')"
            @endif
            @if($error) aria-invalid="true" @endif
        >

        @if($hasSuffix)
            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-base-content/60">
                {!! $suffixIcon !!}
            </span>
        @endif
    </div>

    @if($hint || $hintKey)
        <p
            id="{{ $inputId }}-hint"
            class="mt-2 text-sm text-base-content/70"
            @if($hintKey)
                x-text="$store.uiTheme.t('{{ $hintKey }}')"
            @endif
        >{{ $hint }}</p>
    @endif

    @if($error)
        <p id="{{ $inputId }}-error" class="mt-2 text-sm text-error">{{ $error }}</p>
    @endif
</div>
