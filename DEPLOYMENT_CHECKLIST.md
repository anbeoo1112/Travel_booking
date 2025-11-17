# PayOS Webhook - Deployment Checklist

## Pre-deployment

### 1. Code Review

-   [ ] Tất cả tests pass: `php artisan test`
-   [ ] Code đã được review
-   [ ] Không có hard-coded credentials
-   [ ] Logging đầy đủ
-   [ ] Error handling hoàn chỉnh

### 2. Database

-   [ ] Backup database hiện tại
-   [ ] Review migration files
-   [ ] Test migration trên staging: `php artisan migrate --pretend`
-   [ ] Kiểm tra indexes: `payments.order_code`, `payments.booking_id`
-   [ ] Kiểm tra foreign keys

### 3. Configuration

-   [ ] File `.env` đã được cập nhật:
    -   `PAYOS_CLIENT_ID`
    -   `PAYOS_API_KEY`
    -   `PAYOS_CHECKSUM_KEY`
    -   `PAYOS_WEBHOOK_URL`
    -   `BUSINESS_ADMIN_EMAIL`
-   [ ] Config cache cleared: `php artisan config:clear`
-   [ ] Verify services config: `php artisan tinker` → `config('services.payos')`

### 4. PayOS Portal

-   [ ] Đăng nhập PayOS Dashboard
-   [ ] Verify API credentials (Client ID, API Key, Checksum Key)
-   [ ] Test mode → Production mode
-   [ ] Webhook URL đã được cấu hình
-   [ ] Webhook events đã được chọn (Payment Success, Failed, Cancelled)

### 5. SSL/HTTPS

-   [ ] SSL certificate hợp lệ
-   [ ] Webhook URL dùng HTTPS
-   [ ] Test với: `curl -I https://yourdomain.com/payments/webhook/payos`
-   [ ] Không có mixed content warnings

## Deployment

### 1. Code Deployment

```bash
# Pull latest code
git pull origin main

# Install dependencies
composer install --no-dev --optimize-autoloader

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 2. Database Migration

```bash
# Backup first
php artisan db:backup  # hoặc mysqldump

# Run migrations
php artisan migrate --force

# Verify
php artisan migrate:status
```

### 3. Queue Worker Setup

#### Option A: Supervisor

```bash
# Create supervisor config
sudo nano /etc/supervisor/conf.d/laravel-queue.conf

# Paste config (xem PAYOS_INTEGRATION.md)

# Reload supervisor
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-queue-worker:*

# Check status
sudo supervisorctl status
```

#### Option B: Systemd

```bash
# Create systemd service
sudo nano /etc/systemd/system/laravel-queue.service

# Enable and start
sudo systemctl enable laravel-queue
sudo systemctl start laravel-queue
sudo systemctl status laravel-queue
```

### 4. Web Server Configuration

#### Nginx

```bash
# Edit site config
sudo nano /etc/nginx/sites-available/yoursite

# Test config
sudo nginx -t

# Reload
sudo systemctl reload nginx
```

#### Apache

```bash
# Edit .htaccess or vhost config

# Restart
sudo systemctl restart apache2
```

### 5. Permissions

```bash
# Storage and cache writable
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Logs
chmod -R 775 storage/logs
```

## Post-deployment Verification

### 1. Health Checks

-   [ ] Website accessible: `https://yourdomain.com`
-   [ ] Webhook endpoint responds: `curl -X POST https://yourdomain.com/payments/webhook/payos`
-   [ ] API endpoint works: `curl https://yourdomain.com/api/payments/test/status`
-   [ ] No errors in logs: `tail -f storage/logs/laravel.log`

### 2. Functional Tests

#### Test 1: Manual webhook test

```bash
# Run test script
cd scripts
./test-webhook.ps1 -OrderCode "TEST_001" -Amount 100000
```

Expected:

-   [ ] HTTP 200 response
-   [ ] No errors in logs
-   [ ] Payment record created/updated

#### Test 2: End-to-end test

1. [ ] Create booking từ frontend
2. [ ] Generate payment record
3. [ ] Hiển thị QR code
4. [ ] Simulate webhook callback
5. [ ] Verify payment status updated
6. [ ] Check email sent
7. [ ] Verify admin notification

#### Test 3: Error scenarios

-   [ ] Invalid signature → 400 response
-   [ ] Amount mismatch → 400 response
-   [ ] Order not found → 200 response
-   [ ] Duplicate webhook → Idempotent

### 3. Monitoring Setup

#### Logs

```bash
# Laravel logs
tail -f storage/logs/laravel.log | grep "PayOS"

# Nginx/Apache logs
tail -f /var/log/nginx/access.log | grep webhook
tail -f /var/log/nginx/error.log

# Queue worker logs
tail -f /var/log/supervisor/queue-worker.log
```

#### Alerts (Optional)

-   [ ] Setup email alerts cho failed jobs
-   [ ] Monitor webhook response time
-   [ ] Alert nếu payment success rate < 90%
-   [ ] Database connection monitoring

### 4. Database Verification

```sql
-- Check tables exist
SHOW TABLES LIKE 'payments';
SHOW TABLES LIKE 'dat_tour';

-- Check columns
DESCRIBE payments;
DESCRIBE dat_tour;

-- Check indexes
SHOW INDEX FROM payments;

-- Check sample data
SELECT * FROM payments ORDER BY created_at DESC LIMIT 5;
SELECT id, payment_status FROM dat_tour WHERE payment_status = 'paid' LIMIT 5;
```

### 5. Performance Tests

-   [ ] Webhook response time < 3s
-   [ ] Database query time < 100ms
-   [ ] Email queue processing < 30s
-   [ ] No memory leaks sau 1000 webhooks

## Production Testing

### Test với số tiền thật (nhỏ)

1. [ ] Tạo booking với số tiền nhỏ (10,000 VNĐ)
2. [ ] Thực hiện thanh toán thật
3. [ ] Verify webhook received
4. [ ] Check payment status updated
5. [ ] Verify email received
6. [ ] Check admin notification
7. [ ] View invoice PDF

### Load Testing (Optional)

```bash
# Apache Bench
ab -n 100 -c 10 https://yourdomain.com/payments/webhook/payos

# Expected:
# - Success rate > 95%
# - Response time < 3s
# - No 500 errors
```

## Rollback Plan

### If deployment fails:

```bash
# 1. Rollback code
git reset --hard <previous-commit>

# 2. Rollback database
php artisan migrate:rollback --step=2

# 3. Restore backup
mysql -u user -p database < backup.sql

# 4. Clear caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# 5. Restart services
sudo systemctl restart nginx
sudo supervisorctl restart laravel-queue-worker:*
```

## Post-deployment Monitoring (First 24h)

### Hour 1

-   [ ] Monitor logs continuously
-   [ ] Check all test payments
-   [ ] Verify queue worker running
-   [ ] No errors in error.log

### Hour 24

-   [ ] Review all payment transactions
-   [ ] Check email delivery rate
-   [ ] Verify no failed jobs
-   [ ] Review error logs
-   [ ] Check database performance

### Day 7

-   [ ] Payment success rate > 95%
-   [ ] No critical errors
-   [ ] Email delivery rate > 98%
-   [ ] Queue processing normal
-   [ ] Customer feedback positive

## Support & Escalation

### Level 1: Common Issues

-   Webhook không nhận → Check nginx logs, firewall
-   Email không gửi → Check queue worker
-   Payment không update → Check signature, amount

### Level 2: Technical Issues

-   Database locks → Optimize queries, increase timeout
-   Memory leaks → Check queue worker, restart
-   High response time → Enable query logging, optimize

### Level 3: Critical Issues

-   All webhooks failing → PayOS API down? Check status page
-   Database corruption → Restore from backup
-   Security breach → Rotate all credentials immediately

## Documentation

-   [ ] Update README.md
-   [ ] Update API documentation
-   [ ] Document known issues
-   [ ] Share with team
-   [ ] Customer support trained

## Sign-off

**Deployed by:** ********\_\_\_********  
**Date:** ********\_\_\_********  
**Verified by:** ********\_\_\_********  
**Date:** ********\_\_\_********

**Production URL:** https://********\_\_\_********  
**Webhook URL:** https://********\_\_\_********/payments/webhook/payos  
**PayOS Environment:** ☐ Test ☐ **Production**

---

✅ **Deployment Complete**  
📝 **Next Review:** [Date]
