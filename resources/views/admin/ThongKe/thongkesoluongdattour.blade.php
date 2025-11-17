<div style="width: 50%; margin: auto; padding: 50px;">
    <h2 class="text-center mb-4">Bảng Số Lượng Đặt Tour theo Tháng</h2>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark" >
            <tr>
                <th><center>Tháng</center></th>
                <th><center>Số Lượng Đặt Tour</center></th>
                <th><center>Doanh Thu</center></th>
            </tr>
        </thead>
        <tbody>
            @php
                $monthsArray = json_decode($months); // Giải mã JSON tháng
                $bookingCountsArray = json_decode($bookingCounts);
                $revenuesArray = json_decode($revenues);
            @endphp

            @foreach ($monthsArray as $index => $month)
                <tr>
                    <td class="text-center">{{ $month }}</td>
                    <td class="text-center">{{ number_format($bookingCountsArray[$index]) }}</td>
                    <td class="text-center">{{ number_format($revenuesArray[$index]) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
