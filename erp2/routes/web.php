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

Route::get('/', function () {
    return view('welcome');
});

//首頁
Route::get('/index', 'Index@index')->name('index');
Route::get('/setting', 'HomeController@setting')->name('setting');


//POST==============================
Route::post('/New_customer', 'Index@New_customer')->name('New_customer');