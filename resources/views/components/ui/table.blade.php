@props([
    'headers' => [],
    'loading' => false,
    'empty' => false,
    'error' => null,
    'dense' => false,
    'emptyMessage' => 'Không có dữ liệu phù hợp.',
])

<div {{ $attributes->merge(['class' => 'overflow-hidden rounded-xl border border-base-200 bg-base-100/90 shadow-sm']) }}>
    <div class="overflow-x-auto">
        <table class="table {{ $dense ? 'table-sm' : '' }}">
            @if(!empty($headers))
                <thead class="bg-base-200/80 text-base-content/70">
                    <tr>
                        @foreach($headers as $header)
                            <th class="font-medium uppercase tracking-wide">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
            @endif
            <tbody class="divide-y divide-base-200">
                @if($loading)
                    <tr>
                        <td colspan="{{ max(count($headers), 1) }}" class="p-6">
                            <div class="space-y-3">
                                <x-ui.skeleton height="h-4" />
                                <x-ui.skeleton height="h-4" />
                                <x-ui.skeleton height="h-4" />
                            </div>
                        </td>
                    </tr>
                @elseif($error)
                    <tr>
                        <td colspan="{{ max(count($headers), 1) }}" class="p-6">
                            <x-ui.toast variant="danger" title="Có lỗi xảy ra" dismissible>
                                {{ $error }}
                            </x-ui.toast>
                        </td>
                    </tr>
                @elseif($empty)
                    <tr>
                        <td colspan="{{ max(count($headers), 1) }}" class="p-6">
                            <x-ui.empty :description="$emptyMessage" />
                        </td>
                    </tr>
                @else
                    {{ $slot }}
                @endif
            </tbody>
        </table>
    </div>
</div>
