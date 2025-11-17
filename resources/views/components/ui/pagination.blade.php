@props([
    'paginator',
])

@php($elements = $paginator->elements())

@if($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination">
        <ul class="join">
            {{-- Previous Page Link --}}
            @if($paginator->onFirstPage())
                <li class="join-item btn btn-sm btn-ghost" aria-disabled="true" aria-label="Trang trước">‹</li>
            @else
                <li>
                    <a class="join-item btn btn-sm btn-ghost" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Trang trước">‹</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="join-item btn btn-sm btn-ghost" aria-disabled="true">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page">
                                <span class="join-item btn btn-sm btn-primary">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a class="join-item btn btn-sm btn-ghost" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a class="join-item btn btn-sm btn-ghost" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Trang tiếp">›</a>
                </li>
            @else
                <li class="join-item btn btn-sm btn-ghost" aria-disabled="true" aria-label="Trang tiếp">›</li>
            @endif
        </ul>
    </nav>
@endif
