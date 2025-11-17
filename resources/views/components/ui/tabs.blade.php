@php
    use Illuminate\Support\Str;
@endphp

@props([
    'tabs' => [],
    'default' => null,
])

@php
    $defaultTab = $default ?? ($tabs[0]['id'] ?? null);
@endphp

<div x-data="{ active: '{{ $defaultTab }}' }">
    <div role="tablist" class="tabs tabs-boxed bg-base-200/60 p-1">
        @foreach($tabs as $tab)
            @php
                $tabId = $tab['id'] ?? Str::slug($tab['label']);
                $label = $tab['label'] ?? $tabId;
                $icon = $tab['icon'] ?? null;
            @endphp
            <button
                type="button"
                role="tab"
                :aria-selected="active === '{{ $tabId }}'"
                @click="active = '{{ $tabId }}'"
                class="tab whitespace-nowrap"
                :class="{ 'tab-active bg-base-100 shadow': active === '{{ $tabId }}' }"
            >
                <span class="inline-flex items-center gap-2">
                    @if($icon)
                        <span aria-hidden="true">{!! $icon !!}</span>
                    @endif
                    <span>{{ $label }}</span>
                </span>
            </button>
        @endforeach
    </div>

    <div class="mt-6" x-cloak>
        {{ $slot }}
    </div>
</div>
