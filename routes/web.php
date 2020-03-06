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
Route::resource('todo', 'TodoController');

Auth::routes(); //authコマンドをうったとき作成される

Route::get('/home', 'HomeController@index')->name('home');  //authコマンドをうったとき作成される
