<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\Information;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        return view("app.register");
    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'fullname' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'digits_between:10,12'],
            'username' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string', 'max:100'],
            'repassword' => ['required', 'string', 'max:100', 'same:password'],
        ]);
        $dataUser = [
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now()
        ];
        $user = User::create($dataUser);
        $dataUserInfo = [
            'full_name' => $request->fullname,
            'phone_number' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'account_id' => $user->id,
            'created_at' => Carbon::now()
        ];
        $userInfo=Information::create($dataUserInfo);
        \Illuminate\Support\Facades\Auth::login($user);
        $request->session()->regenerate();
        $token = Hash::make($user->mail);
        Mail::to($user->email)->send(new VerifyEmail($token, $user->name));
        return redirect()->intended('/');
    }
}
