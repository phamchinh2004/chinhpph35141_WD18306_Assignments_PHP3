<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class VerificationController extends Controller
{
    public function verify(Request $request, string $id, string $token)
    {
        $email = base64_decode($token);
        // dd($email);
        $user = User::select('users.*')->where('email', $email)->where('id', $id)->first();
        if ($user->email_verified_at == null) {
            $user->email_verified_at = now();
            $user->save();
            Auth::login($user);
            $request->session()->regenerate();
            if (Auth::user()->isAdmin()) {
                return redirect()->route('adminHome');
            }
            return redirect()->route('userHome.index');
        }
        // if(Auth::user()->isAdmin()){
        //     return redirect()->route('adminHome');
        // }
        // return redirect()->route('userHome.index');
    }

    public function resend(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['message' => 'Bạn cần đăng nhập để gửi lại email!']);
        }
        $user = Auth::user();

        // Kiểm tra nếu người dùng đã xác minh email
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('userHome.index')->with('status', 'Email của bạn đã được xác minh.');
        }
        $email = $user->email;
        $user_id = $user->id;
        $information = $user->informations->first();
        $fullname = $information ? $information->full_name : 'Không có thông tin';
        $token = base64_encode($email);
        Mail::to($email)->send(new VerifyEmail($token, $fullname, $user_id));
        return Redirect::route('notificationEmail')->with('status', 'Email xác minh đã được gửi lại.');
    }
    public function show()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['message' => 'Bạn cần đăng nhập để gửi lại email!']);
        }
        $user = Auth::user();

        // Kiểm tra nếu người dùng đã xác minh email
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('userHome.index')->with('status', 'Email của bạn đã được xác minh.');
        }
        return view('app.mail.notificationEmail');
    }
}