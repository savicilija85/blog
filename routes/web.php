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


    Route::get('blog/{slug}', 'BlogController@getSingle')->where('slug', '[\w\d\-\_]+')->name('blog.single');
    Route::get('blog', 'BlogController@getIndex')->name('blog.index');
    Route::get('contact', 'PagesController@getContact');
    Route::get('about', 'PagesController@getAbout');
    Route::get('/', 'PagesController@getIndex');
    Route::resource('posts', 'PostController');
});
