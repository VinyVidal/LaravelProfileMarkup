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

Route::get('/', ['as' => 'index', 'middleware' => 'auth', 'uses' => 'Controller@index']);

Route::group(['middleware' => 'guest'], function () {
    /* -------------- LOGIN/REGISTRATION ROUTES --------------*/
    Route::get('login', ['as' => 'user.login', 'uses' => 'UsersController@showLogin']);
    Route::post('doLogin', ['as' => 'user.doLogin', 'uses' => 'UsersController@doLogin']);

    Route::get('sign-up/basic-info', ['as' => 'user.sign-up.step1', 'uses' => 'UsersController@showSignUpStep1']);
    Route::post('sign-up/step1', ['as' => 'user.sign-up.step1.store', 'uses' => 'UsersController@postSignUpStep1']);

    Route::get('sign-up/social', ['as' => 'user.sign-up.step2', 'uses' => 'UsersController@showSignUpStep2']);
    Route::post('sign-up/step2', ['as' => 'user.sign-up.step2.store', 'uses' => 'UsersController@postSignUpStep2']);

    Route::get('sign-up/account', ['as' => 'user.sign-up.step3', 'uses' => 'UsersController@showSignUpStep3']);
    Route::post('sign-up/step3', ['as' => 'user.sign-up.step3.store', 'uses' => 'UsersController@postSignUpStep3']);

    /* -------------- GOOGLE OAUTH ROUTES --------------*/
    Route::get('/redirect', ['as' => 'auth.google.redirect', 'uses' => 'SocialAuthGoogleController@redirect']);
    Route::get('/callback', ['as' => 'auth.google.callback', 'uses' => 'SocialAuthGoogleController@callback']);
});

