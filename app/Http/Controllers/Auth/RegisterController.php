<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        dd($data);
        // $validate = Validator::make($request->all(), $data);
        // if ($validate->fails()) {
        //     return redirect()->back()->withErrors($validate)->withInput();
        // }
        // $request->session()->regenerate();
        // return view('app.login');
    }
}
