<?php

namespace testmiguel\Http\Controllers;

use Illuminate\Http\Request;

use testmiguel\Http\Requests;

use Auth;

class LoginController extends Controller
{
  	public function loginUser (Request $request){

  		$email = 'miguel@abc.com';
  		$password = '123456';

		$email = $request->input('email');
		$password = $request->input('password');

  		if(Auth::check()){
  			if(Auth::user()->email != $email){
  				Auth::logout();
  			}
  		}

  		if(Auth::attempt(['email'=>$email, 'password' => $password ])){
  			return redirect("/");
  		} else {
			//add error when try to login
			return redirect('/login');
  		}

  	}

    public function logout (Request $request){
        Auth::logout();
        return redirect('/login');
    }
}
