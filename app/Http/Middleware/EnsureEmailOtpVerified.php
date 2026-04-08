<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureEmailOtpVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        if ($request->routeIs('otp.*')) {
            return $next($request);
        }

        if (! session('email_2fa_passed')) {
            return redirect()->route('otp.notice');
        }

        return $next($request);
    }
}