<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class PayOSService
{
    /**
     * Xác thực chữ ký HMAC SHA256 từ PayOS webhook
     *
     * @param array $payload
     * @return bool
     */
    public function verifySignature(array $payload): bool
    {
        // Lấy signature từ payload
        $checksum = $payload['signature'] ?? ($payload['data']['signature'] ?? null);

        if (!$checksum) {
            return false;
        }

        // Lấy data và loại bỏ signature
        $data = $payload['data'] ?? $payload;
        unset($data['signature']);

        // Sắp xếp theo key
        ksort($data);

        // Tạo message string theo format key=value&key=value
        $message = collect($data)
            ->map(fn($v, $k) => $k . '=' . $v)
            ->implode('&');

        // Tính HMAC SHA256
        $checksumKey = config('services.payos.checksum_key');
        $expect = hash_hmac('sha256', $message, $checksumKey);

        // So sánh an toàn
        return hash_equals($expect, $checksum);
    }

    /**
     * Tạo chữ ký cho request tới PayOS
     *
     * @param array $data
     * @return string
     */
    public function createSignature(array $data): string
    {
        ksort($data);

        $message = collect($data)
            ->map(fn($v, $k) => $k . '=' . $v)
            ->implode('&');

        return hash_hmac('sha256', $message, config('services.payos.checksum_key'));
    }

    /**
     * Tạo order tại PayOS để lấy QR code
     *
     * @param array $params
     * @return array
     */
    public function createOrder(array $params): array
    {
        $clientId = config('services.payos.client_id');
        $apiKey = config('services.payos.api_key');

        // Validate credentials
        if (!$clientId || !$apiKey) {
            throw new \Exception('PayOS credentials not configured. Check .env file.');
        }

        $headers = [
            'x-client-id' => $clientId,
            'x-api-key' => $apiKey,
            'Content-Type' => 'application/json',
        ];

        try {
            // Use cURL instead of Guzzle for better compatibility
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => 'https://api-merchant.payos.vn/v1/Payment/Create',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_HTTPHEADER => [
                    'x-client-id: ' . $clientId,
                    'x-api-key: ' . $apiKey,
                    'Content-Type: application/json',
                ],
                CURLOPT_POSTFIELDS => json_encode($params),
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYPEER => false,
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);

            if ($error) {
                throw new \Exception('cURL Error: ' . $error);
            }

            $result = json_decode($response, true);

            // Log response for debugging
            Log::debug('PayOS API Response', [
                'httpCode' => $httpCode,
                'result' => $result,
            ]);

            if ($httpCode >= 400) {
                throw new \Exception('PayOS API Error: ' . ($result['message'] ?? $response));
            }

            // PayOS trả về format: { code, message, data: { orderCode, qrCode, checkoutUrl, ... } }
            if (isset($result['data'])) {
                return array_merge($result['data'], ['raw' => $result]);
            }

            return $result;
        } catch (\Exception $e) {
            Log::error('PayOS createOrder failed', [
                'error' => $e->getMessage(),
                'params' => $params,
            ]);
            throw $e;
        }
    }
}
