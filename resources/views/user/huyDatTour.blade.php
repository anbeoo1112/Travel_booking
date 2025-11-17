@php
    $buttonClass = $buttonClass ?? 'btn btn-sm btn-error';
    $disabledClass = $disabledClass ?? 'btn-disabled';
@endphp

<form action="{{ route('huyDatTour', $datTour->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đặt tour này?');" class="inline-flex">
    @csrf
    <button type="submit" class="{{ $buttonClass }}" @if ($datTour->trang_thai_dattour === 'Đã Xác Nhận') disabled @endif>
        Hủy tour
    </button>
</form>