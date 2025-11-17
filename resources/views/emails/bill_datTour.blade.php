<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Hóa đơn đặt tour</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .bank-info { background: #f5f5f5; padding: 15px; border-radius: 5px; margin: 15px 0; }
        .amount { color: #e74c3c; font-weight: bold; font-size: 18px; }
        
        /* Responsive cho mobile */
        @media only screen and (max-width: 480px) {
            .container { padding: 10px; }
            .bank-info { padding: 10px; font-size: 14px; }
            .qr-container img { width: 120px !important; height: 120px !important; }
            h2 { font-size: 18px; }
            h3 { font-size: 16px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Kính gửi Quý khách {{ $hoadon->datTour->ho_ten }},</h2>
        
        <p>Cảm ơn Quý khách đã đặt tour tại <strong>Hanoi Tourist</strong>!</p>
        
        <div class="bank-info">
            <h3>🏦 THÔNG TIN THANH TOÁN</h3>
            <p><strong>Ngân hàng:</strong> MB Bank</p>
            <p><strong>Số tài khoản:</strong> {{ $bankInfo['accountNo'] }}</p>
            <p><strong>Chủ tài khoản:</strong> {{ $bankInfo['accountName'] }}</p>
            <p><strong>Số tiền:</strong> <span class="amount">{{ number_format($bankInfo['amount']) }} VND</span></p>
            <p><strong>Nội dung chuyển khoản:</strong> {{ $bankInfo['description'] }}</p>
        </div>
        
        <div style="text-align: center; margin: 20px 0;">
            <h3>📱 THANH TOÁN QUA QR CODE</h3>
            
            @if($qrUrl)
                <!-- QR Code Image -->
                <div class="qr-container" style="display: inline-block; padding: 10px; background: white; border: 2px solid #007bff; border-radius: 8px; margin: 10px 0;">
                    <img src="{{ $qrUrl }}" 
                         alt="QR Code Thanh Toán" 
                         style="width: 150px; height: 150px; display: block;">
                </div>
                
                <!-- Hướng dẫn -->
                <div style="margin-top: 10px; padding: 8px; background: #e7f3ff; border-radius: 5px;">
                    <p style="margin: 3px 0; font-size: 13px;"><strong>📱 Cách 1:</strong> Quét QR code bằng app ngân hàng</p>
                    <p style="margin: 3px 0; font-size: 13px;"><strong>💳 Cách 2:</strong> Chuyển khoản thủ công theo thông tin trên</p>
                </div>
                
                <!-- Link backup -->
                <p style="font-size: 11px; color: #666; margin-top: 8px;">
                    <em>Nếu QR không hiển thị, vui lòng chuyển khoản theo thông tin ngân hàng bên trên</em>
                </p>
            @else
                <div style="padding: 20px; background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 5px;">
                    <p><strong>⚠️ Lưu ý:</strong> QR Code không thể hiển thị.</p>
                    <p>Vui lòng chuyển khoản theo thông tin ngân hàng bên trên.</p>
                </div>
            @endif
        </div>
        
        <p>⏰ Vui lòng thanh toán trong vòng 24h để giữ chỗ.</p>
        
        <p>📄 Hóa đơn chi tiết được đính kèm trong file PDF.</p>
        
        <p>Mọi thắc mắc xin liên hệ hotline: <strong>0337265446</strong></p>
        
        <p>Trân trọng cảm ơn!</p>
        <p><strong>Hanoi Tourist Team</strong></p>
    </div>
</body>
</html>
