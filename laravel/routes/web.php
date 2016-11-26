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
Route::post('/login', 'LoginController@loginUser');

Route::post('/loginPay', 'LoginController@loginPay');
Route::get('/login', 'UserRegisterController@indexRegister');

Route::get('/cookie/set', 'CookieController@setCookie');
Route::get('/cookie/get', 'CookieController@getCookie');

Route::post('/user/register', array('uses' => 'UserRegisterController@postRegister'));
Route::get('/user/register', function () {
    return view('register');
});

Route::get('/logout', function () {
    return view('logout');
})->middleware(LoggedMiddleware::class);

Route::post('/logout', [
        'middleware' => 'LoggedMiddleware',
        'uses' => 'LoginController@logout']
);

Route::get('/uploadProduct', [
        'middleware' => 'AdminMiddleware',
        'uses' => 'ProductController@index']
);

Route::post('/uploadProduct', [
        'middleware' => 'AdminMiddleware',
        'uses' => 'ProductController@uploadProduct']
);

//detallar los post que hay publicados
Route::get('/blog', [
    'uses' => 'BlogController@listUserPost'
]);

//detallar los post que hay publicados
Route::get('/blogTest', [
    'middleware' => 'AdminMiddleware',
    'uses' => 'BlogController@listUserPostTest'
]);

//panel con las acciones de admin sobre los posts
Route::get('/blogAdmin', [
    'middleware' => 'AdminMiddleware',
    'uses' => 'BlogController@indexAdmin'
]);

//edit post
Route::get('/blogAdmin/edit/{postName}', [
    'middleware' => 'AdminMiddleware',
    'uses' => 'BlogController@editPostAdmin'
]);

//upload post
Route::post('/blogAdmin/uploadPost', [
    'middleware' => 'AdminMiddleware',
    'uses' => 'BlogController@uploadPost'
]);

//detail post
Route::get('/blog/{postName}', [
        'uses' => 'BlogController@loadPost']
);

//upload post image
Route::get('/blogAdmin/uploadBlogImage', [
        'middleware' => 'AdminMiddleware',
        'uses' => 'BlogController@indexUploadBlogImage']
);

//upload post image
Route::post('/blogAdmin/uploadBlogImage', [
        'middleware' => 'AdminMiddleware',
        'uses' => 'BlogController@uploadBlogImage']
);


//TODO temporary blocked url just to allow enter to blog---------

//this
Route::get('/contacto', [
    'middleware' => 'AdminMiddleware',
    'uses' => 'ContactController@index']);

//this
Route::get('/nosotros', [
    'middleware' => 'AdminMiddleware',
    'uses' => 'AboutController@index']);

//this
Route::get('/store', [
    'middleware' => 'AdminMiddleware',
    'uses' => 'ProductController@productUserList']);

//this
Route::get('/store/product/{productId}', [
    'middleware' => 'AdminMiddleware',
    'uses' => 'ProductController@detailProduct']);

//this
Route::get('/store/product/promotion/{productId}', [
    'middleware' => 'AdminMiddleware',
    'uses' => 'ProductController@detailPromotionProduct']);

//this
Route::get('/', [
    'middleware' => 'AdminMiddleware',
    'uses' => 'StoreController@index']);


//this
Route::get('/
', [
        'middleware' => 'AdminMiddleware',
        'middleware' => 'LoggedMiddleware',
        'uses' => 'OrderController@userOrders']
);

//this
Route::get('/manage/orders', [
        'middleware' => 'AdminMiddleware',
        'middleware' => 'LoggedMiddleware',
        'uses' => 'OrderController@adminOrders']
);

//this
Route::get('/manage/orders/{id}', [
        'middleware' => 'AdminMiddleware',
        'middleware' => 'LoggedMiddleware',
        'uses' => 'OrderController@adminDetailOrder']
);

//this
Route::get('/checkout', [
        'middleware' => 'AdminMiddleware',
        'uses' => 'CheckoutController@index']
);

//this
Route::post('/checkout/pay', [
        'middleware' => 'AdminMiddleware',
        'uses' => 'CheckoutController@pay']
);

//this
Route::get('/checkout/pay', [
        'middleware' => 'AdminMiddleware',
        'uses' => 'CheckoutController@validateCorrectPayUrl']
);

//this
Route::post('/store/checkout/myConfirmation', [
    'middleware' => 'AdminMiddleware',
    'uses' => 'CheckoutController@paymentConfirmation'
]);

//this
Route::get('/store/checkout/paymentResponse', [
    'middleware' => 'AdminMiddleware',
    'uses' => 'PayuResponseController@paymentResponse'
]);