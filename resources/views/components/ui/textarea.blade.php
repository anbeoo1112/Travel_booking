@php
    use Illuminate\Support\Str;
@endphp

@props([
    'label' => null,
    'hint' => null,
    'error' => null,
    'rows' => 4,
])

@php
    $textareaId = $attributes->get('id') ?? 'textarea-' . Str::random(8);

    $describedBy = collect([
        $hint ? $textareaId . '-hint' : null,
        $error ? $textareaId . '-error' : null,
    ])->filter()->implode(' ');
@endphp

<div class="form-control w-full">
    @if($label)
        <label for="{{ $textareaId }}" class="label">
            <span class="label-text font-medium text-base-content">{{ $label }}</span>
        </label>
    @endif

    <textarea
        id="{{ $textareaId }}"
        rows="{{ $rows }}"
        {{ $attributes->merge([
            'class' => 'textarea textarea-bordered w-full',
            'aria-describedby' => $describedBy ?: null,
        ]) }}
        @if($error) aria-invalid="true" @endif
    >{{ $slot }}</textarea>

    @if($hint)
        <p id="{{ $textareaId }}-hint" class="mt-2 text-sm text-base-content/70">{{ $hint }}</p>
    @endif

    @if($error)
        <p id="{{ $textareaId }}-error" class="mt-2 text-sm text-error">{{ $error }}</p>
    @endif
</div>
