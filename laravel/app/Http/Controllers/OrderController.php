<?php

namespace testmiguel\Http\Controllers;

use Illuminate\Http\Request;

use testmiguel\Http\Requests;

use testmiguel\Order;

use DB;

use Auth;

class OrderController extends Controller
{
    public function userOrders (Request $request){
    	if(Auth::check()){
    		echo 'you are in';
    	}else {
    		echo 'need to login';
    	}
    }

    public function adminOrders (Request $request){
      $orders = Order::paginate(3);
      //$orders = DB::table('storeorder')->paginate(2);
      //var_dump($orders);
      return view('adminOrders', ['orders' => $orders]);
    }
}
