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


Route::get('/', 'Welcome@ShowProcess')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/UserName/modify', 'UserOperating@modify')->name('modify');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');



//資訊部頁面
Route::get('/Information', 'Information@GetData')->name('Information');
//會計部頁面
Route::get('/Accounting', 'Accounting@GetData')->name('Accounting');
//行銷部頁面
Route::get('/Marketing', 'Marketing@GetData')->name('Marketing');
//業務部頁面
Route::get('/Business', 'Business@GetData')->name('Business');

//管理頁面
Route::get('/management', 'UserOperating@GetData')->name('management');

//新增部門
Route::get('/AddDepartment', 'UserOperating@AddDepartment')->name('AddDepartment');
//新增權限
Route::get('/AddPermissions', 'UserOperating@AddPermissions')->name('AddPermissions');
//修改使用者權限
Route::get('/UserPermissions', 'UserOperating@UserPermissions')->name('UserPermissions');
//檢查觀看頁面權限
Route::get('/CheckPermissions', 'UserOperating@CheckPermissions')->name('CheckPermissions');
//刷新路徑
Route::get('/RefreshUrl', 'SetUp@RefreshUrl')->name('RefreshUrl');
//POST-------------
//修改觀看權限
Route::post('/ModifyWatch', 'UserOperating@ModifyWatch')->name('ModifyWatch');
//修改部門名稱
Route::post('/MDN', 'UserOperating@MDNpost')->name('MDNpost');
//刪除權限
Route::post('/DeleteAuthority', 'UserOperating@DeleteAuthority')->name('DeleteAuthority');