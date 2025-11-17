<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\TrangTinTuc;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IncrementDocCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Lấy ID từ route
        $id = $request->route('id'); // hoặc theo cách bạn đã định nghĩa route

        // Tăng giá trị của trường 'doc'
        TrangTinTuc::where('id', $id)->increment('doc');
        return $next($request);
    }
}
