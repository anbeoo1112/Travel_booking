<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MomoService
{
    protected $endpoint;
    protected $partnerCode;
    protected $accessKey;
    protected $secretKey;
    protected $notifyUrl;
    protected $returnUrl;

    public function __construct()
    {
        $this->endpoint = config('services.momo.endpoint');
        $this->partnerCode = config('services.momo.partner_code');
        $this->accessKey = config('services.momo.access_key');
        $this->secretKey = config('services.momo.secret_key');
        $this->notifyUrl = config('services.momo.notify_url');
        $this->returnUrl = config('services.momo.return_url');
    }

    public function createPayment($orderId, $amount, $orderInfo)
    {
        $requestId = (string) Str::uuid();
        $requestType = 'captureWallet';
        $extraData = ''; // Base64 encoded json (empty string nếu không có data)

        // Tạo signature theo format chuẩn MoMo API v3 - CHÚ Ý THỨ TỰ ALPHABET
        // Không có autoCapture, lang, orderExpireTime, orderGroupId, partnerName, storeId, storeName trong signature
        // Format: accessKey&amount&extraData&ipnUrl&orderId&orderInfo&partnerCode&redirectUrl&requestId&requestType
        $rawHash = "accessKey={$this->accessKey}&amount={$amount}&extraData={$extraData}&ipnUrl={$this->notifyUrl}&orderId={$orderId}&orderInfo={$orderInfo}&partnerCode={$this->partnerCode}&redirectUrl={$this->returnUrl}&requestId={$requestId}&requestType={$requestType}";

        $signature = hash_hmac('sha256', $rawHash, $this->secretKey);

        $data = [
            'partnerCode' => $this->partnerCode,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $this->returnUrl,
            'ipnUrl' => $this->notifyUrl,
            'requestType' => $requestType,
            'extraData' => $extraData,
            'lang' => 'vi',
            'signature' => $signature
        ];

        // Log signature để debug
        Log::info('MoMo Create Payment Signature', [
            'orderId' => $orderId,
            'rawHash' => $rawHash,
            'signature' => $signature,
            'data' => $data
        ]);

        try {
            // Tắt SSL verification cho môi trường test/development
            // Trong production nên bật lại hoặc cấu hình certificate đúng
            $response = Http::withOptions([
                'verify' => false, // Tắt SSL verification cho MoMo test environment
            ])->timeout(30)->post($this->endpoint, $data);

            $result = $response->json();

            // Log response để debug
            Log::info('MoMo Payment Response', [
                'orderId' => $orderId,
                'status' => $response->status(),
                'result' => $result,
            ]);

            return $result;
        } catch (\Exception $e) {
            Log::error('MoMo Payment Request Failed', [
                'orderId' => $orderId,
                'error' => $e->getMessage(),
            ]);

            return [
                'resultCode' => 99,
                'message' => 'Lỗi kết nối tới MoMo: ' . $e->getMessage(),
            ];
        }
    }

    public function verifyPayment($data)
    {
        // Kiểm tra các field bắt buộc theo MoMo API v3
        $requiredFields = ['partnerCode', 'orderId', 'requestId', 'amount', 'orderInfo', 'orderType', 'transId', 'resultCode', 'message', 'payType', 'responseTime', 'signature'];

        foreach ($requiredFields as $field) {
            if (!array_key_exists($field, $data)) {
                Log::warning("MoMo verify: Missing required field: {$field}", [
                    'provided_fields' => array_keys($data)
                ]);
                return false;
            }
        }

        // Lấy signature từ data
        $signature = $data['signature'];

        // MoMo có thể trả về extraData là null, convert thành empty string
        $extraData = $data['extraData'] ?? '';
        if ($extraData === null) {
            $extraData = '';
        }

        // Tạo raw hash theo format chuẩn MoMo API v3 IPN
        // Format: accessKey=$accessKey&amount=$amount&extraData=$extraData&message=$message&orderId=$orderId&orderInfo=$orderInfo&orderType=$orderType&partnerCode=$partnerCode&payType=$payType&requestId=$requestId&responseTime=$responseTime&resultCode=$resultCode&transId=$transId
        $rawHash = "accessKey={$this->accessKey}&amount={$data['amount']}&extraData={$extraData}&message={$data['message']}&orderId={$data['orderId']}&orderInfo={$data['orderInfo']}&orderType={$data['orderType']}&partnerCode={$data['partnerCode']}&payType={$data['payType']}&requestId={$data['requestId']}&responseTime={$data['responseTime']}&resultCode={$data['resultCode']}&transId={$data['transId']}";

        $expectedSignature = hash_hmac('sha256', $rawHash, $this->secretKey);

        // Log để debug
        Log::info('MoMo Verify Payment', [
            'orderId' => $data['orderId'],
            'resultCode' => $data['resultCode'],
            'extraData' => $extraData,
            'rawHash' => $rawHash,
            'expectedSignature' => $expectedSignature,
            'receivedSignature' => $signature,
            'signature_match' => hash_equals($expectedSignature, $signature)
        ]);

        // Sử dụng hash_equals để tránh timing attack
        return hash_equals($expectedSignature, $signature);
    }
}
