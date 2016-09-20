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
    return view('welcome');
});

Route::get('/1', function () {
    return 'welcome 1';
});

Route::post('/login','LoginController@loginUser');
Route::get('/login',function(){
   return view('login');
});

Route::get('/cookie/set','CookieController@setCookie');
Route::get('/cookie/get','CookieController@getCookie');

Route::post('/user/register',array('uses'=>'UserRegisterController@postRegister'));
Route::get('/user/register',function(){
	return view('register');
});

Route::get('/db/testinsert','UserRegisterController@insertTest');

Route::get('/Age',  [
	'middleware' => 'Age',
	'uses' => 'TestController@index'
	] 
);

Route::get('/uploadProduct',[
	'middleware' => 'AdminMiddleware',
	'uses' => 'ProductController@index']
	);

Route::post('/uploadProduct',[
	'middleware' => 'AdminMiddleware',
	'uses' => 'ProductController@uploadProduct']
	);

