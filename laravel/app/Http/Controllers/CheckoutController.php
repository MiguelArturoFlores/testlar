<?php

namespace testmiguel\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use testmiguel\CountryState;
use testmiguel\Http\Requests;
use testmiguel\Product;
use testmiguel\User;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {

        if (!$this->hasBasketProducts()) {
            //TODO return to the store view
            echo 'no basket products';
        }

        $productList = $this->validateProductListDB();

        $user = new User();

        $countryListName = CountryState::all()->pluck('name');
        $countryListName->prepend("ninguno");

        $statePosition = 0;

        if (Auth::check()) {
            $user = Auth::user();
            $user->password = "";
            $found = false;
            foreach ($countryListName as $country) {
                if ($country == $user->country_state) {
                    $found = true;
                    break;
                }
                $statePosition++;
            }
            if (!$found) {
                $statePosition = 0;
            }
        } else {

        }

        return view('not-logged/checkout/checkout',
            ['user' => $user, 'stateList' => $countryListName, 'statePosition' => $statePosition, 'productList' => $productList]
        )->withCookie(cookie('basketProducts', $productList));
    }

    public function hasBasketProducts()
    {
        return isset($_COOKIE['basketProducts']);
    }

    private function validateProductListDB()
    {
        $basketProducts = $_COOKIE['basketProducts'];
        $jsonProducts = json_decode($basketProducts);
        $productIds = array();
        $size = count($jsonProducts);
        for ($i = 0; $i < $size; $i++) {
            array_push($productIds,$jsonProducts[$i]->id);
        }
        $dbProducts = Product::whereIn('id',$productIds)->get();

        $sizeDB = count($dbProducts);
        $productCheckoutList = array();
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $sizeDB; $j++) {
                if($dbProducts[$j]->id == $jsonProducts[$i]->id){
                    $product = $dbProducts[$j];
                    $product->quantity =  $jsonProducts[$i]->quantity;
                    $product->totalPrice = ($product->price - $product->discount) * $product->quantity;
                    array_push($productCheckoutList,$product);
                    break;
                }
            }
        }
        return $productCheckoutList;
    }

}
