<?php

namespace testmiguel\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use testmiguel\CountryState;
use testmiguel\Http\Requests;
use testmiguel\Order;
use testmiguel\Product;
use testmiguel\ProductOrder;
use testmiguel\User;
use testmiguel\OrderState;
use Hash;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {

        if (!$this->hasBasketProducts()) {
            //TODO return to the store view
            echo 'no basket products';
            return view('/');
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

        $referenceCode = $request->cookie('orderReference');
        if ($referenceCode == '') {
            $referenceCode = $this->generateTemporaryOrder();
        } else {
            $referenceCode = $this->validateReferenceCode($referenceCode);
        }

        $response = new \Illuminate\Http\Response(view('not-logged/checkout/checkout',
            ['user' => $user, 'stateList' => $countryListName, 'statePosition' => $statePosition, 'productList' => $productList]
        ));
        return $response->cookie('orderReference', $referenceCode);
    }

    public function hasOrderReference()
    {
        return isset($_COOKIE['orderReference']);
    }

    public function validateReferenceCode($referenceCode)
    {
        $order = Order::where('reference_code', $referenceCode)->first();
        if ($order == '' || ($order->state != OrderState::ORDER_TEMPORAL && $order->state != OrderState::ORDER_PENDING_PAYMENT )) {
            return $this->generateTemporaryOrder();
        }

        ProductOrder::where('order_id', $order->id)->delete();
        $this->generateOrderProducts($order->id);

        return $referenceCode;
    }

    public function generateTemporaryOrder()
    {
        $userId = 0;
        if (Auth::check()) {
            $user = Auth::user();
            $userId = $user->id;
        }

        $order = new Order();
        $order->state = OrderState::ORDER_TEMPORAL;
        $order->user_id = $userId;
        $order->delivery_type = 0;
        $order->payment_type = 0;
        $order->coupon_code = 'none';
        $order->reference_code = 0;

        $order->save();
        $order->reference_code = Hash::make($order->id);
        $order->save();

        $this->generateOrderProducts($order->id);

        return $order->reference_code;
    }

    public function generateOrderProducts($orderId)
    {
        //GENERATING ORDER PRODUCTS
        $basketProducts = $_COOKIE['basketProducts'];
        $jsonProducts = json_decode($basketProducts);
        $productIds = array();
        $size = count($jsonProducts);
        for ($i = 0; $i < $size; $i++) {
            array_push($productIds, $jsonProducts[$i]->id);
        }
        $dbProducts = Product::whereIn('id', $productIds)->get();

        $sizeDB = count($dbProducts);
        $orderProductList = array();
        for ($j = 0; $j < $sizeDB; $j++) {
            $productOrder = new ProductOrder();
            $productOrder->price = $dbProducts[$j]->price;
            $productOrder->product_id = $dbProducts[$j]->id;
            $productOrder->order_id = $orderId;
            $productOrder->small_description = $dbProducts[$j]->small_description;
            $productOrder->discount = $dbProducts[$j]->discount;
            $productOrder->has_discount = $dbProducts[$j]->has_discount;
            $productOrder->is_new = $dbProducts[$j]->is_new;
            $productOrder->image = $dbProducts[$j]->image;
            $productOrder->description = $dbProducts[$j]->description;
            $productOrder->save();
        }
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
            array_push($productIds, $jsonProducts[$i]->id);
        }
        $dbProducts = Product::whereIn('id', $productIds)->get();

        $sizeDB = count($dbProducts);
        $productCheckoutList = array();
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $sizeDB; $j++) {
                if ($dbProducts[$j]->id == $jsonProducts[$i]->id) {
                    $product = $dbProducts[$j];
                    $product->quantity = $jsonProducts[$i]->quantity;
                    $product->size = $jsonProducts[$i]->size;
                    $product->totalPrice = ($product->price - $product->discount) * $product->quantity;

                    array_push($productCheckoutList, $product);
                    break;
                }
            }
        }
        return $productCheckoutList;
    }

}
