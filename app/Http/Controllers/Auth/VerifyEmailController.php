<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class VerifyEmailContrller extends Controller
{
    //
    public function index()
    {
        $token='test token';
        $username='test username';
        Mail::to('user@gmail.com')->send(new VerifyEmail($token, $username));
    }
    public function login($token)
    {
        $users = User::query()->where('email_verified_at', null)->get();
        foreach ($users as $user) {
            if (Hash::check($user->email, $token)) {
                $user->update(['email_verified_at' => Carbon::now()]);
                return redirect()->route('/');
            }
        }
    }
    public function logout()
    {
        // Xử lý logic logout
    }
}
