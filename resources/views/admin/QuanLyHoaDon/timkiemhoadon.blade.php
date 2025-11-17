<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<div class="input-group"> 
    <form method="GET" action="{{ route('hoadondattour') }}" class="d-flex">
        <input type="text" name="keyword" class="form-control fs-5" placeholder="Nhập từ khóa tìm kiếm" value="{{ request()->input('keyword') }}" id="timKiem">
        <button type="submit" class="btn btn-primary fs-5" id="timKiem">
            <i class='bx bx-search-alt-2'></i>
        </button>
    </form>
</div>


    