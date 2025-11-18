@vite(['resources/css/styleHD-admin.css'])
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<style>
    body {
        font-family: 'DejaVu Sans', sans-serif;
    }
</style>

<!-- Nút Xem -->
<button type="button" class="btn btn-primary fs-5" data-bs-toggle="modal" data-bs-target="#hoaDonModal-{{ $hoaDonDatTour->id }}">
    <i class='bx bx-mask'></i>
</button>

<!-- Modal Xem Hoá Đơn -->
<div class="modal fade" id="hoaDonModal-{{ $hoaDonDatTour->id }}" tabindex="-1" aria-labelledby="hoaDonModalLabel-{{ $hoaDonDatTour->id }}" aria-hidden="true">
    <div class="modal-dialog" id="hoaDon">
        <div class="modal-content" id="ModalContent">
            <button id="export-button-{{ $hoaDonDatTour->id }}" class="btn btn-primary export">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAAilJREFUaEPtme1xwjAMhqVNYJOySZmEMgnpJLAJbKLy+qScCiFx8UeSnv2nPdtx3keSZUcwrbzxyvVTA5jbg1EeEJENER2I6IOI8H9KOzLzV8oC/tlJABV/zfVCXScbRAzAiYg+MwNguSwQMQBSQLwtmQxRE+Co++jRHkkQ1QCYmUUEmxfJIBtEVQCozg1RHSA3xCwAOSFmA8gFMStADojZAVIhFgEwBoH0O3aQLgbgFcRiAN69jjQAuR+d71ovx3PNA80DiXHUQqiF0EJD6Ka68BdlFl9qsTFMsX7rGyrJXNy8p/Eie+BxURFBvQjVi42N+S8v/ZxEZQNz0CB6z8w9rIj48d5vxQC0XnQmom8UqkyAf6GIoJ4UoJzACzPv9O4ToO9lGwN5Kt+UBIDVAXBj5q164axiMQZREHR4ANgx80VE8CzmjbbSABAAi0JQKIA5scTMnXoBFsdcwAAWVrdqX/CGNkD9asUA/FtexDvKJxAHL3QKcHJ7JISXzoEXb0MpuxiAhcyQxVy890Ur17dVsb5kaWH1dHGcGwD7AOJgXcsyfQZSIyC0uqoeuGeerYXEwA7EWNi8OoaSIkLI9wEC/RY6Vra3NFs2jU5ljpzjRUIop8CptRrAf7iNWr6e8naJ8XDKjy0cUxcq9RNTDDDS6z4VAKcljvjUXydjBPs5k9bH5EkP6K0R4u3mWAME5wZOcf9tMWiAKIC/mq7m/AZQ09pD71q9B34Aq6KBQEddMAMAAAAASUVORK5CYII="/>
            </button>
            <div class="bill-container" id="bill-container-{{ $hoaDonDatTour->id }}">
                <div class="info">
                    <p><strong>Mã HD:</strong> {{ $hoaDonDatTour->id }} | <strong>Ngày in:</strong> {{ $hoaDonDatTour->updated_at }}</p>
                </div>
                <div class="header">
                    <div class="logo">
                        <img src="{{ asset('frontend/assets/images/logo/logo2.png') }}" alt="Hanoitourist Logo">
                        <p class="logo_title">Cảm ơn quý khách đã đặt tour tại Hanoitourist! Chúng tôi sẽ gửi thông tin đặt tour cho quý khách qua email.</p>
                    </div>
                </div><br>
            
                <div class="section">
                    <h2>THÔNG TIN KHÁCH HÀNG &nbsp &nbsp _________________</h2>
                    <div class="container" id="thongTinKhachHang">
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <li><strong>Mã Khách Hàng:</strong> {{ $hoaDonDatTour->datTour->id_khachhang }}</li>
                                    <li><strong>Số điện thoại:</strong> {{ $hoaDonDatTour->datTour->so_dien_thoai }}</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul style="margin-left: 60px;">
                                    @if($hoaDonDatTour->datTour)
                                        <li><strong>Họ tên:</strong> {{ $hoaDonDatTour->datTour->ho_ten }}</li>
                                        <li><strong>Email:</strong> {{ $hoaDonDatTour->datTour->email }}</li>
                                    @else
                                        <li><strong>Họ tên:</strong> N/A</li>
                                        <li><strong>Email:</strong> N/A</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
            
                    <h2>THÔNG TIN TOUR &nbsp &nbsp ________________________</h2>
                    <div class="container" id="thongTinTour">
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <li><strong>Mã Tour:</strong> {{ $hoaDonDatTour->datTour->id_tour }}</li>
                                    <li><strong>Nơi khởi hành:</strong> {{ $hoaDonDatTour->datTour->tour->noi_khoi_hanh }}</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul style="margin-left: 55px;">
                                    <li><strong>Thời gian tour:</strong> {{ $hoaDonDatTour->datTour->tour->thoigian_tour }}</li>
                                    <li><strong>Ngày khởi hành:</strong> {{ \Carbon\Carbon::parse($hoaDonDatTour->datTour->ngay_di)->format('d/m/Y') }}</li>
                                </ul>
                            </div>
                        </div>
                        <p style="margin-left: 30px; margin-top: -5px;"><strong>Tên Tour:</strong> {{ $hoaDonDatTour->datTour->tour->ten_tour }}</p>
                    </div><br>
                    
                    <h2>THÔNG TIN THANH TOÁN &nbsp &nbsp __________________</h2>
                    <div class="container" id="thongTinTour">
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <li><strong>Nội dung chuyển khoản:</strong> THANHTOAN {{ $hoaDonDatTour->datTour->id }} {{ $hoaDonDatTour->datTour->id_khachhang }}</li>
                                    <li><strong>Giá trị thanh toán:</strong> <span class="unpaid">{{ number_format($hoaDonDatTour->datTour->tour->gia * $hoaDonDatTour->datTour->so_nguoi) }} VND</span></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul style="margin-left: 55px;">
                                    <li><strong>Số lượng người đi:</strong> {{ $hoaDonDatTour->datTour->so_nguoi }}</li>
                                    <li><strong>Trạng thái:</strong> <span class="unpaid">{{ $hoaDonDatTour->trang_thai }}</span></li>
                                </ul>
                            </div>
                        </div>
                        <p style="margin-left: 30px; margin-top: -5px;"><strong>Phương thức thanh toán:</strong> {{ $hoaDonDatTour->phuong_thuc_thanh_toan }}</p>
                        <p class="note">* Lưu ý thời gian thanh toán trong vòng 24h sau khi đặt tour hoàn tất</p>
                    </div>            
                </div>
            
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="qr-code">
                                @php
                                    $bankId = 'MB';
                                    $accountNo = '0663567899999';
                                    $template = 'compact2';
                                    $amount = $hoaDonDatTour->datTour->tour->gia * $hoaDonDatTour->datTour->so_nguoi;
                                    $customerId = $hoaDonDatTour->datTour->id_khachhang;
                                    $description = 'THANHTOAN ' . $hoaDonDatTour->datTour->id . ' ' . $customerId;
                                    $accountName = 'LE VAN CHIEN';
                                    
                                    $vietQrUrl = "https://img.vietqr.io/image/{$bankId}-{$accountNo}-{$template}.png?" . 
                                                http_build_query([
                                                    'amount' => $amount,
                                                    'addInfo' => $description,
                                                    'accountName' => $accountName
                                                ]);
                                @endphp
                                
                                @if(isset($isPdf) && $isPdf && isset($qrBase64) && $qrBase64)
                                    <img src="{{ $qrBase64 }}" alt="VietQR Code" style="max-width: 100%; height: auto;">
                                @elseif(isset($isPdf) && $isPdf)
                                    <div style="border: 2px solid #007bff; padding: 20px; text-align: center; background: #f8f9fa;">
                                        <h4>THÔNG TIN CHUYỂN KHOẢN</h4>
                                        <p><strong>Ngân hàng:</strong> MB Bank</p>
                                        <p><strong>STK:</strong> {{ $accountNo }}</p>
                                        <p><strong>Chủ TK:</strong> {{ $accountName }}</p>
                                        <p><strong>Số tiền:</strong> {{ number_format($amount) }} VND</p>
                                        <p><strong>Nội dung:</strong> {{ $description }}</p>
                                    </div>
                                @else
                                    <img src="{{ $vietQrUrl }}" alt="VietQR Code" style="max-width: 100%; height: auto;">
                                @endif
                                
                                <div class="bank-info" style="text-align: center; margin-top: 10px; font-size: 12px;">
                                    <p><strong>Ngân hàng:</strong> MB Bank</p>
                                    <p><strong>STK:</strong> {{ $accountNo }}</p>
                                    <p><strong>Chủ TK:</strong> {{ $accountName }}</p>
                                    <p><strong>Số tiền:</strong> {{ number_format($amount) }} VND</p>
                                    <p><strong>Nội dung:</strong> {{ $description }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="signature">
                                <p class="date">Hà Nội, <span id="current-date"></span></p>

                                <script>
                                 const now = new Date();
                                    const day = now.getDate().toString().padStart(2, '0');
                                    const month = (now.getMonth() + 1).toString().padStart(2, '0');
                                    const year = now.getFullYear();

                                     document.getElementById('current-date').textContent = `Ngày ${day} tháng ${month} năm ${year}`;
                                </script>

                                <p><strong>Người Phụ Trách</strong></p>
                                @if($hoaDonDatTour->datTour && $hoaDonDatTour->datTour->nguoiDung)
                                    <p class="name">{{ mb_strtoupper(last(explode(' ', $hoaDonDatTour->datTour->nguoiDung->ho_ten)), 'UTF-8') }}</p>
                                    <p class="fullname">{{ $hoaDonDatTour->datTour->nguoiDung->ho_ten }}</p>
                                @else
                                    <p class="name">N/A</p>
                                    <p class="fullname">N/A</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('export-button-{{ $hoaDonDatTour->id }}').addEventListener('click', async function() {
    const button = this;
    const originalText = button.innerHTML;
    const id = "{{ $hoaDonDatTour->id }}";
    const element = document.getElementById('bill-container-' + id);
    
    button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span> Đang xử lý...';
    button.disabled = true;
    
    const bankId = 'MB';
    const accountNo = '0663567899999';
    const template = 'compact2';
    const amount = {{ $hoaDonDatTour->datTour->tour->gia * $hoaDonDatTour->datTour->so_nguoi }};
    const description = 'THANHTOAN {{ $hoaDonDatTour->datTour->id }} {{ $hoaDonDatTour->datTour->id_khachhang }}';
    const accountName = 'LE VAN CHIEN';
    
    const vietQrUrl = `https://img.vietqr.io/image/${bankId}-${accountNo}-${template}.png?` + 
        `amount=${amount}&addInfo=${encodeURIComponent(description)}&accountName=${encodeURIComponent(accountName)}`;
    
    try {
        const response = await fetch(vietQrUrl);
        if (!response.ok) throw new Error('Failed to fetch QR code');
        
        const blob = await response.blob();
        const reader = new FileReader();
        
        reader.onload = function() {
            const base64QR = reader.result;
            const qrImg = element.querySelector('.qr-code img');
            
            if (qrImg) {
                const originalSrc = qrImg.src;
                qrImg.src = base64QR;
                
                qrImg.onload = function() {
                    html2canvas(element, {
                        useCORS: true,
                        allowTaint: true,
                        scale: 2,
                        backgroundColor: '#ffffff',
                        logging: false
                    }).then((canvas) => {
                        qrImg.src = originalSrc;
                        button.innerHTML = originalText;
                        button.disabled = false;
                        
                        const link = document.createElement('a');
                        link.href = canvas.toDataURL('image/png', 0.9);
                        link.download = `hoa_don_${id}.png`;
                        link.click();
                        
                    }).catch(error => {
                        console.error('Canvas error:', error);
                        qrImg.src = originalSrc;
                        resetButton();
                        alert('Có lỗi khi xuất hóa đơn!');
                    });
                };
            }
        };
        
        reader.readAsDataURL(blob);
        
    } catch (error) {
        console.error('QR fetch error:', error);
        resetButton();
        
        html2canvas(element, {
            scale: 2,
            backgroundColor: '#ffffff'
        }).then((canvas) => {
            const link = document.createElement('a');
            link.href = canvas.toDataURL('image/png', 0.9);
            link.download = `hoa_don_${id}_no_qr.png`;
            link.click();
        });
    }
    
    function resetButton() {
        button.innerHTML = originalText;
        button.disabled = false;
    }
});
</script>
