<?php

namespace testmiguel\Http\Controllers;

use Illuminate\Http\Request;

use testmiguel\Http\Requests;

use Auth;

class OrderController extends Controller
{
    public function index (Request $request){
    	if(Auth::check()){
    		echo 'you are in';
    	}else {
    		echo 'need to login';
    	}
    }
}
