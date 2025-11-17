#!/bin/bash

# PayOS Webhook Test Script
# Usage: ./test-webhook.sh <order_code> <amount>

set -e

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Configuration
WEBHOOK_URL="${WEBHOOK_URL:-http://localhost:8000/payments/webhook/payos}"
CHECKSUM_KEY="${PAYOS_CHECKSUM_KEY}"

# Arguments
ORDER_CODE="${1:-ORDER_TEST_$(date +%s)}"
AMOUNT="${2:-1000000}"
TRANSACTION_ID="TXN_TEST_$(date +%s)"
DESCRIPTION="Test payment"

echo -e "${YELLOW}=== PayOS Webhook Test ===${NC}"
echo "Order Code: $ORDER_CODE"
echo "Amount: $AMOUNT"
echo "Webhook URL: $WEBHOOK_URL"
echo ""

# Kiểm tra CHECKSUM_KEY
if [ -z "$CHECKSUM_KEY" ]; then
    echo -e "${RED}Error: PAYOS_CHECKSUM_KEY not set${NC}"
    echo "Please set environment variable:"
    echo "  export PAYOS_CHECKSUM_KEY='your_key_here'"
    exit 1
fi

# Tạo data string theo thứ tự alphabet
DATA="amount=${AMOUNT}&description=${DESCRIPTION}&orderCode=${ORDER_CODE}&transactionId=${TRANSACTION_ID}"

echo -e "${YELLOW}Data string:${NC}"
echo "$DATA"
echo ""

# Tính signature HMAC SHA256
SIGNATURE=$(echo -n "$DATA" | openssl dgst -sha256 -hmac "$CHECKSUM_KEY" | awk '{print $2}')

echo -e "${YELLOW}Signature:${NC}"
echo "$SIGNATURE"
echo ""

# Tạo payload JSON
PAYLOAD=$(cat <<EOF
{
  "code": "00",
  "desc": "Thành công",
  "data": {
    "orderCode": "$ORDER_CODE",
    "amount": $AMOUNT,
    "description": "$DESCRIPTION",
    "transactionId": "$TRANSACTION_ID",
    "signature": "$SIGNATURE"
  }
}
EOF
)

echo -e "${YELLOW}Payload:${NC}"
echo "$PAYLOAD" | jq '.'
echo ""

# Gửi webhook request
echo -e "${YELLOW}Sending webhook request...${NC}"
RESPONSE=$(curl -s -X POST "$WEBHOOK_URL" \
  -H "Content-Type: application/json" \
  -w "\n%{http_code}" \
  -d "$PAYLOAD")

HTTP_CODE=$(echo "$RESPONSE" | tail -n1)
BODY=$(echo "$RESPONSE" | head -n-1)

echo ""
echo -e "${YELLOW}Response:${NC}"
echo "HTTP Status: $HTTP_CODE"
echo "Body: $BODY"
echo ""

# Kiểm tra kết quả
if [ "$HTTP_CODE" -eq 200 ]; then
    echo -e "${GREEN}✅ Webhook test PASSED${NC}"
    exit 0
else
    echo -e "${RED}❌ Webhook test FAILED${NC}"
    exit 1
fi
