<?php

namespace App\Http\Responses;

use App\Mail\LoginVerificationCodeMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        $code = (string) random_int(100000, 999999);

        $user->forceFill([
            'email_login_code' => Hash::make($code),
            'email_login_code_expires_at' => now()->addMinutes(10),
        ])->save();

        session()->forget('email_2fa_passed');

        Mail::to($user->email)->send(new LoginVerificationCodeMail($user->name, $code));

        return redirect()->route('otp.notice');
    }
}