    <div class="input-group"> 
        <form action="{{ route('quanlytour') }}" method="GET" class="d-flex">
            <input type="text" name="keyword" class="form-control fs-5" placeholder="Nhập từ khóa tìm kiếm" value="{{ request()->input('keyword') }}" id="timKiem">
            <button type="submit" class="btn btn-primary fs-5" id="timKiem">
                <i class='bx bx-search-alt-2'></i>
            </button>
        </form>
    </div>