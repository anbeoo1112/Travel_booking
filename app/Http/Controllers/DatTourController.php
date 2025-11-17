<?php

namespace App\Http\Controllers;

use App\Models\DatTour;
use App\Models\Tour;
use App\Models\NguoiDung;
use App\Models\HoaDonDatTour;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class DatTourController extends Controller
{
    // Hiển thị danh sách đặt tour và tìm kiếm
    public function index(Request $request)
    {
        $nguoiDungs = NguoiDung::all();
        $tours = Tour::all();
        $keyword = $request->input('keyword');

        $datTours = DatTour::when($keyword, function ($query) use ($keyword) {
            return $query->where('ho_ten', 'LIKE', "%{$keyword}%")
                ->orWhere('id', 'LIKE', "%{$keyword}%")
                ->orWhere('email', 'LIKE', "%{$keyword}%")
                ->orWhere('so_dien_thoai', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'desc')
            ->get();

        $datTours->map(function ($datTour) {
            $datTour->ngay_dat_tour = Carbon::parse($datTour->ngay_dat_tour)->format('d-m-Y H:i:s');
            $datTour->ngay_huy_tour = $datTour->ngay_huy_tour
                ? Carbon::parse($datTour->ngay_huy_tour)->format('d-m-Y H:i:s')
                : 'N/A';
            return $datTour;
        });

        return view('admin.QuanLyDatTour.index', compact('nguoiDungs', 'tours', 'datTours', 'keyword'));
    }

    // Lịch sử đặt tour người dùng
    public function indexUser(Request $request)
    {
        $userId = Auth::id();
        $keyword = $request->input('keyword'); // Lấy từ khóa tìm kiếm

        $datTours = DatTour::where('id_khachhang', $userId)
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('tour', function ($q) use ($keyword) {
                    $q->where('ten_tour', 'like', "%{$keyword}%");
                })
                    ->orWhere('trang_thai_dattour', 'like', "%{$keyword}%");
            })
            ->orderBy('ngay_dat_tour', 'desc')
            ->paginate(5);

        $datTours->appends(['keyword' => $keyword]); // Giữ từ khóa khi chuyển trang

        return view('user.lichSuDatTour', compact('datTours', 'keyword'));
    }



    // Đặt tour
    public function store(Request $request)
    {
        $request->validate([
            'id_tour' => 'required|string',
            'ho_ten' => 'required|max:100',
            'email' => 'required|email|max:50',
            'so_dien_thoai' => 'required|max:20',
            'so_nguoi' => 'required',
            'ngay_di' => ['required', 'date'],
        ]);

        $data = $request->all();
        $data['trang_thai_dattour'] = 'Chờ xác nhận';
        $data['ngay_dat_tour'] = Carbon::now();

        if (Auth::check()) {
            $data['id_khachhang'] = (string) Auth::user()->id;
        }

        // ✅ Lấy mã đặt tour cuối cùng (ví dụ: DT-001, DT-002...)
        $lastDatTour = DatTour::select('id')
            ->orderByRaw("CAST(SUBSTRING(id, 4) AS UNSIGNED) DESC")
            ->first();

        if ($lastDatTour && preg_match('/DT-(\d+)/', $lastDatTour->id, $matches)) {
            $lastNumber = (int) $matches[1];
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        // ✅ Format mã mới có 3 chữ số, ví dụ: DT-001
        $data['id'] = 'DT-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // ✅ Kiểm tra trùng mã (phòng khi 2 người đặt cùng lúc)
        while (DatTour::where('id', $data['id'])->exists()) {
            $nextNumber++;
            $data['id'] = 'DT-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        }

        $booking = DatTour::create($data);

        // ✅ Redirect sang checkout để chọn phương thức thanh toán
        return redirect()->route('user.booking.checkout', $booking)
            ->with('success', 'Đặt tour thành công. Vui lòng chọn phương thức thanh toán.');
    }


    // Xác nhận đặt tour và gửi bill (CHỈ dành cho thanh toán trực tiếp)
    public function xacNhan($id)
    {
        $datTour = DatTour::findOrFail($id);

        // Kiểm tra nếu đã thanh toán online thì không cho xác nhận thủ công
        if ($datTour->payment_status === 'paid') {
            return redirect()->route('quanlydattour')
                ->with('error', 'Tour này đã được thanh toán online và tự động xác nhận. Không thể xác nhận lại.');
        }

        // Kiểm tra nếu đã xác nhận rồi
        if ($datTour->trang_thai_dattour === 'Đã xác nhận') {
            return redirect()->route('quanlydattour')
                ->with('info', 'Tour này đã được xác nhận trước đó.');
        }

        $datTour->id_nguoidung = Auth::user()->id;
        $datTour->trang_thai_dattour = 'Đã xác nhận';
        $datTour->save();

        $lastHoaDonDatTour = HoaDonDatTour::selectRaw("CAST(SUBSTRING(id, 4) AS UNSIGNED) as so_hoadon")
            ->orderBy('so_hoadon', 'desc')
            ->first();
        $newNumber = $lastHoaDonDatTour ? $lastHoaDonDatTour->so_hoadon + 1 : 1;

        $hoaDonData = [
            'id' => 'HD-' . $newNumber,
            'id_dattour' => $datTour->id,
            'phuong_thuc_thanh_toan' => 'Thanh toán trực tiếp tại quầy',
            'trang_thai' => 'Chưa thanh toán',
        ];

        $hoaDon = HoaDonDatTour::create($hoaDonData);

        // TẢI LẠI đặt tour để đảm bảo có đủ thông tin email
        $datTour = DatTour::find($hoaDon->id_dattour);

        if ($hoaDon && $datTour && !empty($datTour->email)) {
            $pdfPath = $this->renderBillToPdf($hoaDon);
            Mail::to($datTour->email)->send(new \App\Mail\BillDatTourMail($hoaDon, $pdfPath));
        }

        return redirect()->route('quanlydattour')->with('success', 'Đã xác nhận đặt tour và gửi bill thành công');
    }

    // Tạo file PDF hóa đơn
    protected function renderBillToPdf($hoaDon)
    {
        // Download QR code và convert thành base64 để embed vào PDF
        $qrBase64 = $this->generateQRBase64($hoaDon);

        $pdf = Pdf::loadView('admin.QuanLyHoaDon.xemhoadon', [
            'hoaDonDatTour' => $hoaDon,
            'qrBase64' => $qrBase64,
            'isPdf' => true // Flag để view biết đang render PDF
        ]);

        $pdfPath = 'bills/bill_' . $hoaDon->id . '.pdf';
        Storage::put($pdfPath, $pdf->output());
        return $pdfPath;
    }

    // Tạo QR code base64 cho PDF
    private function generateQRBase64($hoaDon)
    {
        try {
            $bankId = 'TPB'; // TP Bank
            $accountNo = '03801859501'; // Số tài khoản thực tế
            $template = 'qr_only';
            $amount = $hoaDon->datTour->tour->gia * $hoaDon->datTour->so_nguoi;
            $description = 'THANHTOAN ' . $hoaDon->datTour->id;
            $accountName = 'LE XUAN AN';

            $vietQrUrl = "https://img.vietqr.io/image/{$bankId}-{$accountNo}-{$template}.png?" .
                http_build_query([
                    'amount' => $amount,
                    'addInfo' => $description,
                    'accountName' => $accountName
                ]);

            // Download QR code
            $qrData = file_get_contents($vietQrUrl);
            if ($qrData) {
                return 'data:image/png;base64,' . base64_encode($qrData);
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('QR Base64 generation failed: ' . $e->getMessage());
        }

        return null;
    }

    // Hủy tour (admin)
    public function huy($id)
    {
        $datTour = DatTour::findOrFail($id);

        // Nếu trạng thái đặt tour là "Đã Hủy" thì xóa hóa đơn trước, rồi mới xóa đặt tour
        if ($datTour->trang_thai_dattour === 'Đã Hủy') {
            // Xóa hóa đơn liên quan
            \App\Models\HoaDonDatTour::where('id_dattour', $datTour->id)->delete();

            $datTour->delete();
            return redirect()->route('quanlydattour')->with('success', 'Đã hủy và xóa thông tin đặt tour thành công');
        }

        $datTour->id_nguoidung = Auth::user()->id;
        $datTour->trang_thai_dattour = 'Đã Hủy';
        $datTour->ngay_huy_tour = now();
        $datTour->save();

        return redirect()->route('quanlydattour')->with('success', 'Đã hủy đặt tour thành công');
    }

    // Hủy tour (user)
    public function huyUser($id)
    {
        $datTour = DatTour::findOrFail($id);

        // Nếu trạng thái đặt tour là "Đã Hủy" thì xóa luôn thông tin đặt tour
        if ($datTour->trang_thai_dattour === 'Đã Hủy') {
            $datTour->delete();
            return redirect()->route('lichSuDatTour')->with('success', 'Đã hủy và xóa thông tin đặt tour thành công');
        }

        $datTour->trang_thai_dattour = 'Đã Hủy';
        $datTour->ngay_huy_tour = now();
        $datTour->save();

        return redirect()->route('lichSuDatTour')->with('success', 'Đã hủy đặt tour thành công');
    }
}
