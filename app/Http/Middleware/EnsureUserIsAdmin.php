<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'يجب تسجيل الدخول أولاً.');
        }

        if (Auth::user()->Role_ID !== 3) {
            abort(403, '🚫 غير مصرح لك بالوصول إلى لوحة تحكم الأدمن.');
        }

        return $next($request);
    }
}
