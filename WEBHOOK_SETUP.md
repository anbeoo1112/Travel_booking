# PayOS Webhook - Hướng dẫn cấu hình

## 1. Cấu hình môi trường (.env)

Thêm các biến sau vào file `.env`:

```env
# PayOS Configuration
PAYOS_CLIENT_ID=your_client_id_here
PAYOS_API_KEY=your_api_key_here
PAYOS_CHECKSUM_KEY=your_checksum_key_here
PAYOS_WEBHOOK_URL=https://yourdomain.com/payments/webhook/payos

# Business Configuration
BUSINESS_ADMIN_EMAIL=admin@example.com
```

## 2. Chạy migration

```bash
php artisan migrate
```

Migration sẽ tạo:

-   Bảng `payments` với các cột: id, booking_id, gateway, order_code, amount, status, etc.
-   Cột `payment_status` trong bảng `dat_tour`

## 3. Cấu hình webhook trên PayOS Portal

1. Đăng nhập vào PayOS Dashboard
2. Vào phần Settings > Webhooks
3. Thêm webhook URL: `https://yourdomain.com/payments/webhook/payos`
4. Chọn events: Payment Success, Payment Failed, Payment Cancelled

## 4. Development với ngrok

Khi phát triển local, sử dụng ngrok để expose webhook:

```bash
ngrok http 8000
```

Copy URL ngrok (ví dụ: `https://abc123.ngrok.io`) và cập nhật:

-   `.env`: `PAYOS_WEBHOOK_URL=https://abc123.ngrok.io/payments/webhook/payos`
-   PayOS Portal: Webhook URL

## 5. Kiểm tra routes

```bash
php artisan route:list --name=payment
```

Phải thấy:

-   POST /payments/webhook/payos (payments.webhook.payos)
-   GET /api/payments/{payment}/status (api.payments.status)

## 6. Test webhook

### Thủ công với curl:

```bash
curl -X POST http://localhost:8000/payments/webhook/payos \
  -H "Content-Type: application/json" \
  -d '{
    "code": "00",
    "desc": "Thành công",
    "data": {
      "orderCode": "ORDER_123",
      "amount": 1000000,
      "description": "Thanh toán tour",
      "accountNumber": "0123456789",
      "transactionId": "TXN_456",
      "signature": "calculated_signature_here"
    }
  }'
```

## 7. Xem logs

```bash
tail -f storage/logs/laravel.log
```

Tìm:

-   `PayOS Webhook Received`
-   `PayOS Webhook: Processing`
-   `PayOS Webhook: Payment updated to succeeded`

## 8. Flow hoàn chỉnh

1. User đặt tour → Tạo record `dat_tour` với `payment_status='unpaid'`
2. User chuyển khoản qua VietQR
3. PayOS nhận thanh toán → Gửi webhook tới server
4. Server xác thực signature → Cập nhật `payments.status='succeeded'`
5. Cập nhật `dat_tour.payment_status='paid'`
6. Gửi email hóa đơn cho khách hàng (async job)
7. Gửi email thông báo cho admin
8. Frontend polling API `/api/payments/{id}/status` → Hiển thị "Đã thanh toán"

## 9. Xử lý lỗi

### Signature không hợp lệ

-   Kiểm tra `PAYOS_CHECKSUM_KEY` trong `.env`
-   Đảm bảo key khớp với PayOS Portal

### Amount mismatch

-   Đối chiếu số tiền trong webhook với DB
-   Log chi tiết: `PayOS Webhook: Amount mismatch`

### Email không gửi được

-   Kiểm tra cấu hình mail trong `.env`
-   Xem queue: `php artisan queue:work`

## 10. Production checklist

-   [ ] Cập nhật PAYOS_WEBHOOK_URL với domain production
-   [ ] Cấu hình webhook trên PayOS Portal
-   [ ] Kiểm tra SSL certificate (webhook cần HTTPS)
-   [ ] Setup queue worker: `supervisor` hoặc `systemd`
-   [ ] Bật error logging
-   [ ] Test với số tiền nhỏ trước
-   [ ] Backup database trước khi deploy

## 11. Security

-   Webhook không cần authentication (PayOS gửi từ server)
-   Bắt buộc xác thực signature HMAC SHA256
-   Log đầy đủ nhưng mask dữ liệu nhạy cảm
-   Trả 200 cho mọi trường hợp để tránh retry vô hạn
-   Idempotent: Không xử lý lại nếu đã succeeded
