<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('contactView');
});

Route::get('/contacto', ['uses' => 'ContactController@index']);

Route::get('/nosotros', ['uses' => 'AboutController@index']);

Route::get('/store', ['uses' => 'ProductController@productUserList']);

Route::get('/store/product/{productId}', ['uses' => 'ProductController@detailProduct']);

Route::get('/store/product/promotion/{productId}', ['uses' => 'ProductController@detailPromotionProduct']);

Route::get('/', ['uses' => 'StoreController@index']);

Route::post('/login', 'LoginController@loginUser');
Route::post('/loginPay', 'LoginController@loginPay');
Route::get('/login', 'UserRegisterController@indexRegister');

Route::get('/cookie/set', 'CookieController@setCookie');
Route::get('/cookie/get', 'CookieController@getCookie');

Route::post('/user/register', array('uses' => 'UserRegisterController@postRegister'));
Route::get('/user/register', function () {
    return view('register');
});

Route::get('/laravel/public/store1',function (){
    echo 'asd';
});

Route::get('/db/testinsert', 'UserRegisterController@insertTest');

Route::get('/Age', [
        'middleware' => 'Age',
        'uses' => 'TestController@index'
    ]
);

Route::get('/logout', function () {
    return view('logout');
})->middleware(LoggedMiddleware::class);

Route::post('/logout', [
        'middleware' => 'LoggedMiddleware',
        'uses' => 'LoginController@logout']
);

Route::get('/orders', [
        'middleware' => 'LoggedMiddleware',
        'uses' => 'OrderController@userOrders']
);

Route::get('/manage/orders', [
        'middleware' => 'LoggedMiddleware',
        'uses' => 'OrderController@adminOrders']
);

Route::get('/manage/orders/{id}', [
        'middleware' => 'LoggedMiddleware',
        'uses' => 'OrderController@adminDetailOrder']
);


Route::get('/uploadProduct', [
        'middleware' => 'AdminMiddleware',
        'uses' => 'ProductController@index']
);

Route::post('/uploadProduct', [
        'middleware' => 'AdminMiddleware',
        'uses' => 'ProductController@uploadProduct']
);

Route::get('/checkout', [
        'uses' => 'CheckoutController@index']
);

Route::post('/checkout/pay', [
        'uses' => 'CheckoutController@pay']
);

Route::post('/store/checkout/myConfirmation',[
    'uses' => 'CheckoutController@paymentConfirmation'
]);
