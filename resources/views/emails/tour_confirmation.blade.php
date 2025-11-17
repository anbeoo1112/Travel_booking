<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Xác nhận đặt tour thành công</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            line-height: 1.6; 
            color: #333;
            background-color: #f5f5f5;
        }
        .container { 
            max-width: 600px; 
            margin: 0 auto; 
            padding: 20px;
            background: white;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .success-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
        .tour-details { 
            background: #f8f9fa; 
            padding: 20px; 
            border-radius: 8px; 
            margin: 20px 0;
            border-left: 4px solid #28a745;
        }
        .detail-row {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: bold;
            min-width: 150px;
            color: #555;
        }
        .detail-value {
            color: #333;
        }
        .amount-highlight { 
            background: #fff3cd;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
            border: 2px solid #ffc107;
        }
        .amount-highlight .amount { 
            color: #28a745; 
            font-weight: bold; 
            font-size: 24px;
        }
        .info-box {
            background: #e7f3ff;
            border-left: 4px solid #2196F3;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 14px;
            border-top: 2px solid #eee;
            margin-top: 30px;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
        
        @media only screen and (max-width: 480px) {
            .container { padding: 10px; }
            .header { padding: 20px 10px; }
            .header h1 { font-size: 20px; }
            .detail-row { flex-direction: column; }
            .detail-label { margin-bottom: 5px; }
            .amount-highlight .amount { font-size: 20px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="success-icon">✅</div>
            <h1>Đặt tour thành công!</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Cảm ơn quý khách đã tin tưởng Hanoi Tourist</p>
        </div>
        
        <div style="padding: 20px;">
            <h2 style="color: #667eea; margin-top: 0;">Kính gửi Quý khách {{ $datTour->ho_ten }},</h2>
            
            <p>Chúng tôi xác nhận đã nhận được thanh toán và đặt chỗ thành công cho chuyến du lịch của Quý khách!</p>
            
            <div class="tour-details">
                <h3 style="margin-top: 0; color: #333;">📋 THÔNG TIN CHUYẾN ĐI</h3>
                
                <div class="detail-row">
                    <div class="detail-label">🎫 Mã đặt tour:</div>
                    <div class="detail-value"><strong>{{ $datTour->id }}</strong></div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">🏖️ Tên tour:</div>
                    <div class="detail-value"><strong>{{ $datTour->tour->ten_tour }}</strong></div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">📅 Ngày khởi hành:</div>
                    <div class="detail-value">{{ \Carbon\Carbon::parse($datTour->ngay_di)->format('d/m/Y') }}</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">⏱️ Thời gian:</div>
                    <div class="detail-value">{{ $datTour->tour->thoi_gian }}</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">👥 Số người:</div>
                    <div class="detail-value">{{ $datTour->so_nguoi }} người</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">📞 Số điện thoại:</div>
                    <div class="detail-value">{{ $datTour->so_dien_thoai }}</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">✉️ Email:</div>
                    <div class="detail-value">{{ $datTour->email }}</div>
                </div>
            </div>
            
            <div class="amount-highlight">
                <div style="color: #666; margin-bottom: 5px;">Tổng chi phí đã thanh toán</div>
                <div class="amount">{{ number_format($datTour->tour->gia * $datTour->so_nguoi) }} VNĐ</div>
                @if($payment)
                    <div style="font-size: 12px; color: #666; margin-top: 5px;">
                        Thanh toán qua: {{ strtoupper($payment->gateway) }}
                        @if($payment->paid_at)
                            <br>Thời gian: {{ $payment->paid_at->format('d/m/Y H:i') }}
                        @endif
                    </div>
                @endif
            </div>
            
            <div class="info-box">
                <h4 style="margin-top: 0; color: #2196F3;">📝 LƯU Ý QUAN TRỌNG:</h4>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li>Vui lòng có mặt tại điểm tập trung <strong>trước 30 phút</strong> so với giờ khởi hành</li>
                    <li>Mang theo CMND/CCCD và giấy tờ cần thiết</li>
                    <li>Chuẩn bị hành lý phù hợp với thời tiết và lịch trình</li>
                    <li>Điểm tập trung: <strong>{{ $datTour->tour->diem_tap_trung ?? 'Sẽ thông báo qua SMS trước 1 ngày' }}</strong></li>
                </ul>
            </div>
            
            <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin: 20px 0;">
                <h4 style="margin-top: 0; color: #333;">🎒 MỘT SỐ VẬT DỤNG NÊN MANG THEO:</h4>
                <ul style="margin: 5px 0; padding-left: 20px; color: #555;">
                    <li>Quần áo thoải mái, giày dép phù hợp</li>
                    <li>Kem chống nắng, mũ, kính râm</li>
                    <li>Thuốc cá nhân (nếu có)</li>
                    <li>Máy ảnh để lưu giữ kỷ niệm</li>
                </ul>
            </div>
            
            <div style="text-align: center; margin: 30px 0;">
                <p>Hóa đơn chi tiết được đính kèm trong file PDF</p>
                <a href="{{ route('lichSuDatTour') }}" class="button">Xem lịch sử đặt tour</a>
            </div>
            
            <div style="background: #fff3cd; padding: 15px; border-radius: 8px; border: 1px solid #ffc107;">
                <p style="margin: 0;"><strong>📞 Hỗ trợ khách hàng 24/7:</strong></p>
                <p style="margin: 5px 0 0 0;">
                    Hotline: <strong>0337265446</strong> | 
                    Email: <strong>{{ config('mail.from.address') }}</strong>
                </p>
            </div>
        </div>
        
        <div class="footer">
            <p style="margin: 5px 0;"><strong>CÔNG TY LỮ HÀNH HANOITOURIST</strong></p>
            <p style="margin: 5px 0;">Cảm ơn Quý khách đã tin tưởng và lựa chọn dịch vụ của chúng tôi!</p>
            <p style="margin: 5px 0; font-size: 12px; color: #999;">
                Email này được gửi tự động, vui lòng không trả lời trực tiếp.
            </p>
        </div>
    </div>
</body>
</html>
