<?php

Admin::routes();

Route::get('/', function(){return 123;})->name('admin.home');
Route::get('setting ', 'HomeController@setting')->name('admin.setting');

//POST-----------------------------------
//修改權限所擁有路由
Route::post('ModifyPermissions', 'HomeController@ModifyPermissions')->name('admin.ModifyPermissions');
//修改使用者所擁有權限
Route::post('ModifyUser', 'HomeController@ModifyUser')->name('admin.ModifyUser');
