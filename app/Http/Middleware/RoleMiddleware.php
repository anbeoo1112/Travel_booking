<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        $roles = explode('|', implode('|', $roles));
        if (Auth::check() && in_array($user->vai_tro, $roles)) {
            return $next($request);
        }
        abort(403, 'Unauthorized action.');
    }
}
