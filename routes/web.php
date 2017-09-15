<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.'],function(){

   Route::name('login')->get('login','Admin\Auth\LoginController@showLoginForm');
   Route::post('login','Admin\Auth\LoginController@login');


   Route::group(['middleware' => 'can:admin'],function(){

       Route::get('dashboard',function (){
           return "Area administrativa";
       });

       Route::name('logout')->post('logout','Admin\Auth\LoginController@logout');
   });

});

Route::get('/force-login',function(){
    \Auth::loginUsingId(1);
});