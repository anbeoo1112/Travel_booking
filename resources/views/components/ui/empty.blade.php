@props([
    'icon' => null,
    'title' => 'Không có dữ liệu',
    'description' => 'Hiện chưa có nội dung nào để hiển thị.',
])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center gap-3 rounded-xl border border-dashed border-base-200 bg-base-100/80 px-6 py-12 text-center']) }}>
    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-base-200 text-primary">
        @if($icon)
            {!! $icon !!}
        @else
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-6m6 6V7M4 21h16" />
            </svg>
        @endif
    </div>
    <div class="space-y-1">
        <h3 class="text-lg font-semibold text-base-content">{{ $title }}</h3>
        <p class="text-sm text-base-content/70">{{ $description }}</p>
    </div>
    {{ $slot }}
</div>
