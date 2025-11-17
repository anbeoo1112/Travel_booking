# PayOS Webhook Integration - Hệ thống thanh toán tự động

## Tổng quan

Hệ thống webhook tự động hóa quy trình thanh toán PayOS VietQR cho người dùng, loại bỏ việc admin phải duyệt đơn thủ công.

### Flow hoạt động

```
User đặt tour
    ↓
Tạo Payment record (status: pending)
    ↓
Hiển thị QR VietQR cho user
    ↓
User chuyển khoản → PayOS nhận tiền
    ↓
PayOS gửi webhook → Server
    ↓
Xác thực signature (HMAC SHA256)
    ↓
Đối soát số tiền
    ↓
Cập nhật Payment (status: succeeded) + DatTour (payment_status: paid)
    ↓
Gửi email hóa đơn cho khách
    ↓
Gửi email thông báo cho admin
    ↓
Frontend polling → Hiển thị "Đã thanh toán"
```

## Cài đặt

### 1. Migration

```bash
php artisan migrate
```

Tạo:

-   Bảng `payments`: Lưu trữ thông tin thanh toán
-   Cột `payment_status` trong `dat_tour`: Trạng thái thanh toán (unpaid/paid/refunded)

### 2. Cấu hình .env

```env
# PayOS credentials (lấy từ https://my.payos.vn)
PAYOS_CLIENT_ID=your_client_id
PAYOS_API_KEY=your_api_key
PAYOS_CHECKSUM_KEY=your_checksum_key
PAYOS_WEBHOOK_URL=https://yourdomain.com/payments/webhook/payos

# Admin email nhận thông báo
BUSINESS_ADMIN_EMAIL=admin@example.com
```

### 3. Cấu hình PayOS Portal

1. Đăng nhập: https://my.payos.vn
2. Vào **Settings** → **Webhooks**
3. Thêm webhook URL: `https://yourdomain.com/payments/webhook/payos`
4. Chọn events:
    - ✅ Payment Success
    - ✅ Payment Failed
    - ✅ Payment Cancelled

### 4. Development với ngrok

```bash
# Cài đặt ngrok
npm install -g ngrok
# hoặc
choco install ngrok

# Chạy ngrok
ngrok http 8000

# Copy URL (ví dụ: https://abc123.ngrok-free.app)
# Cập nhật vào .env và PayOS Portal
```

## Cấu trúc Code

### Models

#### Payment Model

```php
// app/Models/Payment.php
- id (UUID)
- booking_id (FK to dat_tour)
- gateway (payos/vnpay/momo)
- order_code (unique)
- amount, currency
- status (pending/processing/succeeded/failed/canceled)
- txn_id, meta (JSON)
- signature_valid, paid_at
```

#### DatTour Model (Updated)

```php
// app/Models/DatTour.php
- payment_status (unpaid/paid/refunded)
- Relationships: payments(), latestPayment()
```

### Services

#### PayOSService

```php
// app/Services/PayOSService.php
- verifySignature(array $payload): bool
- createSignature(array $data): string
```

### Controllers

#### PaymentWebhookController

```php
// app/Http/Controllers/PaymentWebhookController.php
POST /payments/webhook/payos

Flow:
1. Xác thực signature
2. Tìm payment theo order_code
3. Đối soát số tiền
4. Lock booking + cập nhật status
5. Dispatch SendInvoiceJob
6. Notify admin
```

#### PaymentApiController

```php
// app/Http/Controllers/PaymentApiController.php
GET /api/payments/{payment}/status

Response:
{
  "status": "succeeded",
  "paid_at": "2025-10-20T10:30:00.000000Z",
  "amount": "1000000.00",
  "currency": "VND",
  "order_code": "ORDER_123",
  "booking_id": "BOOKING_456"
}
```

### Jobs

#### SendInvoiceJob

```php
// app/Jobs/SendInvoiceJob.php
- Queue: default
- Retry: 3 times (60s delay)
- Gửi email BillDatTourMail cho khách hàng
```

### Notifications

#### BookingPaidAdminNotification

```php
// app/Notifications/BookingPaidAdminNotification.php
- Channel: mail
- Gửi thông báo cho admin khi có đơn mới được thanh toán
```

## Routes

```php
// routes/web.php
POST /payments/webhook/payos
    → PaymentWebhookController@payos
    → Không cần auth (PayOS server-to-server)

// routes/api.php
GET /api/payments/{payment}/status
    → PaymentApiController@status
    → Middleware: auth:sanctum
```

## Frontend Integration

### Polling Payment Status

```javascript
// Sau khi user quét QR code
const paymentId = "payment-uuid-from-backend";

const pollInterval = setInterval(async () => {
    try {
        const response = await fetch(`/api/payments/${paymentId}/status`, {
            headers: {
                Authorization: `Bearer ${userToken}`,
                Accept: "application/json",
            },
        });

        const data = await response.json();

        if (data.status === "succeeded") {
            // Hiển thị thông báo thành công
            alert("✅ Thanh toán thành công!");

            // Redirect đến trang hóa đơn
            window.location.href = `/hoa-don/${data.booking_id}`;

            clearInterval(pollInterval);
        } else if (data.status === "failed" || data.status === "canceled") {
            // Hiển thị lỗi
            alert("❌ Thanh toán thất bại!");
            clearInterval(pollInterval);
        }
    } catch (error) {
        console.error("Polling error:", error);
    }
}, 2000); // Poll mỗi 2 giây

// Dừng polling sau 10 phút
setTimeout(() => {
    clearInterval(pollInterval);
}, 600000);
```

### Vue.js Example

```vue
<template>
    <div class="payment-status">
        <div v-if="status === 'pending'">
            <div class="spinner"></div>
            <p>Đang chờ thanh toán...</p>
            <img :src="qrCodeUrl" alt="QR Code" />
        </div>

        <div v-else-if="status === 'succeeded'" class="success">
            <h2>✅ Thanh toán thành công!</h2>
            <button @click="viewInvoice">Xem hóa đơn</button>
        </div>

        <div v-else-if="status === 'failed'" class="error">
            <h2>❌ Thanh toán thất bại</h2>
            <button @click="retry">Thử lại</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            paymentId: null,
            status: "pending",
            pollInterval: null,
            qrCodeUrl: null,
        };
    },

    mounted() {
        this.paymentId = this.$route.params.paymentId;
        this.startPolling();
    },

    beforeUnmount() {
        if (this.pollInterval) {
            clearInterval(this.pollInterval);
        }
    },

    methods: {
        async startPolling() {
            this.pollInterval = setInterval(async () => {
                await this.checkStatus();
            }, 2000);

            // Auto stop sau 10 phút
            setTimeout(() => {
                if (this.pollInterval) {
                    clearInterval(this.pollInterval);
                }
            }, 600000);
        },

        async checkStatus() {
            try {
                const response = await this.$http.get(
                    `/api/payments/${this.paymentId}/status`
                );

                this.status = response.data.status;

                if (this.status === "succeeded") {
                    clearInterval(this.pollInterval);
                    this.pollInterval = null;
                }
            } catch (error) {
                console.error("Status check failed:", error);
            }
        },

        viewInvoice() {
            this.$router.push(`/invoices/${this.paymentId}`);
        },

        retry() {
            window.location.reload();
        },
    },
};
</script>
```

## Testing

### Chạy tests

```bash
# Tất cả tests
php artisan test

# Chỉ webhook tests
php artisan test --filter PaymentWebhookTest

# Với coverage
php artisan test --coverage
```

### Test cases

1. ✅ `test_webhook_rejects_invalid_signature` - Từ chối signature không hợp lệ
2. ✅ `test_webhook_handles_order_not_found` - Xử lý order không tồn tại
3. ✅ `test_webhook_rejects_amount_mismatch` - Từ chối số tiền không khớp
4. ✅ `test_webhook_processes_successful_payment` - Xử lý thanh toán thành công
5. ✅ `test_webhook_is_idempotent` - Không xử lý lại nếu đã succeeded

### Manual testing với curl

```bash
# 1. Tạo booking và payment trong DB
# 2. Lấy order_code
# 3. Tính signature

# Bash script
ORDER_CODE="ORDER_123"
AMOUNT=1000000
CHECKSUM_KEY="your_checksum_key"

# Tạo signature
DATA="amount=${AMOUNT}&description=Test&orderCode=${ORDER_CODE}&transactionId=TXN_123"
SIGNATURE=$(echo -n "$DATA" | openssl dgst -sha256 -hmac "$CHECKSUM_KEY" | cut -d' ' -f2)

# Gửi webhook
curl -X POST http://localhost:8000/payments/webhook/payos \
  -H "Content-Type: application/json" \
  -d "{
    \"code\": \"00\",
    \"desc\": \"Thành công\",
    \"data\": {
      \"orderCode\": \"$ORDER_CODE\",
      \"amount\": $AMOUNT,
      \"description\": \"Test\",
      \"transactionId\": \"TXN_123\",
      \"signature\": \"$SIGNATURE\"
    }
  }"
```

## Logging & Monitoring

### Log locations

```bash
# Laravel logs
tail -f storage/logs/laravel.log | grep "PayOS"

# Queue logs (nếu dùng supervisor)
tail -f /var/log/supervisor/queue-worker.log
```

### Log entries

```
[INFO] PayOS Webhook Received
[INFO] PayOS Webhook: Processing
[INFO] PayOS Webhook: Payment updated to succeeded
[INFO] PayOS Webhook: Booking updated to paid
[INFO] SendInvoiceJob: Invoice email sent successfully
[ERROR] PayOS Webhook: Amount mismatch
[WARNING] PayOS Webhook: Invalid signature
```

### Monitoring checklist

-   [ ] Webhook response time < 3s
-   [ ] Email delivery rate > 95%
-   [ ] Payment success rate
-   [ ] Failed webhook count
-   [ ] Queue job failure rate

## Security

### Bảo mật webhook

1. **Signature verification**: Bắt buộc HMAC SHA256
2. **HTTPS only**: Webhook URL phải dùng HTTPS
3. **IP whitelisting**: Chỉ nhận từ PayOS IPs (optional)
4. **Rate limiting**: Chống spam/DoS
5. **Logging**: Log đầy đủ nhưng mask sensitive data

### Sensitive data masking

```php
// Tự động mask trong log
$sensitiveKeys = ['signature', 'checksum', 'token', 'password', 'secret'];
```

### Idempotency

```php
// Không xử lý lại nếu đã succeeded
if ($payment->status === 'succeeded') {
    return response()->json(['ok' => true, 'message' => 'Already processed']);
}
```

## Production Deployment

### 1. Pre-deployment checklist

-   [ ] Cập nhật `.env` với credentials production
-   [ ] Cấu hình webhook trên PayOS Portal
-   [ ] Kiểm tra SSL certificate
-   [ ] Setup queue worker (supervisor/systemd)
-   [ ] Bật error logging
-   [ ] Backup database

### 2. Queue worker setup (Supervisor)

```ini
[program:laravel-queue-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/log/supervisor/queue-worker.log
stopwaitsecs=3600
```

```bash
# Reload supervisor
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-queue-worker:*
```

### 3. Nginx configuration

```nginx
location /payments/webhook/payos {
    # Tăng timeout cho webhook
    proxy_read_timeout 30s;
    proxy_connect_timeout 10s;

    # Forward tới Laravel
    proxy_pass http://127.0.0.1:8000;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-Proto $scheme;
}
```

### 4. Database indexing

```sql
-- Kiểm tra indexes đã tạo
SHOW INDEX FROM payments;
SHOW INDEX FROM dat_tour;

-- Phải có:
-- payments: order_code (unique), booking_id
-- dat_tour: payment_status
```

### 5. Post-deployment verification

```bash
# Test webhook endpoint
curl -X POST https://yourdomain.com/payments/webhook/payos \
  -H "Content-Type: application/json" \
  -d '{"test": "connection"}'

# Kiểm tra queue worker
php artisan queue:work --once

# Kiểm tra logs
tail -f storage/logs/laravel.log
```

## Troubleshooting

### Issue: Webhook không nhận được

**Solutions:**

1. Kiểm tra firewall/security group
2. Verify HTTPS certificate
3. Check PayOS Portal webhook configuration
4. Review nginx/apache logs

### Issue: Signature invalid

**Solutions:**

1. Kiểm tra `PAYOS_CHECKSUM_KEY` trong `.env`
2. Đảm bảo key khớp với PayOS Portal
3. Log payload để debug:

```php
Log::info('Signature debug', [
    'payload' => $payload,
    'calculated' => $expect,
    'received' => $checksum
]);
```

### Issue: Email không gửi

**Solutions:**

1. Kiểm tra mail config trong `.env`
2. Verify queue worker đang chạy: `supervisorctl status`
3. Check failed jobs: `php artisan queue:failed`
4. Retry failed job: `php artisan queue:retry all`

### Issue: Database lock timeout

**Solutions:**

1. Tăng timeout: `SET innodb_lock_wait_timeout = 120;`
2. Optimize query: Index `booking_id`, `order_code`
3. Review transaction scope

## FAQ

**Q: Webhook có cần authentication không?**
A: Không. Webhook là server-to-server, xác thực bằng HMAC signature.

**Q: Làm sao để test webhook khi dev local?**
A: Dùng ngrok để expose localhost: `ngrok http 8000`

**Q: Payment có thể bị xử lý 2 lần không?**
A: Không. Hệ thống idempotent, kiểm tra `status !== 'succeeded'` trước khi xử lý.

**Q: Email bị delay?**
A: Kiểm tra queue worker. Nếu không dùng queue, email gửi sync có thể chậm.

**Q: Làm sao để retry failed webhook?**
A: PayOS tự động retry. Hoặc dùng `php artisan queue:retry {id}`

## License & Support

Developed for Travel Tour System  
Version: 1.0.0  
Laravel: 10.x  
PHP: 8.1+

For support: admin@example.com
