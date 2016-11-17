<?php

namespace testmiguel\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use testmiguel\CountryState;
use testmiguel\Http\Requests;
use testmiguel\Order;
use testmiguel\OrderPayU;
use testmiguel\OrderPayUReference;
use testmiguel\Product;
use testmiguel\ProductOrder;
use testmiguel\User;
use testmiguel\OrderState;
use Hash;

class CheckoutController extends Controller
{

    private $apiKey = '4Vj8eK4rloUd272L48hsrarnUA';
    private $accountId = '512321';
    private $merchantId = '508029';
    private $currecy = 'COP';

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

    /*
     * function to receive PayU payment response, and update transaction
     */
    public function paymentConfirmation(Request $request)
    {
        $referenceSale = $request->input('reference_sale');
        $order = Order::where('payu_order_reference', $referenceSale)->first();
        $this->generatePayUResponse($request, $order);

        $generateSignature = $this->generateResponseSignature($request);
        $responseSignature = $request->input('sign');
        if ($generateSignature != $responseSignature) {
            //TODO invalid signature
            return;
        }
        $statePol = $request->input('state_pol');

        if ($order == '' || $order->state == OrderState::ORDER_COMPLETE) {
            return;
        }
        if ($statePol != '' && $statePol == OrderState::PAYU_ORDER_APPROVED) {
            $order->state = OrderState::ORDER_COMPLETE;
        }
        if ($statePol != '' && $statePol == OrderState::PAYU_ORDER_DECLINED) {
            $order->state = OrderState::ORDER_PAYMENT_REJECTED;
        }
        if ($statePol != '' && $statePol == OrderState::PAYU_ORDER_EXPIRED) {
            $order->state = OrderState::ORDER_PAYMENT_EXPIRED;
        }
        $order->save();
    }

    private function generatePayUResponse($request, $order)
    {
        $orderPayU = new OrderPayU();
        $orderPayU->order_id = $order->id;
        $orderPayU->merchant_id = $request->input('merchant_id');
        $orderPayU->state_pol = $request->input('state_pol');
        $orderPayU->risk = $request->input('risk');
        $orderPayU->response_code_pol = $request->input('response_code_pol');
        $orderPayU->reference_sale = $request->input('reference_sale');
        $orderPayU->reference_pol = $request->input('reference_pol');
        $orderPayU->sign = $request->input('sign');
        $orderPayU->extra1 = $request->input('extra1');
        $orderPayU->extra2 = $request->input('extra2');
        $orderPayU->payment_method = $request->input('payment_method');
        $orderPayU->payment_method_type = $request->input('payment_method_type');
        $orderPayU->installments_number = $request->input('installments_number');
        $orderPayU->value = $request->input('value');
        $orderPayU->tax = $request->input('tax');
        $orderPayU->additional_value = $request->input('additional_value');
        $orderPayU->transaction_date = $request->input('transaction_date');
        $orderPayU->currency = $request->input('currency');
        $orderPayU->email_buyer = $request->input('email_buyer');
        $orderPayU->response_message_pol = $request->input('response_message_pol');
        $orderPayU->payment_method_id = $request->input('payment_method_id');
        $orderPayU->payment_method_name = $request->input('payment_method_name');
        $orderPayU->ip = $request->input('ip');
        $orderPayU->commision_pol = $request->input('commision_pol');
        $orderPayU->billing_address = $request->input('billing_address');
        $orderPayU->shipping_address = $request->input('shipping_address');
        $orderPayU->phone = $request->input('phone');
        $orderPayU->date = $request->input('date');

        $orderPayU->save();
    }

    private function generateResponseSignature($request)
    {
        $merchantID = $request->input('merchant_id');
        $referenceSale = $request->input('reference_sale');
        $newValue = $request->input('new_value');
        $currency = $request->input('currency');
        $statePol = $request->input('state_pol');

        $signatureTemp = $this->apiKey . '~' . $merchantID . '~' . $referenceSale . '~' . $newValue . '~' . $currency . '~' . $statePol;
        $signature = md5($signatureTemp);
        return $signature;
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
        $order->payu_order_reference = 0;
        $order->price = 0;

        $order->save();
        $order->reference_code = 'BrunoHans' . $order->id;//Hash::make($order->id);
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

        $totalPrice = 0;
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
            $totalPrice = $totalPrice + $productOrder->price - $productOrder->discount;
        }
        //update order price
        $order = Order::where('id', $orderId)->first();
        $order->price = $totalPrice;
        $order->save();
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

        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if (Auth::check()) {
            $this->checkForUpdateUserCheckoutInfo($user, $request);
        } else {
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

        $this->generatePayUOrderReference($order);

        $signature = $this->generateSignature($order->payu_order_reference, $order->price);

        $description = 'Pago de mi orden';

        $response = new \Illuminate\Http\Response(view('not-logged/checkout/processPayment',
            ['user' => $user, 'signature' => $signature, 'reference' => $order->payu_order_reference, 'merchantId' => $this->merchantId,
                'accountId' => $this->accountId, 'amount' => $order->price, 'currency' => $this->currecy, 'description' => $description]
        ));
        return $response;

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

    private function checkForUpdateUserCheckoutInfo($user, $request)
    {
        $country_state = $this->isValidateState($request);
        $address = $request->input('address');
        $cellphone = $request->input('cellphone');

        $mustUpdate = false;

        if ($user->country_state != $country_state) {
            $user->country_state = $country_state;
            $mustUpdate = true;
        }

        if ($user->address != $address) {
            $user->address = $address;
            $mustUpdate = true;
        }

        if ($user->cellphone != $cellphone) {
            $user->cellphone = $cellphone;
            $mustUpdate = true;
        }

        if ($mustUpdate) {
            $user->save();
        }
    }

    private function generateSignature($referenceCode, $amount)
    {
        $signatureTemp = $this->apiKey . '~' . $this->merchantId . '~' . $referenceCode . '~' . $amount . '~' . $this->currecy;
        $signature = md5($signatureTemp);
        return $signature;
    }

    private function generatePayUOrderReference($order)
    {
        $orderPayU = new OrderPayUReference();
        $orderPayU->order_id = $order->id;
        $orderPayU->order_reference = 'BrunoHans';
        $orderPayU->save();
        $orderPayU->order_reference = 'BrunoHans' . $orderPayU->id;
        $orderPayU->save();

        $order->payu_order_reference = $orderPayU->order_reference;
        $order->save();
    }

}
