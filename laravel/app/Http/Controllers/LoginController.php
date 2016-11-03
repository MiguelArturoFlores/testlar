<?php

namespace testmiguel\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cookie;
use testmiguel\Http\Requests;

use Auth;

class LoginController extends Controller
{
    public function loginUser(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::check()) {
            if (Auth::user()->email != $email) {
                Auth::logout();
            }
        }

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect("/");
        } else {
            //add error when try to login
            return redirect('/login');
        }
    }

    public function loginPay(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::check()) {
            if (Auth::user()->email != $email) {
                Auth::logout();
            }
        }

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect("/checkout");
        } else {
            //add error when try to login
            return redirect('/login');
        }
    }

    public function tryLoginUser($email,$password){
        return Auth::attempt(['email' => $email, 'password' => $password]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Cookie::queue(
            Cookie::forget('orderReference')
        );
        return redirect('/login');
    }

}
