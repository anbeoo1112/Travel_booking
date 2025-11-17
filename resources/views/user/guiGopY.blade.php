<div x-data="{ openFeedback: false }" class="w-full">
    <x-ui.button type="button" variant="secondary" class="justify-center" @click="openFeedback = true">
        Gửi góp ý ngay
    </x-ui.button>

    <div x-cloak x-show="openFeedback" x-transition.opacity class="fixed inset-0 z-40 bg-base-300/60 backdrop-blur"></div>

    <div x-cloak x-show="openFeedback" x-transition class="fixed inset-0 z-50 flex items-center justify-center px-4 py-6" role="dialog" aria-modal="true">
        <div class="w-full max-w-2xl rounded-2xl bg-base-100 p-6 shadow-2xl">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h2 class="text-xl font-semibold text-base-content">Gửi góp ý cho Hanoitourist</h2>
                    <p class="mt-1 text-sm text-base-content/70">Chúng tôi luôn lắng nghe để cải thiện trải nghiệm của bạn.</p>
                </div>
                <button type="button" class="btn btn-sm btn-ghost" aria-label="Đóng" @click="openFeedback = false">&times;</button>
            </div>

            <form id="guiGopYform" action="{{ route('guiGopY') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-5">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2">
                    <x-ui.input name="ho_ten" label="Họ và tên" placeholder="Nguyễn Văn A" required />
                    <x-ui.input name="email" type="email" label="Email" placeholder="you@example.com" required />
                </div>
                <x-ui.input name="so_dien_thoai" label="Số điện thoại" placeholder="0987 654 321" required />
                <x-ui.textarea name="noidung_gopy" label="Nội dung góp ý" placeholder="Chia sẻ góp ý của bạn..." rows="5" required />
                <div class="flex justify-end gap-3">
                    <x-ui.button type="button" variant="ghost" @click.prevent="openFeedback = false">Hủy</x-ui.button>
                    <x-ui.button type="submit" variant="primary">Gửi góp ý</x-ui.button>
                </div>
            </form>
        </div>
    </div>
</div>