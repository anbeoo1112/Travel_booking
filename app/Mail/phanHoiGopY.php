<?php

namespace App\Mail;

use App\Models\GopY;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class phanHoiGopY extends Mailable
{
    use Queueable, SerializesModels;

    public $gopY;

    public function __construct(GopY $gopY)
    {
        $this->gopY = $gopY;
    }

    public function build()
    {
        return $this->subject('Phản Hồi Góp Ý Của Bạn')
                    ->view('admin.QuanLyGopY.phanhoigopy')
                    ->with(['gopY' => $this->gopY]);
    }
}

