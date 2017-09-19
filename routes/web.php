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



//Auth::routes();
// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')
    ->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
    ->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
    ->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::get('email-verification/error', 'EmailVerificationController@getVerificationError')->name('email-verification.error');
Route::get('email-verification/check/{token}', 'EmailVerificationController@getVerification')->name('email-verification.check');




Route::get('/home', 'HomeController@index')->name('home');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.'],function(){

   Route::name('login')->get('login','Admin\Auth\LoginController@showLoginForm');
   Route::post('login','Admin\Auth\LoginController@login');


   Route::group(['middleware' => ['isVerified','can:admin']],function(){
       Route::get('dashboard',function (){
           return view('admin.dashboard');
       });


       Route::resource('users','Admin\UsersController');
       Route::get('alterar/senha','Admin\UsersController@criaSenha');
       Route::post('alterar/alteraSenha','Admin\UsersController@alteraSenha');

       Route::resource('categorias','Admin\CategoryController');

   });
    Route::name('logout')->post('logout','Admin\Auth\LoginController@logout');
});

