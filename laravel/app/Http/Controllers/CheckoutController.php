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
        if ($order == '' || ($order->state != OrderState::ORDER_TEMPORAL && $order->state != OrderState::ORDER_PENDING_PAYMENT)) {
            return $this->generateTemporaryOrder();
        }

        $this->recreateOrderProducts($order->id);

        return $referenceCode;
    }

    /**
     * create temporry order with order reference code
     * @return reference order
     */
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

    /**
     * store product list associated to this order on db
     * @param $orderId
     */
    public function generateOrderProducts($orderId)
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

    /**
     * retrieve product list with DB to set on cookies
     **/
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

    public function pay(Request $request)
    {
        //TODO all this functionality except fields validation is the same that we use on index, check how to make it in a common method
        if (!$this->hasBasketProducts()) {
            //TODO add parameters to show message saying there was an error due to invalid basketProducts
            return view('/checkout');
        }

        if (Auth::check()) {
            $user = Auth::user();
            //TODO check if user has change his address or cellphone and save new values.
        } else {
            $email = $request->input('email');
            $userExist = User::where('email', $email)->first();
            if ($userExist) {
                return $this->redirectToLogin($email);
            }
            $user = $this->registerNewTemporaryUser($request);
            $this->loginTemporaryUser($user);
            //TODO send mail to the user with the password
        }

        $error = $this->checkValidCheckoutInfo($request);
        if ($error != '') {
            echo 'error ' . $error;
            return;
        }

        $referenceCode = $request->cookie('orderReference');
        $referenceCode = $this->validateReferenceCode($referenceCode);

        $order = Order::where('reference_code', $referenceCode)->first();
        if ($order == '') {
            echo 'error processing order';
            return;
        }

        if ($order->state != OrderState::ORDER_TEMPORAL && $order->state != OrderState::ORDER_PENDING_PAYMENT) {
            echo 'Invalid Oder, please contact us';
            return;
        }

        $productList = $this->validateProductListDB();
        if ($productList == '') {
            echo 'error invalid request :(';
            return;
        }

        $this->recreateOrderProducts($order->id);
        $order->state = OrderState::ORDER_PENDING_PAYMENT;
        $order->user_id = $user->id;
        $order->save();


        echo 'successfuly order now pay u';
        //TODO send data to PAY-U

    }

    private function checkValidCheckoutInfo($request)
    {
        $name = $request->input('name');
        if ($name == '') {
            return 'name cant be empty';
        }

        $lastname = $request->input('lastname');
        if ($lastname == '') {
            return 'lastname cant be empty';
        }

        $email = $request->input('email');
        if ($email == '') {
            return 'email cant be empty';
        }

        $country = $request->input('country');
        if ($country == '') {
            return 'country cant be empty';
        }

        $validState = $this->isValidateState($request);
        if ($validState == '') {
            return 'must select a city';
        }

        $address = $request->input('address');
        if ($address == '') {
            return 'address cant be empty';
        }

        $cellphone = $request->input('cellphone');
        if ($cellphone == '') {
            return 'cellphone cant be empty';
        }

    }

    /**
     * return empty if couldnt find state
     **/
    private function isValidateState($request)
    {
        //Retrieve country state input field
        $countryListName = CountryState::all()->pluck('name');
        $countryListName->prepend("ninguno");

        $state = $request->input('state');
        if ($state == '0') {
            return '';
        }

        $stateSelected = $countryListName->get($state);
        if ($stateSelected == '') {
            return '';
        }

        return $stateSelected;
    }

    private function recreateOrderProducts($orderId)
    {
        ProductOrder::where('order_id', $orderId)->delete();
        $this->generateOrderProducts($orderId);
    }

    private function registerNewTemporaryUser($request)
    {
        //TODO do this function on the userRegisterController
        $user = new User();
        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->country = $request->input('country');
        $user->country_state = $this->isValidateState($request);
        $user->address = $request->input('address');
        $user->cellphone = $request->input('cellphone');
        $user->password = Hash::make($this->generateRandomPassword());
        $user->save();

        return $user;
    }

    private function generateRandomPassword()
    {
        //TODO change this
        return 123456;
    }

    private function redirectToLogin($email)
    {
        $registerController = new UserRegisterController();
        return $registerController->redirectToLoginPayment($email);
    }

    private function loginTemporaryUser($user)
    {
        //TODO check why this is not working
        $loginController = new LoginController();
        $loginController->tryLoginUser($user->email, $user->password);
    }

}
