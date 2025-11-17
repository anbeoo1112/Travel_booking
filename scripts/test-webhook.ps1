# PayOS Webhook Test Script (PowerShell)
# Usage: .\test-webhook.ps1 -OrderCode "ORDER_123" -Amount 1000000

param(
    [string]$OrderCode = "ORDER_TEST_$(Get-Date -Format 'yyyyMMddHHmmss')",
    [int]$Amount = 1000000,
    [string]$WebhookUrl = "http://localhost:8000/payments/webhook/payos"
)

# Colors
function Write-ColorOutput($ForegroundColor) {
    $fc = $host.UI.RawUI.ForegroundColor
    $host.UI.RawUI.ForegroundColor = $ForegroundColor
    if ($args) {
        Write-Output $args
    }
    $host.UI.RawUI.ForegroundColor = $fc
}

Write-ColorOutput Yellow "=== PayOS Webhook Test ==="
Write-Host "Order Code: $OrderCode"
Write-Host "Amount: $Amount"
Write-Host "Webhook URL: $WebhookUrl"
Write-Host ""

# Lấy CHECKSUM_KEY từ .env
$envPath = Join-Path $PSScriptRoot "..\..\.env"
if (Test-Path $envPath) {
    Get-Content $envPath | ForEach-Object {
        if ($_ -match '^PAYOS_CHECKSUM_KEY=(.+)$') {
            $ChecksumKey = $matches[1]
        }
    }
}

if (-not $ChecksumKey) {
    $ChecksumKey = $env:PAYOS_CHECKSUM_KEY
}

if (-not $ChecksumKey) {
    Write-ColorOutput Red "Error: PAYOS_CHECKSUM_KEY not found"
    Write-Host "Please set in .env or environment variable"
    exit 1
}

$TransactionId = "TXN_TEST_$(Get-Date -Format 'yyyyMMddHHmmss')"
$Description = "Test payment"

# Tạo data string (sorted by key)
$dataString = "amount=$Amount&description=$Description&orderCode=$OrderCode&transactionId=$TransactionId"

Write-ColorOutput Yellow "Data string:"
Write-Host $dataString
Write-Host ""

# Tính HMAC SHA256 signature
$hmacsha = New-Object System.Security.Cryptography.HMACSHA256
$hmacsha.Key = [Text.Encoding]::UTF8.GetBytes($ChecksumKey)
$hash = $hmacsha.ComputeHash([Text.Encoding]::UTF8.GetBytes($dataString))
$signature = [System.BitConverter]::ToString($hash).Replace('-', '').ToLower()

Write-ColorOutput Yellow "Signature:"
Write-Host $signature
Write-Host ""

# Tạo payload
$payload = @{
    code = "00"
    desc = "Thành công"
    data = @{
        orderCode     = $OrderCode
        amount        = $Amount
        description   = $Description
        transactionId = $TransactionId
        signature     = $signature
    }
} | ConvertTo-Json -Depth 10

Write-ColorOutput Yellow "Payload:"
Write-Host $payload
Write-Host ""

# Gửi request
Write-ColorOutput Yellow "Sending webhook request..."
try {
    $response = Invoke-WebRequest -Uri $WebhookUrl `
        -Method POST `
        -ContentType "application/json" `
        -Body $payload `
        -UseBasicParsing

    Write-Host ""
    Write-ColorOutput Yellow "Response:"
    Write-Host "HTTP Status: $($response.StatusCode)"
    Write-Host "Body: $($response.Content)"
    Write-Host ""

    if ($response.StatusCode -eq 200) {
        Write-ColorOutput Green "✅ Webhook test PASSED"
        exit 0
    }
    else {
        Write-ColorOutput Red "❌ Webhook test FAILED"
        exit 1
    }
}
catch {
    Write-Host ""
    Write-ColorOutput Red "Error: $($_.Exception.Message)"
    if ($_.Exception.Response) {
        $reader = New-Object System.IO.StreamReader($_.Exception.Response.GetResponseStream())
        $responseBody = $reader.ReadToEnd()
        Write-Host "Response Body: $responseBody"
    }
    Write-ColorOutput Red "❌ Webhook test FAILED"
    exit 1
}
