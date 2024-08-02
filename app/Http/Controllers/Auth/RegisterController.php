<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\Information;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'password' => ['required', 'string', 'max:100', 'confirmed']
        ]);
        $checkUser = User::where('email', $data['email'])->orWhere('username', $data['username'])->first();
        if (!$checkUser) {
            $dataUser = [
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'created_at' => Carbon::now(),
            ];
            $user = User::create($dataUser);
            $dataUserInfo = [
                'full_name' => $request->fullname,
                'phone_number' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
                'account_id' => $user->id,
                'created_at' => Carbon::now(),
            ];
            $userInfo = Information::create($dataUserInfo);

            $token = base64_encode($user->email);
            Mail::to($user->email)->send(new VerifyEmail($token, $userInfo->fullname, $user->id));
            return redirect()->route('notificationEmail')->with('message', 'Vui lòng kiểm tra email để xác thực tài khoản.');
        } else {
            return redirect()->back()->with('message', 'Tên đăng nhập hoặc email đã tồn tại, vui lòng thử lại!')->withInput($data);
        }
    }
}
