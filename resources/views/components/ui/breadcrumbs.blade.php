@props([
    'items' => [],
])

<nav class="breadcrumbs text-sm" aria-label="Breadcrumb">
    <ul>
        @foreach($items as $item)
            @php
                $label = $item['label'] ?? '';
                $href = $item['href'] ?? null;
            @endphp
            <li>
                @if($href && !$loop->last)
                    <a href="{{ $href }}" class="text-base-content/80 hover:text-primary">{{ $label }}</a>
                @else
                    <span class="font-medium text-base-content/90">{{ $label }}</span>
                @endif
            </li>
        @endforeach
    </ul>
</nav>
