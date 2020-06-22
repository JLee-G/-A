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

Route::get('test', 'test24@index')->name('test');

Route::get('test02', 'test01@test02')->name('test02');


//POST------------------------------------------------
Route::post('/hotel_add', 'test01@hotel_addpost')->name('hotel_addpost');                           //新增飯店
Route::post('/room_add', 'test01@room_addpost')->name('room_addpost');                              //新增房間
Route::post('/currency_add', 'test01@currency_addpost')->name('currency_addpost');                  //新增幣別
Route::post('/supplier_add', 'test01@supplier_addpost')->name('supplier_addpost');                  //新增供應商
Route::post('/order_add', 'test01@order_addpost')->name('order_addpost');                           //新增訂單
Route::post('/Room_type_add', 'test01@Room_type_addpost')->name('Room_type_addpost');               //新增房型

Route::post('/Related_Hotel', 'test01@Related_Hotelpost')->name('Related_Hotelpost');               //取得關聯飯店
Route::post('/Related_Room', 'test01@Related_Roompost')->name('Related_Roompost');                  //取得關聯飯店房間
Route::post('/Room_Information', 'test01@Room_Informationpost')->name('Room_Informationpost');      //取得房間資訊
Route::post('/order_inquire', 'test01@order_inquirepost')->name('order_inquirepost');               //取得訂單相關資訊
Route::post('/amount_inquire', 'test01@amount_inquirepost')->name('amount_inquirepost');            //用金額ID取資料








