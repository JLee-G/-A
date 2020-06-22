<?php

Admin::routes();

Route::get('/', 'HomeController@index')->name('admin.home');
//權限管理
Route::get('setting ', 'HomeController@setting')->name('admin.setting');
//廠商管理
Route::get('company ', 'CompanyController@index')->name('admin.company');
//客戶管理
Route::get('client ', 'ClientController@index')->name('admin.client');
//訂單管理
Route::get('order ', 'OrderController@index')->name('admin.order');
//查看金額資訊
Route::get('amount ', 'AmountController@index')->name('admin.amount');

Route::get('kkk', 'HomeController@kkk')->name('admin.kkk');

Route::get('mail', 'HomeController@mail_test')->name('admin.mail');





//POST-----------------------------------
//修改權限所擁有路由
Route::post('ModifyPermissions', 'HomeController@ModifyPermissions')->name('admin.ModifyPermissions');
//修改使用者所擁有權限
Route::post('ModifyUser', 'HomeController@ModifyUser')->name('admin.ModifyUser');
