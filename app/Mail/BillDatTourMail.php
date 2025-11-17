<?php

namespace App\Mail;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class BillDatTourMail extends Mailable
{
    use Queueable, SerializesModels;

    public $hoadon;
    public $pdfPath;
    public $payment; // Thêm payment object

    public function __construct($hoadon, $pdfPath = null, $payment = null)
    {
        $this->hoadon = $hoadon;
        $this->pdfPath = $pdfPath;
        $this->payment = $payment;
    }

    public function build()
    {
        $datTour = $this->hoadon->datTour;
        $isPaid = $datTour->payment_status === 'paid' || ($this->payment && $this->payment->status === 'succeeded');

        // Nếu đã thanh toán, gửi email xác nhận tour (không có QR)
        if ($isPaid) {
            $mail = $this->subject('Xác nhận đặt tour thành công - ' . $datTour->tour->ten_tour)
                ->view('emails.tour_confirmation')
                ->with([
                    'hoadon' => $this->hoadon,
                    'datTour' => $datTour,
                    'payment' => $this->payment,
                ]);
        } else {
            // Nếu chưa thanh toán, gửi hóa đơn kèm QR code
            $qrUrl = $this->generateQRUrl();
            $mail = $this->subject('Hóa đơn đặt tour - Vui lòng thanh toán')
                ->view('emails.bill_datTour')
                ->with([
                    'hoadon' => $this->hoadon,
                    'payment' => $this->payment,
                    'qrUrl' => $qrUrl,
                    'bankInfo' => $this->getBankInfo()
                ]);
        }

        // Attach PDF nếu có
        if ($this->pdfPath && file_exists(storage_path('app/' . $this->pdfPath))) {
            $mail->attach(storage_path('app/' . $this->pdfPath), [
                'as' => 'hoadon-dattour.pdf',
                'mime' => 'application/pdf',
            ]);
        }

        return $mail;
    }

    /**
     * Tạo đường dẫn QR code VietQR
     */
    private function generateQRUrl()
    {
        try {
            $bankInfo = $this->getBankInfo();

            // Tạo URL VietQR
            $vietQrUrl = "https://img.vietqr.io/image/{$bankInfo['bankId']}-{$bankInfo['accountNo']}-{$bankInfo['template']}.png?" .
                http_build_query([
                    'amount' => $bankInfo['amount'],
                    'addInfo' => $bankInfo['description'],
                    'accountName' => $bankInfo['accountName']
                ]);

            return $vietQrUrl;
        } catch (Exception $e) {
            Log::error('QR URL generation failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Thông tin ngân hàng + nội dung chuyển khoản có mã khách hàng
     */
    private function getBankInfo()
    {
        $datTour = $this->hoadon->datTour;

        // Tạo nội dung chuyển khoản có thêm mã KH
        $description = 'THANHTOAN ' . $datTour->id . ' ' . $datTour->id_khachhang;

        return [
            'bankId' => 'MB',
            'accountNo' => '0663567899999',
            'template' => 'qr_only', // Gọn gàng hơn cho email
            'amount' => $datTour->tour->gia * $datTour->so_nguoi,
            'description' => $description,
            'accountName' => 'LE VAN CHIEN'
        ];
    }
}
