# Travel Tour Management System

Hệ thống quản lý tour du lịch với tích hợp thanh toán tự động PayOS VietQR.

## ✨ Tính năng chính

### Cho khách hàng

-   🔍 Tìm kiếm và xem tour du lịch
-   📝 Đặt tour trực tuyến
-   💳 **Thanh toán tự động qua VietQR** (Mới!)
-   📧 Nhận hóa đơn tự động qua email
-   📊 Xem lịch sử đặt tour
-   ❌ Hủy tour (có chính sách hoàn tiền)

### Cho Admin

-   📈 Quản lý tour (thêm, sửa, xóa)
-   👥 Quản lý khách hàng
-   💰 Xem đơn đã thanh toán tự động
-   📊 Thống kê doanh thu
-   📰 Quản lý tin tức
-   💬 Quản lý góp ý

## 🚀 Công nghệ sử dụng

-   **Backend:** Laravel 10.x
-   **Frontend:** Blade Templates, TailwindCSS
-   **Database:** MySQL
-   **Payment:** PayOS VietQR
-   **Email:** SMTP (Gmail, Mailtrap, etc.)
-   **Queue:** Redis/Database (cho async jobs)

## 📦 Cài đặt

### Yêu cầu hệ thống

-   PHP >= 8.1
-   Composer
-   MySQL >= 5.7
-   Node.js & NPM (cho frontend assets)

### Các bước cài đặt

1. **Clone repository**

```bash
git clone https://github.com/yourusername/travel-tour.git
cd travel-tour
```

2. **Install dependencies**

```bash
composer install
npm install
```

3. **Cấu hình môi trường**

```bash
cp .env.example .env
php artisan key:generate
```

4. **Cấu hình database trong .env**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=travel_tour
DB_USERNAME=root
DB_PASSWORD=
```

5. **Cấu hình PayOS** (xem `.env.payos.example`)

```env
PAYOS_CLIENT_ID=your_client_id
PAYOS_API_KEY=your_api_key
PAYOS_CHECKSUM_KEY=your_checksum_key
PAYOS_WEBHOOK_URL=https://yourdomain.com/payments/webhook/payos
BUSINESS_ADMIN_EMAIL=admin@example.com
```

6. **Run migration**

```bash
php artisan migrate --seed
```

7. **Build assets**

```bash
npm run build
```

8. **Khởi động server**

```bash
php artisan serve
```

Truy cập: http://localhost:8000

## 💳 PayOS Webhook Integration

### Tài liệu chi tiết

-   **[PAYOS_INTEGRATION.md](PAYOS_INTEGRATION.md)** - Tài liệu kỹ thuật đầy đủ
-   **[WEBHOOK_SETUP.md](WEBHOOK_SETUP.md)** - Hướng dẫn cấu hình
-   **[USER_GUIDE.md](USER_GUIDE.md)** - Hướng dẫn cho người dùng
-   **[DEPLOYMENT_CHECKLIST.md](DEPLOYMENT_CHECKLIST.md)** - Checklist deploy production

### Cấu hình nhanh

1. **Đăng ký PayOS**: https://my.payos.vn
2. **Lấy credentials**: Client ID, API Key, Checksum Key
3. **Cấu hình webhook** trên PayOS Portal
4. **Update .env** với credentials
5. **Test webhook**: `.\scripts\test-webhook.ps1`

### Flow thanh toán

```
User đặt tour → Hiển thị QR VietQR → User chuyển khoản
    ↓
PayOS nhận tiền → Gửi webhook → Server xác thực
    ↓
Cập nhật Payment & Booking → Gửi email hóa đơn
    ↓
Notify admin → Frontend hiển thị "Đã thanh toán"
```

## 🧪 Testing

### Run tests

```bash
# Tất cả tests
php artisan test

# Chỉ webhook tests
php artisan test --filter PaymentWebhookTest

# Với coverage
php artisan test --coverage
```

### Test webhook thủ công

```powershell
# PowerShell
.\scripts\test-webhook.ps1 -OrderCode "TEST_001" -Amount 100000

# Bash
./scripts/test-webhook.sh TEST_001 100000
```

## 📁 Cấu trúc project

```
travel-tour/
├── app/
│   ├── Http/Controllers/
│   │   ├── PaymentWebhookController.php  # Xử lý webhook PayOS
│   │   ├── PaymentApiController.php      # API check payment status
│   │   └── ...
│   ├── Models/
│   │   ├── Payment.php                   # Model thanh toán
│   │   ├── DatTour.php                   # Model đặt tour
│   │   └── ...
│   ├── Services/
│   │   └── PayOSService.php              # Service xác thực signature
│   ├── Jobs/
│   │   └── SendInvoiceJob.php            # Job gửi email async
│   └── Notifications/
│       └── BookingPaidAdminNotification.php  # Notify admin
├── database/
│   └── migrations/
│       ├── create_payments_table.php
│       └── add_payment_status_to_dat_tour.php
├── routes/
│   ├── web.php                           # Webhook route (no auth)
│   └── api.php                           # Payment status API
├── tests/
│   └── Feature/
│       └── PaymentWebhookTest.php        # Webhook tests
├── scripts/
│   ├── test-webhook.ps1                  # PowerShell test script
│   └── test-webhook.sh                   # Bash test script
├── PAYOS_INTEGRATION.md                  # Tài liệu chi tiết
├── WEBHOOK_SETUP.md                      # Setup guide
├── USER_GUIDE.md                         # User guide
└── DEPLOYMENT_CHECKLIST.md               # Deploy checklist
```

## 🔐 Bảo mật

-   ✅ HMAC SHA256 signature verification
-   ✅ HTTPS required cho webhook
-   ✅ Idempotent webhook processing
-   ✅ Amount validation
-   ✅ Sensitive data masking trong logs
-   ✅ Database transaction locks
-   ✅ Rate limiting (optional)

## 📊 API Endpoints

### Webhook (No Auth)

```
POST /payments/webhook/payos
```

### Payment Status (Auth required)

```
GET /api/payments/{payment}/status

Response:
{
  "status": "succeeded",
  "paid_at": "2025-10-20T10:30:00Z",
  "amount": "1000000.00",
  "currency": "VND",
  "order_code": "ORDER_123",
  "booking_id": "BOOKING_456"
}
```

## 🛠️ Troubleshooting

### Webhook không nhận được

1. Kiểm tra firewall/security group
2. Verify HTTPS certificate
3. Check PayOS Portal config
4. Review nginx/apache logs

### Email không gửi

1. Check mail config trong .env
2. Verify queue worker running
3. Check failed jobs: `php artisan queue:failed`
4. Retry: `php artisan queue:retry all`

### Payment không update

1. Check signature verification
2. Verify amount matching
3. Review logs: `tail -f storage/logs/laravel.log`

## 📝 Development

### Queue worker (Development)

```bash
php artisan queue:work
```

### Queue worker (Production - Supervisor)

```bash
sudo supervisorctl start laravel-queue-worker:*
```

### Clear caches

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Optimize for production

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
```

## 👥 Tài khoản mặc định

### Admin

-   Email: admin@example.com
-   Password: (xem seeder)

### Khách hàng demo

-   Tự đăng ký qua /register

## 📞 Liên hệ & Support

-   **Email:** admin@example.com
-   **Hotline:** 0123456789
-   **Documentation:** [PAYOS_INTEGRATION.md](PAYOS_INTEGRATION.md)

## 📄 License

[MIT License](LICENSE)

## 🙏 Credits

-   Laravel Framework
-   PayOS VietQR
-   TailwindCSS
-   và các thư viện open source khác

---

**Version:** 1.0.0  
**Last Updated:** October 20, 2025
