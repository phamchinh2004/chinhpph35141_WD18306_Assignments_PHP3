<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index(){
        return view("app.login");
    }
    public function login(Request $request){
        //Xử lý logic login
    }
    public function logout(){
        // Xử lý logic logout
    }
}
