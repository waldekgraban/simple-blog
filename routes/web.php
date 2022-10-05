<?php

use Illuminate\Support\Facades\Route;

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


// Route::resources([
//     'posts' => 'PostController',
// ]);
Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    Route::group(['middleware' => ['auth', 'post_operations']], function() {   
        Route::resource('posts', 'PostController');
    });

    Route::group(['middleware' => ['auth', 'user_operations']], function() {   
        Route::resource('users', 'UserController');
    });

    Route::get('/reset-password/{token}', 'ForgotPasswordController@showResetPasswordForm')->name('reset.password.get');
    Route::post('/reset-password', 'ForgotPasswordController@submitResetPasswordForm')->name('reset.password.post');
    Route::get('/forget-password', 'ForgotPasswordController@showForgetPasswordForm')->name('forget.password.get');
    Route::post('/forget-password', 'ForgotPasswordController@submitForgetPasswordForm')->name('forget.password.post');    
    
    Route::get('/', 'HomeController@index')->name('home.index');
    
    
    
    Route::group(['middleware' => ['guest']], function() {

        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {

        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');        

        // /**
        //  * User Routes
        //  */
        // Route::group(['prefix' => 'users'], function() {
        //     Route::get('/', 'UsersController@index')->name('users.index');
        //     Route::get('/create', 'UsersController@create')->name('users.create');
        //     Route::post('/create', 'UsersController@store')->name('users.store');
        //     Route::get('/{user}/show', 'UsersController@show')->name('users.show');
        //     Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
        //     Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
        //     Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
        // });

        // /**
        //  * User Routes
        //  */
        // Route::group(['prefix' => 'posts'], function() {
        //     Route::get('/', 'PostsController@index')->name('posts.index');
        //     Route::get('/create', 'PostsController@create')->name('posts.create');
        //     Route::post('/create', 'PostsController@store')->name('posts.store');
        //     Route::get('/{post}/show', 'PostsController@show')->name('posts.show');
        //     Route::get('/{post}/edit', 'PostsController@edit')->name('posts.edit');
        //     Route::patch('/{post}/update', 'PostsController@update')->name('posts.update');
        //     Route::delete('/{post}/delete', 'PostsController@destroy')->name('posts.destroy');
        // });
    });
    
    
});    

