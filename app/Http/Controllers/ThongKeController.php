<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatTour;
use App\Models\Tour;
use Carbon\Carbon;

class ThongKeController extends Controller
{
    public function index()
    {
        //  
        $monthlyRevenue = DatTour::join('tour', 'dat_tour.id_tour', '=', 'tour.id')
            ->selectRaw('MONTH(dat_tour.ngay_dat_tour) as month, SUM(tour.gia * dat_tour.so_nguoi) as revenue')
            ->whereYear('dat_tour.ngay_dat_tour', date('Y'))
            ->where('dat_tour.trang_thai_dattour', 'Đã Xác Nhận')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('revenue', 'month');

        // Get monthly booking counts
        $monthlyData = DatTour::join('tour', 'dat_tour.id_tour', '=', 'tour.id')
            ->selectRaw('MONTH(dat_tour.ngay_dat_tour) as month, COUNT(dat_tour.id) as booking_count')
            ->whereYear('dat_tour.ngay_dat_tour', date('Y'))
            ->where('dat_tour.trang_thai_dattour', 'Đã Xác Nhận')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('booking_count', 'month');

        // Prepare data for the chart
        $months = range(1, 12); // List of months from 1 to 12
        $revenues = [];
        $bookingCounts = [];

        foreach ($months as $month) {
            $revenues[] = $monthlyRevenue->get($month, 0);
            $bookingCounts[] = $monthlyData->get($month, 0); // Get booking count or default to 0
        }

        return view('admin.ThongKe.index', [
            'months' => json_encode($months),
            'revenues' => json_encode($revenues),
            'bookingCounts' => json_encode($bookingCounts),
        ]);
    }


}
