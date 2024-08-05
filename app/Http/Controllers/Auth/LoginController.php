<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view("app.login");
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            "username" => ["required", "string", "max:100"],
            "password" => ["required", "string", "max:100"],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (!Auth::user()->hasVerifiedEmail()) {
                $email = Auth::user()->email;
                $user_id = Auth::user()->id;
                $information = Auth::user()->informations->first();
                $fullname = $information ? $information->full_name : 'Không có thông tin';
                $token = base64_encode($email);
                Mail::to($email)->send(new VerifyEmail($token, $fullname, $user_id));
                return redirect()->route('notificationEmail');
            }
            if (Auth::user()->isAdmin() || Auth::user()->isStaff()) {
                return redirect()->route('adminHome');
            }
            return redirect()->route('userHome.index');
        }
        return back()->withErrors([
            'username' => 'Thông tin đăng nhập không chính xác, vui lòng thử lại!'
        ])->withInput($credentials);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
