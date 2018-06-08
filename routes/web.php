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

Route::group(['middleware' => ['web']], function(){
    //Authentication RouteServiceProvider
    Route::get('auth/login', 'Auth\AuthController@getLogin')->name('login');
    Route::post('auth/login','Auth\AuthController@login');
    Route::get('auth/logout', 'Auth\AuthController@logout')->name('logout');

    //Registration Routes
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'Auth\AuthController@postRegister');

    // Password Reset Routes
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    // Categories
    Route::resource('categories', 'CategoryController', ['except' => ['create']]);
    Route::resource('tags', 'TagController', ['except' => ['create']]);

    //Comments
    Route::post('comments/{post_id}', 'CommentsController@store')->name('comments.store');
    Route::get('comments/{id}/edit', 'CommentsController@edit')->name('comments.edit');
    Route::put('comments/{id}', 'CommentsController@update')->name('comments.update');
    Route::delete('comments/{id}', 'CommentsController@destroy')->name('comments.destroy');
    Route::get('comments/{id}/delete', 'CommentsController@delete')->name('comments.delete');

    Route::get('blog/{slug}', 'BlogController@getSingle')->where('slug', '[\w\d\-\_]+')->name('blog.single');
    Route::get('blog', 'BlogController@getIndex')->name('blog.index');
    Route::get('contact', 'PagesController@getContact');
    Route::post('contact', 'PagesController@postContact');
    Route::get('about', 'PagesController@getAbout');
    Route::get('/', 'PagesController@getIndex');
    Route::resource('posts', 'PostController');
});
