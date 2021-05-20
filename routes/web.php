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

# Main Routes (logged in users)
Route::group(['middleware' => 'auth'], function () {

    Route::get('/', ['as' => 'index', 'middleware' => 'auth', 'uses' => 'Controller@index']);
    Route::get('/explore', ['as' => 'explore', 'middleware' => 'auth', 'uses' => 'ExploreController@index']);

    Route::get('/follow', ['as' => 'user.follow', 'uses' => 'UserFollowsController@follow']);
    Route::get('/unfollow', ['as' => 'user.unfollow', 'uses' => 'UserFollowsController@unfollow']);

    /* -------------- POSTS --------------*/
    Route::post('/post/store', ['as' => 'post.store', 'uses' => 'PostsController@store']);
    Route::post('/post/update/{id}', ['as' => 'post.update', 'uses' => 'PostsController@update']);
    Route::get('/post/edit', ['as' => 'post.edit', 'uses' => 'PostsController@ajaxEdit']);
    Route::get('/post/delete/{id}', ['as' => 'post.delete', 'uses' => 'PostsController@delete']);
    /* -------------- POST COMMENTS --------------*/
    Route::post('/post/{postId}/comment/store', ['as' => 'post.comment.store', 'uses' => 'PostCommentsController@store']);
    Route::get('/post/{postId}/comment/edit/{id}', ['as' => 'post.comment.edit', 'uses' => 'PostCommentsController@ajaxEdit']);
    Route::post('/post/{postId}/comment/update/{id}', ['as' => 'post.comment.update', 'uses' => 'PostCommentsController@update']);
    Route::get('/post/{postId}/comment/delete/{id}', ['as' => 'post.comment.delete', 'uses' => 'PostCommentsController@delete']);
    

    /* -------------- USER OWN PROFILE --------------*/
    Route::get('/profile', ['as' => 'user.profile', 'uses' => 'ProfileController@index']);
    Route::get('/profile/activity', ['as' => 'user.profile.activity', 'uses' => 'ProfileController@index']);
    Route::get('/profile/about', ['as' => 'user.profile.about', 'uses' => 'ProfileController@showAbout']);
    Route::get('/profile/friends', ['as' => 'user.profile.friends', 'uses' => 'ProfileController@showFriends']);
    Route::post('/profile/edit', ['as' => 'user.profile.edit', 'uses' => 'ProfileController@update']);

    /* -------------- USER VISITOR PROFILE --------------*/
    Route::get('/profile/{username?}', ['as' => 'user.profile', 'uses' => 'ProfileController@index']);
    Route::get('/profile/activity/{username?}', ['as' => 'user.profile.activity', 'uses' => 'ProfileController@index']);
    Route::get('/profile/about/{username?}', ['as' => 'user.profile.about', 'uses' => 'ProfileController@showAbout']);
    Route::get('/profile/friends/{username?}', ['as' => 'user.profile.friends', 'uses' => 'ProfileController@showFriends']);
    Route::post('/profile/edit', ['as' => 'user.profile.edit', 'uses' => 'ProfileController@update']);

    /* -------------- USER LOGOUT --------------*/
    Route::get('/logout', ['as' => 'user.logout', 'uses' => 'UsersController@doLogout']);
});

# Route for logged out users
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
    Route::get('sign-up/googleExtra', ['as' => 'auth.google.sign-up.extra', 'uses' => 'SocialAuthGoogleController@showSignUpExtra']);
    Route::post('sign-up/googleExtra', ['as' => 'user.google.sign-up.extra.store', 'uses' => 'SocialAuthGoogleController@postSignUpExtra']);
});

