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

Route::get('/','PostController@index');
Route::get('/posts/{post}', 'PostController@show');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware('auth')->group(function () {
        Route::post('/posts','PostController@store');
        Route::get('/post/create','PostController@create');
        Route::get('/posts/{post}/edit','PostController@edit');
        Route::put('/posts/{post}','PostController@update');
        Route::delete('/posts/{post}','PostController@destroy');
        Route::post('/posts/{post}/comment','CommentController@store');
        Route::get('/posts/like/{id}', 'PostController@like')->name('post.like'); //ルーティングに名前
        Route::get('/posts/unlike/{id}', 'PostController@unlike')->name('post.unlike');
 });
